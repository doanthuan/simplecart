<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/25/14
 * Time: 11:53 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Cms\Helper;


class Content {
    public static function getLink($content)
    {
        return url('page').'/'.$content->alias;
    }

    public static function getThumbnail($content)
    {
        if(empty($content->thumbnail)){
            return \Goxob::getBaseUrl('media').'/system/images/default_no_image.jpg';
        }
        return \Goxob::getBaseUrl('media').'/cms/'.$content->thumbnail;
    }

    public static function getIntro($content){
        $body = $content->content;
        if(strpos($body, '<!-- pagebreak -->') !== false){
            $parts = explode('<!-- pagebreak -->', $body);
            $result = \Goxob\Core\Helper\Html::closeTags($parts[0].'...');
            return $result;
        }
        return '';
    }


}