<?php
namespace Goxob\Slideshow\Model;

use DB, Str;

class Group extends \Goxob\Core\Model\Model{

	protected $table = 'slideshow_group';
    protected $primaryKey = 'group_id';

    protected $fillable = array( 'name', 'alias' );

    protected $rules = array(
        'name' => 'required'
    );

    //relationship
    public function items()
    {
        return $this->hasMany('\Goxob\Slideshow\Model\Item', 'group_id', 'group_id');
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

}