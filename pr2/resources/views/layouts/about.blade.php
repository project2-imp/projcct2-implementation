<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/headerStyle.css')}}" />
    <link rel="stylesheet" href="{{URL::asset('assets/css/footerStyle.css')}}" />


</head>

<body style="color: white;  font: small-caps bold 18px/1 sans-serif">

<img src="assets/images/Logo/tripoo.png">
<div class="row">
	<div class="col-xs-12">
		<h1 style="color: #4da6ff">Tripboo</h1>
		<p style="color: #4da6af"> we are provide e-booking service for passengers to take them trips and select them favoraite companies
	</p>
	<button class="btn btn-default back-btn">back</button>
	</div>


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $(".back-btn").click(function () {
        history.go(-1);

    });
</script>

</body>