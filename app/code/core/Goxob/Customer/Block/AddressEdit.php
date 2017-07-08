<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/14/14
 * Time: 2:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Customer\Block;


class AddressEdit extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'customer.block.address-edit';

    public function prepareData()
    {
        $data['type'] = $this->params['type'];

        return array($data);
    }

}