<?php
namespace Goxob\Catalog\Block;

use View, Input, Request, Session, URL;
use Goxob\Catalog\Helper\Category;

class ProductBlock extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'catalog.block.product-block';

    public function prepareData()
    {
        if(isset($this->params['collection']))
        {
            $data['products'] = $this->params['collection'];
        }
        else
        {
            $query = \Goxob::getModel('catalog/products')->getSelect()->where('status', 1);

            $this->filterByParams($query);

            $this->filterByInput($query);

            if(isset($this->params['paginate'])){
                $limit = Input::get('limit', 10);
                $products = $query->paginate($limit);

                $products->appends(array_except(Input::query(), array('page', 'cid')));
            }else{
                $products = $query->get();
            }

            $data['products'] = $products;
        }

        $this->setColumns();

        return $data;
    }

    protected function filterByInput(&$query)
    {
        //category
        if(Input::has('cid'))
        {
            $categoryId = Input::get('cid');
            Category::filterByCategory($query, $categoryId);
        }

        //search term
        if(Input::has('search')){
            $query->where('name','like','%'.Input::get('search').'%');
        }

        //order by
        if(Input::has('order') && Input::has('dir'))
        {
            $query->orderBy(Input::get('order'), Input::get('dir'));
        }
    }

    protected function filterByParams(&$query)
    {
        //filter by type
        $this->filterByType($query);

        //filter by category
        if(isset($this->params['category']) && !empty($this->params['category']))
        {
            Category::filterByCategory($query, $this->params['category']);
        }

        //filter conditions
        if(isset($this->params['where']) && !empty($this->params['where']))
        {
            $where = $this->params['where'];
            $query->whereRaw($where);
        }

        //order by
        if(isset($this->params['orderBy']) && !empty($this->params['orderBy']))
        {
            $orderBy = $this->params['orderBy'];
            $orderSegments = explode(' ', $orderBy);
            if(count($orderSegments) == 1){
                $query->orderBy($orderSegments[0]);
            }
            else{
                $query->orderBy($orderSegments[0], $orderSegments[1]);
            }
        }

        //limit
        if(isset($this->params['limit']) && is_numeric($this->params['limit'])){
            $limit = $this->params['limit'];

            $query->take($limit);
        }
    }

    protected function filterByType(&$query)
    {
        //pre-defined filters
        if(!isset($this->params['type'])){
            return;
        }
        if($this->params['type'] == 'hot'){
            $query->where('hot_from', '<=', 'now()')
                ->where('hot_to', '>=', 'now()');

            $title = trans('Hot Products');
        }
        if($this->params['type'] == 'most-sold'){
            $query->orderBy('sold', 'DESC');
            $title = trans('Most Sold Products');
        }
        if($this->params['type'] == 'most-view'){
            $query->orderBy('hits', 'DESC');
            $title = trans('Most View Products');
        }
        if(!isset($this->params['title']))
        {
            $this->params['title'] = $title;
        }
        if(!isset($this->params['limit']))
        {
            $this->params['limit'] = 5;
        }
    }

    protected function setColumns()
    {
        //grid # columns
        if(!isset($this->params['cols']))
        {
            $productCols = \Goxob::getSetting('display.product_cols');
            $this->params['cols'] = $productCols;
        }
        $columns = $this->params['cols'];
        $cssColumns = (int)(12/$columns);
        $this->params['cssColumns'] = $cssColumns;
    }

    public function orderByDropdown()
    {
        $urlNameAsc = \Goxob\Core\Helper\Data::currentUrl(array('order' => 'name', 'dir' => 'asc', 'cid' => null));
        $options[$urlNameAsc] = trans('Name (A-Z)');
        $value = null;
        if(Input::get('order') == 'name' && Input::get('dir') == 'asc'){
            $value = $urlNameAsc;
        }

        $urlNameDesc = \Goxob\Core\Helper\Data::currentUrl(array('order' => 'name', 'dir' => 'desc', 'cid' => null));
        $options[$urlNameDesc] = trans('Name (Z-A)');
        if(Input::get('order') == 'name' && Input::get('dir') == 'desc'){
            $value = $urlNameDesc;
        }

        $urlPriceAsc = \Goxob\Core\Helper\Data::currentUrl(array('order' => 'price', 'dir' => 'asc', 'cid' => null));
        $options[$urlPriceAsc] = trans('Price (Low > High)');
        if(Input::get('order') == 'price' && Input::get('dir') == 'asc'){
            $value = $urlPriceAsc;
        }

        $urlPriceDesc = \Goxob\Core\Helper\Data::currentUrl(array('order' => 'price', 'dir' => 'desc', 'cid' => null));
        $options[$urlPriceDesc] = trans('Price (High > Low)');
        if(Input::get('order') == 'price' && Input::get('dir') == 'desc'){
            $value = $urlPriceDesc;
        }

        if(!isset($attributes['style'])){
            $attributes['style'] = 'height:26px';
        }

        $attributes['onchange'] = 'location = this.value;';
        $html = \Goxob\Core\Helper\Html::dropdown('order', $value, $attributes,
            $options, null, null, null
        );
        return $html;
    }
}