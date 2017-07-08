<?php
namespace Goxob\Sale\Model;

use DB;

class Orders extends \Goxob\Core\Model\ModelList{

    protected $defaultOrderBy = 'order_id';
    protected $defaultOrderDir = 'DESC';

    public function getLastOrders($number = 5)
    {
        if(!is_numeric($number)){
            throw new \InvalidArgumentException('Invalid number of orders provided');
        }
        $query = $this->getSelect();
        $query->addSelect(DB::raw('count(order_product.product_id) as item_count'));
        $query->join('order_product', 'order.order_id', '=', 'order_product.order_id' );

//        $query->addSelect('customer.*');
//        $query->leftJoin('customer', 'order.customer_id', '=', 'customer.customer_id' );

        $query->groupBy('order.order_id');
        $query->orderBy('order.order_id','desc');
        $orders = $query->take($number)->get();

        return $orders;
    }

    public function getTotalAmount( )
    {
        return $this->getSelect()
            ->where('status', \Goxob\Sale\Helper\Order::STATUS_COMPLETE)
            ->sum('amount');
    }

    public function getTotalAmountForYear( )
    {
        return $this->filterByRange('year')->where('status', \Goxob\Sale\Helper\Order::STATUS_COMPLETE)->sum('amount');
    }

    public function getTotalAmountLastMonth( )
    {
        return $this->getSelect()
            ->where('status', \Goxob\Sale\Helper\Order::STATUS_COMPLETE)
            ->whereRaw('created_at > DATE_SUB(NOW(), INTERVAL 1 MONTH)')
            ->sum('amount');
    }

}