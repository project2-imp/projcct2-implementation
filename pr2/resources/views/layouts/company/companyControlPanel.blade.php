@extends('layouts.company.companyMaster')
@section('dashboard')

<!-- start nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">{{ $companyName[0]->name }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" profile-link href="#"><img src="{{url('/assets/images/companyIcons/profile.png')}}" style="width:50px;height:60px;"> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Trips</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link add-trip-link" href="#"> Add trip</a>
                </li>

            </ul>
        </div>
    </nav>
<!-- end nav -->

<!-- start links -->
    <div class="row">
        <div class="col-lg-3 completed-trips-number">
            <h3 class="completed-trips">payment requests:</h3>
        </div>
        <div class="col-lg-3 trips-number">
            <h3>trips number</h3>
        </div>
        <div class="col-lg-3 customers-number">
            <h3>customers number</h3>
        </div>

    </div>
<!-- end links -->

    <div class="row">
        <!-- ---start content--->
        <div class="col-lg-8 content">
            <h1>ali</h1>
        </div>
        <!-- ---end content--->

        <div class="form-group trip-added-message">
            <label class="alert alert-success"> trip added succesfully</label>
        </div>
        <div class="form-group blocked-company-alert">
            <label class="alert alert-danger">your company is blocked you can't add any trips</label>
        </div>


        <div class=" col-lg-4 add-trip-area">

        <!-- ---start add trip area--->

            <input type="hidden" name="companyName" value="{{$companyName[0]->name}}">
            <div class="form-group ">
                <label for="usr">start station:</label>
                <input type="text" class="form-control" name="startStation"  placeholder="start station">
            </div>

            <div class="form-group">
                <label for="pwd">stop station:</label>
                <input type="text" class="form-control" name="stopStation" placeholder="stop station">
            </div>

            <div class="form-group">
                <label for="pwd">Departure date:</label>
                <input type="date" class="form-control" name="DepartureDate" placeholder="Departure date">
            </div>

            <div class="form-group">
                <label for="pwd">number of seats:</label>
                <input type="number" class="form-control" name="seatsNum" placeholder="number of seats">
            </div>

            <div class="form-group">
                <label for="pwd">price for 1 seat:</label>
                <input type="number" class="form-control" name="price" placeholder="prise for 1 seat">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success add-trip-btn" value="add">
            </div>


            </div>
        <!-- ---start add trip area--->

    </div>
@stop
@section('javascrip')

<script>
    $(".trip-added-message").hide();
    $(".blocked-company-alert").hide();
    $(".add-trip-area").hide();
    //start add trip link
    $(".add-trip-link").click(function () {
        $(".add-trip-area").slideToggle();
        $(".trip-added-message").hide();
        $(".blocked-company-alert").hide();

    });
    //end add trip link

    //start addTrip proccess
    $(".add-trip-btn").click(function () {
        $(".add-trip-area").slideToggle();
            $.ajax({
               type: "post",
               url: "{{route('addTrip')}}",
               data: {
                   '_token' :'{{csrf_token()}}',
                   'companyName':$(".companyName").val(),
                   'startStation':$(".startStation").val(),
                   'stopStation':$(".stopStation").val(),
                   'departureDate':$(".DepartureDate").val(),
                   'seatsNum':$(".seatsNum").val(),
                   'price':$(".price").val(),
                },
                success: function ($data) {
                    console.log($data);
                    if($data == 'blocked'){
                        console.log("blocked");

                        $(".blocked-company-alert").slideDown();

                    }
                    else{
                        $(".trip-added-message").slideDown();
                        console.log("accepted");
                    }


                },
                error: function ($reject) {
                    console.log($reject);
                }

            });
    })
    //end addTrip proccess
</script>
@stop