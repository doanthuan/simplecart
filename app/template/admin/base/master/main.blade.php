<!DOCTYPE html>
<head>
    @include('partial.head')
</head>
<body>
@include('partial.header')

    <div id="content">
        <div class="container">
            @include('partial.message')
            {{$toolbar}}
            @yield('content')
        </div>
    </div>

@include('partial.footer')
</body>
</html>
