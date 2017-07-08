<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/7/14
 * Time: 10:18 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\Helper;


class Product {

    public static function getLink($product)
    {
        $slug = $product->product_id.'-'.$product->alias;
        return url('product').'/'.$slug;
    }

    public static function getProductId($slug)
    {
        list($productId) = explode('-', $slug);
        return $productId;
    }

    public static function getDefaultImage($product)
    {
        $imgUrl = static::getProductImageUrl();
        $imgName = '';
        if(isset($product->img_name)){
            $imgName = $product->img_name;
        }else{
            $imgDefault = $product->images()->first();
            if(isset($imgDefault)){
                $imgName = $imgDefault->img_name;
            }
        }
        $thumbnail = static::getImageThumbnail($imgName);
        return $imgUrl.'/'.$thumbnail;
    }

    private static function getImageThumbnail($file)
    {
        $fileParts = explode('.',$file);
        $ext = strtolower(array_pop($fileParts));

        $title = implode('.',$fileParts);
        $title = htmlspecialchars($title);

        return $title.'_thumb.'.$ext;
    }

    public static function getName($product)
    {
        return mb_substr($product->name, 0, 30);
    }

    public static function getProductImagePath()
    {
        return base_path().DS.'media'.DS.'product';
    }

    public static function getProductImageUrl()
    {
        return \Goxob::getBaseUrl('media').'/product';
    }

}