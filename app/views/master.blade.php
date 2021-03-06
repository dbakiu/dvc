<!doctype html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    {{HTML::style('css/bootstrap.min.css')}}
    {{HTML::style('css/style.css')}}
    {{HTML::style('css/datepicker.css')}}

    {{HTML::script('js/jquery-2.1.0.min.js')}}
    {{HTML::script('js/bootstrap.min.js')}}
    {{HTML::script('js/bootstrap-datepicker.js')}}

    <title>Diamond Valeting Contracts - Management System</title>
</head>

<body>
    @if(Auth::user())
    @include('layout.menu')
    @endif
<div class="container">
    @include('layout.header')

    <div class="content">
        @yield('content')
    </div>

    <div class="clear"></div>

</div>

</body>

</html>