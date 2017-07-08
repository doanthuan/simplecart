<?php
namespace Goxob\User\Model;

use Goxob\Core\Model\Model;

class Role extends Model{

    protected $table = 'user_role';
    protected $primaryKey = 'role_id';

    protected $fillable = array( 'role_name', 'permission' );

    protected $rules = array(
        'role_name'=>'required'
    );

    public function users()
    {
        return $this->hasMany('\Goxob\User\Model\User', 'role_id', 'role_id');
    }

    public function getIdByName($name)
    {
        return $this->where('role_name', $name)->first()->role_id;
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists('role_name'))
            {
                $this->setErrors(trans('Role name is already existed'));
                return false;
            }
            return true;
        }
        return false;
    }
}