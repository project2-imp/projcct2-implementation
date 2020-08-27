<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-BOKING </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="assets/css/signUPstyle.css">
    <link rel="stylesheet" href="assets/css/companyStyle.css">
</head>
<body>

@yield('signup')
@yield('login')
@yield('createCompany')
@yield('loginCompany')
@yield('inputVCode')
<form method="GET" action="{{route('index')}}">
<div class="form-group">

</div>
</form>
<!-- JS -->

<script href="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
<script href="{{URL::asset('assets/js/jquery-v3.5.0.js')}}"></script>

<script src="asstes/js/main.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>