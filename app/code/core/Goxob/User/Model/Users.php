<?php
namespace Goxob\User\Model;


class Users extends \Goxob\Core\Model\ModelList{
    protected $defaultJoins = array('role');

    protected function joinRole()
    {
        $this->query->addSelect('user_role.role_name as role_name');
        $this->query->join('user_role','user_role.role_id','=','user.role_id');
    }
}