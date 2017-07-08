<!DOCTYPE html>
<head>
    @include('partial.head')
</head>
<body>

<div id="content">
    <div class="container">
        @include('partial.message')
        @yield('content')
    </div>
</div>

@include('partial.footer')
</body>
</html>
