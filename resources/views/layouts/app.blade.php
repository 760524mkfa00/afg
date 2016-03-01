<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="/img/AFG-sml.png"/>
    {{--<link rel="shortcut icon" type="image/png" href="http://eg.com/favicon.png"/>--}}
    <title>Annual Facilities Grant</title>

    <!-- JavaScripts -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{--<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>--}}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {{--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">--}}
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        div.tooltip-inner {
            max-width: 450px;
           font-size: 1.5em;
        }
    </style>
</head>
<body id="app-layout">
    @include ('_partials.nav')
    @include ('_partials.flashMessage')
    @yield('content')


</body>
</html>
