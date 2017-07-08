@extends('master.empty')

@section('head')
@parent
<link rel="stylesheet" href="{{url('media/bootstrap/css/bootstrap-datetimepicker.css')}}" type="text/css" media="all" />
<script src="{{url('media/bootstrap/js/moment.js')}}"></script>
<script src="{{url('media/bootstrap/js/bootstrap-datetimepicker.js')}}"></script>
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
@stop

@section('content')
<?php echo Form::open(array('class' => 'form-horizontal form-register', 'url' => 'register', 'id' => 'register-form'))?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{trans('Create Account')}}</h3>
    </div>
    <div class="panel-body">

        <?php echo Form::row('text', 'First Name', 'first_name', null, array('required' => true));?>

        <?php echo Form::row('text', 'Last Name', 'last_name', null, array('required' => true));?>

        <?php echo Form::row('text', 'Email', 'email', null, array('required' => true, 'email' => true));?>

        <?php echo Form::row('password', 'Password', 'password', null, array('required' => true));?>

        <?php echo Form::row('password', 'Password Confirm', 'password_confirm', null, array('required' => true));?>

        <?php echo Form::row('text', 'Phone', 'phone');?>

        <?php echo Form::row('text', 'Birth Date', 'birthday', null, array('class'=>'datepicker'));?>

        <?php echo Form::row('dropdown', 'Gender', 'gender', null, null,
            array(
                'collection' => array(1 => 'Male' , 0 => 'Female')
            ),
            'col-sm-2'
        );?>

        <div class="form-group">
            <div class="col-sm-12 text-right">
                <input type="submit" class="btn btn-primary" value="{{trans('Submit')}}">
            </div>
        </div>

    </div>
</div>

<?php echo Form::close();?>

<script type="text/javascript">
    $(function () {
        $('.datepicker').datetimepicker();

        $('#register-form').validate({
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