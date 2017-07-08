<?php
namespace Goxob\Cms\Model;

use DB, Str;

class Category extends \Goxob\Core\Model\Model{

	protected $table = 'cms_category';
    protected $primaryKey = 'category_id';

    protected $fillable = array( 'name', 'alias' );

    protected $rules = array(
        'name' => 'required'
    );

    //relationship
    public function contents()
    {
        return $this->hasMany('\Goxob\Cms\Model\Content', 'category_id', 'category_id');
    }

    public function setData($input)
    {
        if(empty($input)){
            return;
        }

        if(empty($input['alias'])){
            $input['alias'] = Str::slug( $input['name'] , '-' );
        }

        parent::setData($input);
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists(array('name')))
            {
                $this->setErrors(trans('Sibling categories can not have the same name'));
                return false;
            }

            if(!empty($this->alias) && $this->exists(array('alias')))
            {
                $this->setErrors(trans('Sibling categories can not have the same alias'));
                return false;
            }

            return true;
        }
        return false;
    }



}