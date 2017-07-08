<?php
namespace Goxob\Customer\Model;

use DB;
class Customers extends \Goxob\Core\Model\ModelList{

    public function getNewCustomers($number = 5)
    {
        if(!is_numeric($number)) return;

        $query = $this->getSelect();
        $query->addSelect(DB::raw('count(order.order_id) as num_order, avg(amount) as avg_amount, sum(amount) as total_amount'));
        $query->leftJoin('order','customer.customer_id','=','order.customer_id');
        $query->groupBy('customer_id');
        $query->orderBy('customer_id', 'DESC');

        return $query->take($number)->get();
    }

}