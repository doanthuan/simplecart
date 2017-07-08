<div id="header">
    <div class="container">
        @section('header')

        <div class="row">
            <div class="col-sm-4 hidden-xs logo">
                <a href="{{url('')}}">
                    <img src="{{url('skin/base/images/logo.png')}}" title="Your Store" alt="Your Store">
                </a>
            </div>
            <div class="col-sm-4">
                @block('catalog/product-search')
            </div>
            <div class="col-sm-4 hidden-xs">
                @block('application/top-link')
            </div>
        </div>

        @show

    </div>
</div>

<div id="top-content">
    <div class="container">
        @section('top-content')
        @block('catalog/category-nav', array('template' => 'catalog.block.category-nav-menu'))

        @block('application/bread-crumb')

        @include('partial.message')
        @show
    </div>
</div>