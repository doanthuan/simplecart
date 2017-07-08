<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 7/16/14
 * Time: 10:43 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Application\Model;


class Setting extends \Goxob\Core\Model\Model{

    protected $table = 'setting';
    protected $primaryKey = 'setting_id';

    protected $fillable = array( 'group', 'key', 'value' );

    protected $rules = array(
        'group'=>'required',
        'key'=>'required',
        'value'=>'required',
    );

    public function setData($input)
    {
        parent::setData($input);
        if($id = $this->exists(array('group', 'key')))
        {
            $input['setting_id'] = $id;
            parent::setData($input);
        }
    }

}