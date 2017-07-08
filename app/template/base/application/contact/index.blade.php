@extends('master.2columns-right')

@section('head')
@parent
<script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
@stop

@section('right')
@parent
@block('catalog/product-block', array('title' => trans('Most View Products'), 'orderBy' => 'hits DESC', 'limit' => 5, 'cols' => 1))
@stop

@section('content')

<div class="page-header">
    <h1>{{trans('Contact Us')}}</h1>
</div>

<?php echo Form::open(array('class' => '', 'url' => 'contact/post-contact', 'id' => 'contact-form'))?>
<div class="row">
    <div class="col-md-10">
        <div class="content">

        <div class="form-group">
            <div class="row">
                <label class="col-sm-6 " for="name">{{trans('Name')}}</label>
                <label class="col-sm-6 " for="email">{{trans('Email')}}</label>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php echo Form::text('name', null, array('class' => 'form-control required', 'placeholder' => 'Enter your name'))?>
                </div>
                <div class="col-sm-6">
                    <?php echo Form::text('email', null, array('class' => 'form-control required email', 'placeholder' => 'Enter your email'))?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="phone">{{trans('Phone')}}</label>
            <div class="row">
                <div class="col-sm-6">
                    <?php echo Form::text('phone', null, array('class' => 'form-control required', 'placeholder' => 'Enter phone number'))?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="phone">{{trans('Content')}}</label>
            <div class="row">
                <div class="col-sm-12">
                    <?php echo Form::textarea('content', null, array('class' => 'form-control required', 'placeholder' => ''))?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="phone">{{trans('Captcha')}}</label>
            <div class="row">
                <div class="col-sm-4">
                    <?php echo Form::text('captcha', null, array('class' => 'form-control required', 'placeholder' => ''))?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo HTML::image(Captcha::img(), 'Captcha image');?>
        </div>

        <br><br>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" class="btn btn-sm btn-primary" name="submit" value="{{trans('Submit')}}">
            </div>
        </div>

        </div>
    </div>
</div>
<?php echo Form::close();?>

<script>
    $(document).ready(function(){
        $('#contact-form').validate();
    });
</script>

@stop