<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/headerStyle.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/footerStyle.css')}}" />



</head>

<body >

@include('includes.header')
@yield('trips')
@include('includes.footer')

 <!-- -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@yield('javascript')
@yield('headerJS')
</body>
</html>
