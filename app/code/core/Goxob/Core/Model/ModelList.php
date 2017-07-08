<?php
namespace Goxob\Core\Model;

use Session, Input, Schema, Str, DB;
use Goxob\Core\Helper\Data;

class ModelList{

    protected $model;
    protected $query;
    protected $joins = array();

    protected $defaultOrderBy;
    protected $defaultOrderDir;

    public function getModel()
    {
        $className = get_class($this);
        $className = Str::singular($className);
        return new $className();
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function getAll()
    {
        return $this->getSelect()->get();
    }

    public function paginate($pageSize = null)
    {
        if(is_null($pageSize))//get from grid page size
        {
            $defaultPageSize = \Goxob::getSetting('display.default_page_size');
            $pageSize = Input::get('limit', $defaultPageSize);
        }
        $pagination = $this->getSelect()->paginate($pageSize);
        $pagination->appends(array_except(Input::query(), 'page'));
        return $pagination;
    }

    public function join($joins = array())
    {
        $this->joins = $joins;
        return $this;
    }

    public function getSelect()
    {
        $this->model = $this->getModel();
        if(!isset($this->model))
        {
            throw new \Exception('Model has not been provided');
        }
        $this->query = $this->model->query();

        $tableName = $this->model->getTable();

        $query = $this->query;
        $query->select("{$tableName}.*");

        //joins default table
        if(isset($this->defaultJoins))
        {
            $this->joins = array_unique(array_merge($this->joins, $this->defaultJoins));
        }
        foreach($this->joins as $join)
        {
            $join = Data::snakeToUpper($join);
            $method = 'join'.$join;
            if(method_exists ( $this , $method ))
            {
                $this->$method();
            }
        }


        //default order by
        if(isset($this->defaultOrderBy)){
            $orderDir = isset($this->defaultOrderDir)?$this->defaultOrderDir:'ASC';
            $query->orderBy($this->defaultOrderBy, $orderDir);
        }

        //echo $query->toSql();exit;
        return $query;
    }

    public function countInRange($range)
    {
        $query = $this->getSelect();
        if($range == 'day')
        {
            $query->selectRaw('HOUR(created_at) as num_item, count(*) as count');
            $query->whereRaw('date(created_at) = date(CURRENT_DATE)');
            $query->groupBy(DB::raw('HOUR(created_at)'));
        }
        if($range == 'month')
        {
            $query->selectRaw('DAY(created_at) as num_item, count(*) as count');
            $query->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE)');
            $query->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE)');
            $query->groupBy(DB::raw('date(created_at)'));
        }
        if($range == 'year')
        {
            $query->selectRaw('MONTH(created_at) as num_item, count(*) as count');
            $query->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE)');
            $query->groupBy(DB::raw('MONTH(created_at)'));
        }

        $result = array();
        $rows = $query->get();
        foreach($rows as $row){
            $result[$row->num_item] = array($row->num_item, $row->count);
        }
        return $result;
    }

    public function filterByRange($range, &$query = null)
    {
        if($query == null){
            $query = $this->getSelect();
        }
        if($range == 'day')
        {
            $query->whereRaw('date(created_at) = date(CURRENT_DATE)');
        }
        if($range == 'week')
        {
            $query->whereRaw('WEEKOFYEAR(created_at )= WEEKOFYEAR(NOW())');
            $query->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE)');
        }
        if($range == 'month')
        {
            $query->whereRaw('MONTH(created_at) = MONTH(CURRENT_DATE)');
            $query->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE)');
        }
        if($range == 'year')
        {
            $query->whereRaw('YEAR(created_at) = YEAR(CURRENT_DATE)');
        }
        return $query;
    }


}