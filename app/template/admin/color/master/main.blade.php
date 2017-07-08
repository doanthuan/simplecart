<!DOCTYPE html>
<head>
    @include('partial.head')
</head>
<body>
@include('partial.header')

@include('partial.sidebar')

    <div id="content" class="content">
            @include('partial.message')
            {{$toolbar}}
            @yield('content')
    </div>

@include('partial.footer')

<script src="{{url('skin/admin/color/js/plugins/jquery-ui.min.js')}}"></script>
<script src="{{url('skin/admin/color/js/plugins/jquery.slimscroll.min.js')}}"></script>

<script src="{{url('skin/admin/color/js/dashboard.min.js')}}"></script>
<script src="{{url('skin/admin/color/js/apps.min.js')}}"></script>

<script src="{{url('skin/admin/color/js/plugins/jquery.gritter.js')}}"></script>
<script src="{{url('skin/admin/color/js/plugins/jquery.flot.min.js')}}"></script>
<script src="{{url('skin/admin/color/js/plugins/jquery.flot.time.min.js')}}"></script>
<script src="{{url('skin/admin/color/js/plugins/jquery.flot.resize.min.js')}}"></script>
<script src="{{url('skin/admin/color/js/plugins/jquery.flot.pie.min.js')}}"></script>
<script src="{{url('skin/admin/color/js/plugins/jquery.sparkline.js')}}"></script>
<div class="jvectormap-label"></div>
</body>
</html>
