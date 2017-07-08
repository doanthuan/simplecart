<?php
namespace Goxob\Core\Block;
use Controller, View, Session, Input;

class Grid extends BaseBlock{

    protected $defaultTemplate = 'partial.grid';

    protected $columns;

    protected function addColumn($data)
    {
        $this->columns[] = $data;
    }
    protected function setCollection($collection)
    {
        $this->items = $collection;
    }

    protected function prepareData()
    {
        $this->prepareColumns();
        $items = $this->prepareCollection();

        $data['columns'] = $this->columns;
        $data['items'] = $items;
        $data['filters'] = Session::get('grid_filters');
        $data['grid'] = $this;
        return $data;
    }

    protected function prepareColumns()
    {
        throw new \Exception('prepareColumns() method has not been implemented');
    }

    protected function prepareCollection()
    {
        throw new \Exception('prepareCollection() method has not been implemented');
    }


    public function getActionLinks($item)
    {
        $editUrl = Session::get('editUrl');
        $editLink = '<a href="'.$editUrl.'?id='.$item->getKey().'">'.trans('Edit').'</a>';
        return $editLink;
    }

    protected function gridFilter(&$query)
    {
        $input = Session::get('grid_filters');
        if(isset($input) && count($input) > 0)
        {
            $tableName = $query->getModel()->getTable();

            #order by
            if(!empty($input['filter_order']) && !empty($input['filter_order_dir']))
            {
                //remove default orderby
                $query->getQuery()->orders = null;
                //order by
                $query->orderBy($input['filter_order'], $input['filter_order_dir']);
            }
            foreach($this->columns as $column)
            {
                if(isset($column['filter_type']))
                {
                    if($column['filter_type'] == 'range')
                    {
                        $from = isset($input["filter_{$column['name']}_from"])?$input["filter_{$column['name']}_from"]:"";
                        $to = isset($input["filter_{$column['name']}_to"])?$input["filter_{$column['name']}_to"]:"";

                        if(!empty($from) && is_numeric($from) )
                        {
                            $query->where("{$tableName}.{$column['name']}",'>=', $from);
                        }
                        if(!empty($to) && is_numeric($to) )
                        {
                            $query->where("{$tableName}.{$column['name']}",'<=', $to);
                        }
                    }

                    if($column['filter_type'] == 'text')
                    {
                        if(!empty($input["filter_{$column['name']}"]))
                        {
                            $key = $input["filter_{$column['name']}"];
                            $query->where("{$tableName}.{$column['name']}",'like', '%'.$key.'%');
                        }
                    }
                    if($column['filter_type'] == 'dropdown')
                    {
                        if(isset($input['filter_'.$column['filter_index']]))
                        {
                            $value = $input['filter_'.$column['filter_index']];
                        }

                        if($column['filter_index'] == 'category_id' )//for category only
                        {
                            if(!empty($value)){
                                $categoryIds = \Goxob::getModel('catalog/categories')->getChildrenIds($value);
                                $query->whereIn("{$tableName}.category_id", $categoryIds);
                            }
                        }
                        else if(strlen($value) > 0)
                        {
                            $query->where("{$tableName}.{$column['filter_index']}",'=', $value);
                        }
                    }
                }
            }
        }
    }

    /**
     * @param $query
     * is a ModelList object or Laravel Query Builder
     * @return mixed
     */
    public function getData($query)
    {
        if($query instanceof \Goxob\Core\Model\ModelList)
        {
            $query = $query->getSelect();
        }
        $this->gridFilter($query);

        $defaultPageSize = \Goxob::getSetting('display.default_page_size', 20);
        $pageSize = Input::get('limit', $defaultPageSize);
        $pagination = $query->paginate($pageSize);
        $pagination->appends(array_except(Input::query(), 'page'));
        return $pagination;
    }
}