<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Goxob {{trans('Admin')}}</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{url('admin/dashboard')}}">{{trans('Dashboard')}}</a></li>
                <li class="dropdown">
                    <a href="{{url('admin/catalog')}}" class="dropdown-toggle" data-toggle="dropdown">{{trans('Catalog')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li >
                            <a href="{{url('admin/catalog/product')}}">{{trans('Products')}}</a>
                        </li>
                        <li><a href="{{url('admin/catalog/category')}}">{{trans('Categories')}}</a></li>
                        <li class="dropdown-submenu">
                            <a href="{{url('admin/catalog/attribute')}}">{{trans('Attributes')}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/catalog/attribute')}}">{{trans('Attributes')}}</a></li>
                                <li><a href="{{url('admin/catalog/attribute-set')}}">{{trans('Attribute Sets')}}</a></li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{url('admin/catalog/review')}}">{{trans('Reviews')}}</a></li>
                        <li><a href="{{url('admin/catalog/vendor')}}">{{trans('Vendors')}}</a></li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="{{url('admin/sale')}}" class="dropdown-toggle" data-toggle="dropdown">{{trans('Sales')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/sale/order')}}">{{trans('Orders')}}</a></li>
                        <li><a href="{{url('admin/coupon/coupon')}}">{{trans('Coupons')}}</a></li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="{{url('admin/customer')}}" class="dropdown-toggle" data-toggle="dropdown">{{trans('Customers')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/customer/customer')}}">{{trans('Customers')}}</a></li>
                        <li><a href="{{url('admin/customer/address')}}">{{trans('Addresses')}}</a></li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="{{url('admin/cms')}}" class="dropdown-toggle" data-toggle="dropdown">{{trans('CMS')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/cms/content')}}">{{trans('Content')}}</a></li>
                        <li><a href="{{url('admin/cms/category')}}">{{trans('Category')}}</a></li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">{{trans('Extensions')}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="{{url('admin/slideshow')}}">{{trans('Slideshow')}}</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/slideshow/item')}}">{{trans('Items')}}</a></li>
                                <li><a href="{{url('admin/slideshow/group')}}">{{trans('Groups')}}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{trans('System')}} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{url('admin/user/user')}}">{{trans('Users')}}</a></li>
                        <li><a href="{{url('admin/locale/currency')}}">{{trans('Currency')}}</a></li>
                        <li><a href="{{url('admin/setting')}}">{{trans('Settings')}}</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{url('')}}" onclick="">Store Front</a></li>
                <li><a href="{{url('admin/logout')}}">Log Out</a></li>
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</div>

<script>
    $(document).ready(function(){
        var currentUrl = '{{{\Illuminate\Support\Facades\URL::current()}}}';
        if($('a[href="'+currentUrl+'"]').closest("li.dropdown").size() > 0 ){
            $('a[href="'+currentUrl+'"]').closest("li.dropdown").addClass('active');
        }
        else{
            $('a[href="'+currentUrl+'"]').closest("li").addClass('active');
        }
    });
</script>