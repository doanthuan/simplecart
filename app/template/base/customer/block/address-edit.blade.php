
<div class="form-group">
    <div class="row">
        <label class="col-sm-4 " for="{{$type}}_first_name">{{trans('First Name')}}</label>
        <label class="col-sm-4 " for="{{$type}}_last_name">{{trans('Last Name')}}</label>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?php echo Form::text($type.'_first_name', null, array('class' => 'form-control required', 'placeholder' => 'Enter first name'))?>
        </div>
        <div class="col-sm-4">
            <?php echo Form::text($type.'_last_name', null, array('class' => 'form-control required', 'placeholder' => 'Enter last name'))?>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="{{$type}}_phone">{{trans('Phone')}}</label>
    <div class="row">
        <div class="col-sm-4">
            <?php echo Form::text($type.'_phone', null, array('class' => 'form-control required', 'placeholder' => 'Enter phone number'))?>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="{{$type}}_address">{{trans('Address')}}</label>
    <?php echo Form::text($type.'_address', null, array('class' => 'form-control required', 'placeholder' => 'Enter address'))?>
</div>
<div class="form-group">
    <label for="{{$type}}_city">{{trans('City')}}</label>
    <div class="row">
        <div class="col-sm-4">
            <?php echo Form::text($type.'_city', null, array('class' => 'form-control required', 'placeholder' => 'Enter city'))?>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <label class="col-sm-4 " for="{{$type}}_state">{{trans('State')}}</label>
        <label class="col-sm-4 " for="{{$type}}_zipcode">{{trans('Zip Code')}}</label>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?php echo Form::text($type.'_state', null, array('class' => 'form-control', 'placeholder' => 'Enter state'))?>
        </div>
        <div class="col-sm-4">
            <?php echo Form::text($type.'_zipcode', null, array('class' => 'form-control', 'placeholder' => 'Enter zip code'))?>
        </div>
    </div>
</div>