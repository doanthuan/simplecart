<?php
namespace Goxob\Application\Admin;

use Goxob\Core\Helper\Data;
use View, Response, DB;
use Goxob\Core\Html\Toolbar;

class DashboardController extends \Goxob\Core\Controller\AdminBaseController {

    public function index()
    {
        Toolbar::title(trans('Dashboard'));

        $modelOrders = \Goxob::getModel('sale/orders');
        $modelCustomers = \Goxob::getModel('customer/customers');
        $modelProducts = \Goxob::getModel('catalog/products');

        //stats info
        //get visits today
        $countVisit = \Goxob\Application\Helper::countByRange('day');
        $data['countVisit'] = $countVisit;

        //get number of customers this month
        $countCustomer = $modelCustomers->filterByRange('month')->where('status', 1)->count();
        $data['countCustomer'] = $countCustomer;

        //get number of orders this week
        $countOrder = $modelOrders->filterByRange('week')->count();
        $data['countOrder'] = $countOrder;

        //get total sales of last 30 days
        $totalAmountLastMonth = $modelOrders->getTotalAmountLastMonth();
        $data['totalAmountLastMonth'] = $totalAmountLastMonth;


        //get last orders
        $data['lastOrders'] = $modelOrders->getLastOrders();

        //overview
        $data['totalAmount'] = $modelOrders->getTotalAmount();
        $data['totalAmountOfYear'] = $modelOrders->getTotalAmountForYear();
        $data['totalOrder'] = $modelOrders->getSelect()->count();
        $data['totalCustomer'] = $modelCustomers->getSelect()->count();

        //most view products
        $data['mostViewProducts'] = $modelProducts->getSelect()->orderBy('hits', 'DESC')->take(5)->get();

        //new customers
        $data['newCustomers'] = $modelCustomers->getNewCustomers();

        return View::make('application.dashboard.index', $data);
    }

    public function loadChartData($range)
    {
        //day, month, year
        if(!empty($range))
        {
            //init empty data
            if($range == 'day'){
                for($i = 0; $i < 24; $i++){
                    $initData[$i] = array($i, 0);
                }
            }
            else if($range == 'month'){
                $days = date("t");
                for($i = 1; $i <= $days; $i++){
                    $initData[$i] = array($i, 0);
                }
            }
            else if($range == 'year'){
                for($i = 1; $i <= 12; $i++){
                    $initData[$i] = array($i, 0);
                }
            }
            else{
                \Goxob::error(trans('Range:'.$range.' is not supported'));
            }
            $orderData = \Goxob::getModel('sale/orders')->countInRange($range);
            $orderData = $this->mergeArray($initData, $orderData);

            $customerData = \Goxob::getModel('customer/customers')->countInRange($range);
            $customerData = $this->mergeArray($initData, $customerData);


            $resOrders = array();
            $resOrders['label'] = "Orders";
            $resOrders['data'] = array_values($orderData);

            $resCustomers = array();
            $resCustomers['label'] = "Customers";
            $resCustomers['data'] = array_values($customerData);

            $result = array();
            $result[] = $resOrders;
            $result[] = $resCustomers;

            return Response::json($result);
        }
    }

    private function mergeArray($arr1, $arr2)
    {
        foreach($arr2 as $key => $value)
        {
            $arr1[$key] = $value;
        }
        return $arr1;
    }



}