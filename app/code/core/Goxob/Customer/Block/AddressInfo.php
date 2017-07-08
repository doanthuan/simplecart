<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 6/14/14
 * Time: 2:13 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Customer\Block;


class AddressInfo extends \Goxob\Core\Block\BaseBlock{

    protected $defaultTemplate = 'customer.block.address-info';

    public function prepareData()
    {
        $data['address'] = $this->params['address'];
        return array($data);
    }

}