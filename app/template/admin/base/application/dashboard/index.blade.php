@extends('master.main')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.flot.min.js')}}"></script>
@stop

@section('content')

<div id="main-stats">
    <div class="row stats-row">
        <div class="col-md-3 col-sm-3 stat">
            <div class="data">
                <span class="number">{{$countVisit}}</span>
                visits
            </div>
            <span class="date">Today</span>
        </div>
        <div class="col-md-3 col-sm-3 stat">
            <div class="data">
                <span class="number">{{$countCustomer}}</span>
                {{trans('Users')}}
            </div>
            <span class="date">{{trans('This month')}}</span>
        </div>
        <div class="col-md-3 col-sm-3 stat">
            <div class="data">
                <span class="number">{{$countOrder}}</span>
                orders
            </div>
            <span class="date">This week</span>
        </div>
        <div class="col-md-3 col-sm-3 stat last">
            <div class="data">
                <span class="number">{{\Goxob\Locale\Helper\Currency::formatPrice($totalAmountLastMonth)}}</span>
                sales
            </div>
            <span class="date">last 30 days</span>
        </div>
    </div>
</div>

<div id="pad-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix pull-left">
                {{trans('Statistics')}}
            </h4>
            <div class="btn-group pull-right range">
                <button class="btn btn-sm btn-default" onclick="loadChartData('{{url('admin/dashboard/load-chart-data/day')}}', this)">Today</button>
                <button class="btn btn-sm btn-default" onclick="loadChartData('{{url('admin/dashboard/load-chart-data/month')}}', this)">This Month</button>
                <button class="btn btn-sm btn-default" onclick="loadChartData('{{url('admin/dashboard/load-chart-data/year')}}', this)">This Year</button>
            </div>
        </div>
    </div>
    <div class="row chart">
        <div class="col-md-12">
            <div class="chart-container">
                <div id="placeholder" class="chart-placeholder"></div>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{trans('Overview')}}</h3>
            </div>
            <div class="panel-body">
                <div class="dashboard-overview">
                    <div class="row">
                        <div class="col-sm-8">{{trans('Total Sales')}}:</div>
                        <div class="col-sm-4 text-right">{{\Goxob\Locale\Helper\Currency::formatPrice($totalAmount)}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">{{trans('Total Sales This Year')}}:</div>
                        <div class="col-sm-4 text-right">{{\Goxob\Locale\Helper\Currency::formatPrice($totalAmountOfYear)}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">{{trans('Total Orders')}}:</div>
                        <div class="col-sm-4 text-right">{{$totalOrder}}</div>
                    </div>
                    <div class="row last">
                        <div class="col-sm-8">{{trans('No. of Customers')}}:</div>
                        <div class="col-sm-4 text-right">{{$totalCustomer}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#last-orders" data-toggle="tab">{{trans('Last Orders')}}</a></li>
                    <li><a href="#products" data-toggle="tab">{{trans('Most View Products')}}</a></li>
                    <li><a href="#customers" data-toggle="tab">{{trans('New Customers')}}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="last-orders">
                        @include('application.dashboard.index.last-orders')
                    </div>

                    <div class="tab-pane fade" id="products">
                        @include('application.dashboard.index.most-view-products')
                    </div>

                    <div class="tab-pane fade" id="customers">
                        @include('application.dashboard.index.new-customers')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    var alreadyFetched = {};
    var data = [];
    var options = {
        series: {
            lines: { show: true,
                lineWidth: 1,
                fill: true,
                fillColor: { colors: [ { opacity: 0.1 }, { opacity: 0.13 } ] }
            },
            points: { show: true,
                lineWidth: 2,
                radius: 3
            },
            shadowSize: 0,
            stack: true
        },
        xaxis: {
            tickDecimals: 0
        },
        grid: { hoverable: true,
            clickable: true,

            borderWidth: 0
        },
        legend: {
            // show: false
            labelBoxBorderColor: "#fff"
        },
        colors: ["#a7b5c5", "#30a0eb"]
    };

    $(function() {
        $.plot("#placeholder", data, options);

        $('.btn-group .btn').eq(1).click();
    });

    function loadChartData(dataurl, element)
    {
        $('.btn-group .btn').removeClass('active');
        $(element).addClass('active');

        data = [];

        function onDataReceived(series) {

            data.push(series[0]);
            data.push(series[1]);

            $.plot("#placeholder", data, options);
        }

        $.ajax({
            url: dataurl,
            type: "GET",
            dataType: "json",
            success: onDataReceived
        });
    }

</script>

@stop