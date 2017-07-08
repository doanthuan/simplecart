<div class="panel panel-default">
    <div class="panel-heading">
        {{trans('Account')}}
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{url('customer')}}">{{trans('My Account')}}</a>
            </li>
            <li class="list-group-item">
                <a href="{{url('customer/address')}}">{{trans('Address Books')}}</a>
            </li>
            <li class="list-group-item">
                <a href="{{url('customer/order-history')}}">{{trans('Order History')}}</a>
            </li>
        </ul>
      </div>
</div>