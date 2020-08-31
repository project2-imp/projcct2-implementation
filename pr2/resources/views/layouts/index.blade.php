@extends('layouts.master')
@section('trips')

   <div class="row">

       <div class="col-lg-12 best-compaines-place">
           <h1 class="best-companies-title">Best Companies</h1>
       </div>

       <div class="col-lg-12 col-xs12 trips-place">
           <h1 class="trips-title">Trips</h1>
       </div>
   </div>

   <!-- start booking-place-->
<div class="booking-place">
    <div class="wrapper fadeInDown"><!-- start fadeInDown-->
        <div id="formContent"><!-- start formContent-->

            <div class="fadeIn first">
                <h1 style="font-family: 'Agency FB'"> fill information to complete booking</h1>
            </div>

            <small class="seats-error" style="color:red">number of seats is greater than 5 </small>
            <input type="number" id="booking-seats" class="fadeIn second booking-seats" name="booking-seats"  min="1" max="5" placeholder="number of seats" >
                <p>___________________________________</p>
                <h3 class="payment-way-par">select payment way</h3>
                <input type="submit" class="fadeIn fourth payment-cash-btn" value="payment cash">
                <!-- start payment-cash-place-->
                    <div class="payment-cash-place">
                        <small class="info-error" style="color:red">your information incorrect </small>
                        <p>input your password</p>
                        <input type="password" class="fadeIn fourth customer-password" placeholder="" >
                        <p>input your phone number</p>
                        <input type="number" class="fadeIn fourth customer-phoneNumber" placeholder="">
                        <input type="submit" class="fadeIn fourth  btn btn-danger accept-cach-payment " value="accept">
                    </div>
                <!-- end payment-cash-place-->
                <input type="submit" class="fadeIn fourth payment-byCard-btn" value="payment by card ">
                <!-- start payment-byCard-place-->
                    <div class="payment-byCard-place">
                        <h3> payment by card place</h3>
                    </div>
                <!-- end payment-byCard-place-->
                </br>
                <button  class="fadeIn fourth btn btn-danger cancel-btn" >cancel</button>
        </div><!-- end formContent-->
    </div><!-- end fadeInDown-->
</div><!-- end booking-place-->

@stop


@section('javascript')


<script>
    $(".booking-place").hide();
    $(".payment-cash-place").hide();
    $(".payment-byCard-place").hide();
    $(".seats-error").hide();
    $(".info-error").hide();
    $(".booking-pending-msg").hide();
    showTrips();
    showBestCompanies();
    //start showTrips
    function showTrips() {
        $.ajax({
           type: "get",
           url: "{{route('getTrips')}}",

           success: function ($data) {
               console.log($data);
                    console.log("aaaaa");
               console.log($data.length);
               for(var $x=0; $x<$data[0].length;$x++){
                   //console.log($data[x].tripID);
                    $(".trips-place").append("<div class='card trips-card' >"+
                       "<div class='card-head'>"+
                        "<img  src='"+'uploads/companiesIcons/'+$data[1][$x][0].imagePath+"' class='card-img-top' alt='company logo'>"+
                        "</div>"+
                        "<div class='card-body'>"+
                        "<div class='bar'>" +
                        "<div class='emptybar'></div>"+
                        "<div class='filledbar'></div>"+
                        "</div>"+
                        "<h5 class='startStation'>"+"<span class='startStation-title'>"+"<img src=assets/images/tripIcons/start-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='startStation-value'>"+ $data[0][$x].startStation +"</span>" +"</br>" +
                        "<span class='stopStation-title'>"+"<img src=assets/images/tripIcons/stop-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='stopStation-value'>" +$data[0][$x].stopStation + "</span>"+"</h5>"+
                        "<p class='card-text-trips'>"+"<span class='trip-dep-date-title'>" +"<img src=assets/images/tripIcons/dep-date.png style='width: 20px ;height: 20px'>"+"</span>" +"<span class='trip-dep-date-value'>"+$data[0][$x].departureDate + "</span>"+ "</br>"+
                        "<span class='num-seats-title'>"+"<img src=assets/images/tripIcons/seats.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='num-seats-value'>"+$data[0][$x].numSeats+"</span>"+"</br>"+
                        "<span class='price-For-Seat-title'>"+"<img src=assets/images/tripIcons/price.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='price-For-Seat-value'>"+$data[0][$x].priceForSeat+"sp"+"</span>"+"</p>"+
                        " <a href='#' class='btn btn-dark booking-btn' value="+$data[0][$x].tripID+">book a trip</a>"+

                        "</div>"+
                        "</div>"

                    );
               }


           },
            error: function($re){
               console.log($re);
            }
        });
    }
    //end showTrips

    //start showBestCompanies
    function showBestCompanies() {
        $.ajax({
            type: "get",
            url: "{{route('showBestCompanies')}}",
            success: function ($data) {
                console.log($data);
                console.log("ali");

                for(var $x = 0 ; $x <5 ; $x++){

                    $(".best-compaines-place").append("<div class='card best-companies-card ' style='width: 18rem;'>"+
                        "<img src='uploads/companiesIcons/"+$data[$x].imagePath+" ' class='card-img-top' alt='company Logo' style='width: 250px; height: 250px;'>"+
                        "<div class='card-body'>"+
                    "<a href='#' class='btn btn-primary'>more details</a>"+
                    "</div>"+
                    "</div>"
                    );
                }

            }

        });
    }
    //end showBestCompanies

    //start booking-btn
    $(".trips-place").delegate('.booking-btn','click',function () {
        $(".header").hide();
        $(".trips-place").hide();
        $(".best-compaines-place").hide();
        $(".customer-footer").hide();
        $(".booking-place").slideDown();

    })
    //end booking-btn

    //start payment-cash-btn
    $(".booking-place").delegate('.payment-cash-btn','click',function () {
        $(".payment-cash-place").slideToggle();
    });//end payment-cash-btn

    //start payment-byCard-btn
    $(".booking-place").delegate('.payment-byCard-btn','click',function () {
        $(".payment-byCard-place").slideToggle();
    });//end payment-cash-btn

    //start cancel-btn
    $(".booking-place").delegate('.cancel-btn','click',function () {
       backBtn();
    });//end cancel-btn

    //start accept-cach-payment
    $(".booking-place").delegate('.accept-cach-payment','click',function () {

        console.log("number:"+$(".booking-seats").val());
        $.ajax({

            type: "post",
            url: "{{route('addPendingPassenger')}}",
            data: {
                _token: "{{csrf_token()}}",
                password: $(".customer-password").val(),
                phoneNumber: $(".customer-phoneNumber").val(),
                seatsNumber:$(".booking-seats").val(),
                tripID: $(".booking-btn").attr('value'),

            },
            success: function ($data) {

                if($data == 'error in number of seats'){
                    $(".seats-error").fadeIn();
                    $(".seats-error").delay(4000);
                    $(".seats-error").fadeOut();


                }
                if($data == 'error in customer info'){
                    $(".info-error").fadeIn();
                    $(".info-error").delay(4000);
                    $(".info-error").fadeOut();


                }
                if($data == 'passenger added'){
                    alert('booking pending waiting to accepting from company admin');
                    backBtn();
                }
            }
        });
    });
    //end accept-cach-payment

    function backBtn(){
        $(".header").fadeIn();
        $(".trips-place").fadeIn();
        $(".best-compaines-place").fadeIn();
        $(".customer-footer").fadeToggle();
        $(".booking-place").fadeToggle();
    }
</script>

@stop
