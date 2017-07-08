<?php
namespace Goxob\Slideshow\Block;

use View, Input, Request, Session, URL;

class Slideshow extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'slideshow.block.carousel';

    public function prepareData()
    {
        $data = array();
        if(isset($this->params['alias'])){
            $alias = $this->params['alias'];

            $group = \Goxob::getModel('slideshow/group')->where('alias', $alias)->first();
            if(is_null($group)){
                return \Goxob::error(trans('Could not slide show group'));
            }

            $items = $group->items()->get();
            $data['items'] = $items;
        }

        return $data;
    }

}