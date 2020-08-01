<!DOCTYPE html>

    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-BOOKING</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/companyStyle.css')}}" />

    </head>
    <body>


    @yield('dashboard')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script href="{{URL::asset('assets/js/bootstrap.js')}}"></script>
    @yield('javascrip')

    </body>
</html>