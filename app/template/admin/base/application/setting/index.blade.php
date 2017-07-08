@extends('master.main')

@section('content')

<?php echo Form::model($item, array('name' => 'adminForm', 'class' => 'form-horizontal', 'url' => 'admin/setting/store', 'files' => true))?>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#general" data-toggle="tab">{{trans('General')}}</a></li>
    <li><a href="#display" data-toggle="tab">{{trans('Display')}}</a></li>
    <li><a href="#shipping" data-toggle="tab">{{trans('Shipping')}}</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade in active" id="general">
        @include('application.setting.index.general')
    </div>

    <div class="tab-pane fade" id="display">
        @include('application.setting.index.display')
    </div>

    <div class="tab-pane fade" id="shipping">
        @include('application.setting.index.shipping')
    </div>

</div>

<?php echo Form::close();?>

@stop
