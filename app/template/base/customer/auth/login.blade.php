@extends('master.empty')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
@stop

@section('content')

<div class="col-sm-4 col-sm-offset-4">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('Account Login')}}</h3>
    </div>
    <div class="panel-body">
        @block('customer/login-form')
    </div>
</div>
</div>

@stop