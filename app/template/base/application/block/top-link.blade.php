<div class="links pull-right">
    <a href="{{url('cart')}}">{{trans('My Cart')}}
    <?php if(\Goxob\Sale\Helper\Cart::hasCartItems()){?>
        (<?php echo count(\Goxob\Sale\Helper\Cart::getCartItems())?>)
    <?php } ?>
    </a>
    <?php if (Auth::check()){ ?>
        <a href="{{url('customer')}}">{{trans('My Account')}}</a>
        <a href="{{url('logout')}}">{{trans('Logout')}}</a>
    <?php }else{ ?>
        <a href="{{url('register')}}">{{trans('Register')}}</a>
        <a href="{{url('login')}}">{{trans('Login')}}</a>
    <?php } ?>
</div>