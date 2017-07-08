<?php
/**
 * Created by JetBrains PhpStorm.
 * User: thuan
 * Date: 4/29/14
 * Time: 8:39 AM
 * To change this template use File | Settings | File Templates.
 */
namespace Goxob\Sale\Model;

use Goxob\Core\Model\Model;

class Order extends Model{

    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = array( 'amount', 'status', 'customer_id', 'customer_email', 'customer_phone', 'billing_address_id',
        'shipping_address_id', 'payment_method', 'shipping_method', 'shipping_price', 'tax_amount', 'promotion_id', 'note'
    );

    protected $rules = array(
        'amount'=>'required'
    );

    //relationships
    public function products()
    {
        return $this->belongsToMany('\Goxob\Catalog\Model\Product', 'order_product', 'order_id', 'product_id')
            ->withPivot('name','quantity','price','total','discount');
    }

    public function customer()
    {
        return $this->belongsTo('\Goxob\Customer\Model\Customer', 'customer_id', 'customer_id');
    }

    public function addresses()
    {
        return $this->hasMany('\Goxob\Sale\Model\Address', 'order_id', 'order_id');
    }

    public function getOrderId()
    {
        return sprintf("%09d",   $this->order_id);
    }

    public function getStatus()
    {
        return \Goxob\Sale\Helper\Order::getStatusString($this->status);
    }

    public function saveProductItems($products)
    {
        if(is_null($products) || empty($products))
        {
            $this->setErrors(trans('Product items are empty'));
            return false;
        }
        //remove old products if existed
        $this->products()->detach();

        foreach($products as $product)
        {
            $data['name'] = $product->name;
            $data['quantity'] = $product->cart_qty;
            $data['price'] = $product->price;
            $data['total'] = $product->price * $product->cart_qty;
            $this->products()->attach($product->product_id, $data);
        }
        return true;
    }
}