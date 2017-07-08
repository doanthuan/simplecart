<?php echo Form::open(array('url' => 'login', 'id' => 'login-form'))?>
    <div class="form-group">
        <label for="email">{{trans('Email Address')}}</label>
        <?php echo Form::text('email', null, array('class' => 'form-control email required', 'placeholder' => 'Enter Email'))?>
    </div>

    <div class="form-group">
        <label for="password">{{trans('Password')}}</label>
        <?php echo Form::input('password','password', null, array('class' => 'form-control required', 'placeholder' => 'Password'))?>
    </div>

    <div class="form-group">
        <a href="{{ url('remind') }}">{{trans('Forgotten Password')}}</a>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="{{trans('login')}}">
    </div>

    @if (isset($backUrl))
        <input type="hidden" name="back_url" value="{{$backUrl}}">
    @endif

<?php echo Form::close();?>

<script>
    $(document).ready(function(){
        $("#login-form").validate();
    });
</script>