<?php
namespace Goxob\Cms\Block;

use View, Input, Request, Session, URL;

class Content extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'cms.block.page';

    public function prepareData()
    {
        if(isset($this->params['alias'])){
            $alias = $this->params['alias'];
        }
        else if(Input::has('page_alias')){
            $alias = Input::get('page_alias');
        }
        $content = \Goxob::getModel('cms/content')->where('status', 1)->where('alias', $alias)->first();
        if(is_null($content)){
            return \Goxob::error(trans('Could not find content'));
        }

        $data['content'] = $content;
        return $data;
    }

}