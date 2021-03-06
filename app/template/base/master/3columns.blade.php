<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    @include('partial.head')
</head>
<body>

@include('partial.header')

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-2 hidden-xs hidden-sm">
                    <div class="col-left sidebar">
                        @section('left')
                        @show
                    </div>
                </div>
                <div class="col-md-8">
                    @yield('content')
                </div>
                <div class="col-md-2 hidden-xs hidden-sm">
                    <div class="col-right sidebar">
                        @section('right')
                        @show
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('partial.footer')

</body>
</html>
