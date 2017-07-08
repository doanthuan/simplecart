<?php
namespace Goxob\Catalog\Model;

use File, DB, Input;
use Goxob\Core\Model\UploadableModel;

class Image extends UploadableModel{

	protected $table = 'product_image';
    protected $primaryKey = 'img_id';
    protected $fillable = array('img_id', 'img_name', 'default', 'product_id');

    protected $fileField = 'img_name';

    public function getBasePath()
    {
        return base_path().DS.'media'.DS.'product';
    }

    public function getBaseUrl()
    {
        return \Goxob::getBaseUrl('media').'/product';
    }

    protected static function boot()
    {
        parent::boot();

        //after store image, create thumbnail
        static::saved(function($model)
        {
            if($model->default){
                \Goxob\Core\Helper\File::createThumbs($model->img_name, $model->getBasePath());
            }
        });
    }
}