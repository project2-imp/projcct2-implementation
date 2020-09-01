<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/adminStyle.css')}}" />


</head>
<body>


        <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand logout-link" href="/admin">log out</a>
                <a class="navbar-brand name-link" href="#">  {{$name[0]->adminName}}  </a>
                <a class="navbar-brand add-admin" href="#"> add new admin</a>
        </nav>

@yield('content')
@yield('test')
        <!--
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <script href="{{URL::asset('assets/js/bootstrap.js')}}"></script>

        @yield('javascript')
<script>
    //-----------start add admin-----------------------
    $(".add-admin").click(function () {
        console.log("ali");
        $.ajax(
            {
                type: "post",
                url: " {{route('addAdmin')}}",
                data: {
                    '_token' : "{{csrf_token()}}",
                    'name' : $(this).val(),
                },
                success: function ($data) {
                    console.log($data);

                },
        );
    });
    //-----------start add admin-----------------------

</script>

</body>
</html>
