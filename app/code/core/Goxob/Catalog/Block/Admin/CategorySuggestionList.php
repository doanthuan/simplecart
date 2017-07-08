<?php
namespace Goxob\Catalog\Block\Admin;

use View, Input;

class CategorySuggestionList extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'catalog.block.category-suggestion-list';

    public function prepareData()
    {
        if(isset($this->params['categories']))
        {
            $data['categories'] = $this->params['categories'];
            return $data;
        }
    }

}