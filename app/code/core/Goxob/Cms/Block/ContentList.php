<?php
namespace Goxob\Cms\Block;

use View, Input, Request, Session, URL;

class ContentList extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'cms.block.category';

    public function prepareData()
    {
        $alias = Input::get('page_category_alias');
        $category = \Goxob::getModel('cms/category')->where('alias', $alias)->first();
        if(is_null($category)){
            return \Goxob::error(trans('Could not find content category'));
        }

        $query = \Goxob::getModel('cms/contents')->getSelect()->where('status', 1)->where('cms_content.category_id', $category->category_id);

        $contents = $query->paginate(10);
        $contents->appends(array_except(Input::query(), array('page', 'page_category_alias')));

        $data['contents'] = $contents;
        return $data;
    }

}