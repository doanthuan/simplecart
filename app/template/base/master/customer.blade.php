<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    @include('partial.head')
    <link rel="stylesheet" href="{{url('media/bootstrap/css/bootstrap-datetimepicker.css')}}" type="text/css" media="all" />

    <script src="{{url('media/system/js/jquery.validate.min.js')}}"></script>
    <script src="{{url('media/bootstrap/js/moment.js')}}"></script>
    <script src="{{url('media/bootstrap/js/bootstrap-datetimepicker.js')}}"></script>
</head>
<body>
    @include('partial.header')

    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-2 hidden-xs hidden-sm">
                    <div class="col-left sidebar">
                        @section('left')
                        @block('customer/customer-menu')
                        @show
                    </div>
                </div>
                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('partial.footer')
</body>
</html>
