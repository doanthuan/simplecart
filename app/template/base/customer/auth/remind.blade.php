@extends('master.empty')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
@stop

@section('content')
<?php echo Form::open(array('class' => 'form-horizontal form-reminder', 'url' => 'remind', 'id' => 'remind-form'))?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('Account Reminders')}}</h3>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label for="username" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9"><?php echo Form::text('email', null, array('class' => 'form-control email', 'required' => 'required'))?></div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 text-right">
                <input type="submit" class="btn btn-primary" value="{{trans('Submit')}}">
            </div>
        </div>
    </div>
</div>

<?php echo Form::close();?>

<script>
    $(document).ready(function(){
        $("#remind-form").validate();
    });
</script>


@stop