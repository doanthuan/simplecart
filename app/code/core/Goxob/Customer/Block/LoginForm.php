<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/17/14
 * Time: 9:05 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Customer\Block;


class LoginForm extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'customer.block.login-form';

    public function prepareData()
    {
        if(isset($this->params['back-url']))
        {
            $backUrl = $this->params['back-url'];
            return array('backUrl' => $backUrl);
        }
    }
}