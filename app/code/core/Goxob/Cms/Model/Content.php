<?php
namespace Goxob\Cms\Model;

use DB, Input, Str, Validator, File;

class Content extends \Goxob\Core\Model\Model{

    protected $table = 'cms_content';
    protected $primaryKey = 'content_id';
    public $timestamps = true;

    protected $fillable = array( 'title', 'alias', 'content', 'category_id', 'sort_order', 'status', 'created_at',
        'updated_at');

    protected $rules = array(
        'category_id' =>'required|integer',
        'title'       =>'required',
        'content'     =>'required',
    );

    protected  $uploadRules = array(
        'thumbnail' => 'mimes:png,gif,jpeg|max:20000'
    );

    public function category()
    {
        return $this->belongsTo('\Goxob\Cms\Model\Category','category_id', 'category_id');
    }

    public function setData($input)
    {
        if(empty($input)){
            return;
        }
        $input['alias'] = Str::slug( $input['title'] , '-' );

        if (Input::hasFile('thumbnail'))
        {

            $file = Input::file('thumbnail');

            $validator = Validator::make(array('thumbnail'=> $file), $this->uploadRules);
            if(!$validator->passes()){
                return \Goxob::back($validator->messages());
            }

            $basePath = base_path().DS.'media'.DS.'cms';

            //remove old image
            if(isset($this->thumbnail)){
                File::delete($basePath.'/'.$this->thumbnail);
            }

            //get new image
            $filename = \Goxob\Core\Helper\File::formatFileName($file);
            $file->move($basePath, $filename);
            $this->thumbnail = $filename;
        }

        parent::setData($input);
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists(array('name')))
            {
                $this->setErrors(trans('Content title is already existed'));
                return false;
            }

            if(!empty($this->alias) && $this->exists(array('alias')))
            {
                $this->setErrors(trans('Content alias is already existed'));
                return false;
            }

            return true;
        }
        return false;
    }



}