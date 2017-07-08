@section('head')
<title>{{$siteTitle}}</title>
<meta name="description" content="{{$metaDescription}}" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="stylesheet" href="{{url('media/bootstrap/css/bootstrap.css')}}" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('skin/base/css/style.css')}}" type="text/css" media="all" />
<link rel="stylesheet" href="{{url('skin/base/css/catalog.css')}}" type="text/css" media="all" />

<script src="{{url('media/bootstrap/js/jquery.min.js')}}"></script>
<script src="{{url('media/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('media/system/js/core.js')}}"></script>

@show