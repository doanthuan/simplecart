<?php
namespace Goxob\Catalog\Block\Admin;

use View, Input;

class ProductSuggestionList extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'catalog.block.product-suggestion-list';

    public function prepareData()
    {
        if(isset($this->params['products']))
        {
            $data['products'] = $this->params['products'];
            return $data;
        }
    }

}