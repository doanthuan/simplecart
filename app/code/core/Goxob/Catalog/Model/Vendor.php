<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 4/29/14
 * Time: 8:39 AM
 * To change this template use File | Settings | File Templates.
 */

namespace Goxob\Catalog\Model;

use Goxob\Core\Model\Model;

class Vendor extends Model{

    protected $table = 'vendor';
    protected $primaryKey = 'vendor_id';

    protected $fillable = array(
        'vendor_id',
        'vendor_name',
        'country',
        'url',
        'email',
        'description'
    );
}