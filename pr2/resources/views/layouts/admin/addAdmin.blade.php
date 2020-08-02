<!DOCTYPE html>
<html>

<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link  href="assets/css/adminFormsStyle.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>


<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <h1 style="font-family: 'Agency FB'"> Input new admin Information</h1>
        </div>

        <!-- Login Form -->
        <form method="post" action="{{route('addAdmin')}}">
            {{ csrf_field() }}
            <input type="text" id="name" class="fadeIn second" name="name" placeholder="name">
            <input type="email" id="email" class="fadeIn second" name="email" placeholder="email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Add">

        </form>


        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

    </div>
</div>
</body>

</html>