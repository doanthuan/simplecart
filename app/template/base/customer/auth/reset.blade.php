@extends('master.empty')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
@stop

@section('content')
<?php echo Form::open(array('class' => 'form-horizontal form-reset', 'url' => 'reset', 'id' => 'reset-form'))?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('Account Reset')}}</h3>
    </div>
    <div class="panel-body">

        <div class="form-group">
            <label for="email" class="col-sm-4 control-label">Email</label>
            <div class="col-sm-8"><?php echo Form::text('email', null, array('class' => 'form-control email', 'required' => 'required'))?></div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-8"><?php echo Form::input('password','password', null, array('class' => 'form-control', 'required' => 'required', 'id' => 'password'))?></div>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="col-sm-4 control-label">Password Confirm</label>
            <div class="col-sm-8"><?php echo Form::input('password','password_confirmation', null, array('class' => 'form-control', 'required' => 'required'))?></div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 text-right">
                <input type="submit" class="btn btn-primary" value="{{trans('Submit')}}">
            </div>
        </div>

        <input type="hidden" name="token" value="{{ $token }}">
    </div>
</div>

<?php echo Form::close();?>

<script>
    $(document).ready(function(){
        $('#reset-form').validate({
            rules : {
                password : {
                    minlength : 5
                },
                password_confirm : {
                    minlength : 5,
                    equalTo : "#password"
                }
            }
        });

    });
</script>


@stop