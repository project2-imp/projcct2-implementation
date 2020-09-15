@extends('layouts.master')
@section('trips')
    <div>
        @if($status[0] === 1)
            <input type="hidden" class="customerID" value={{$status[1]->email}} >
        @elseif($status[0] === 0)
                <input type="hidden" class="customerID" value="guest" >
        @endif
    </div>
   <div class="row">
       <h1 class="best-companies-title">Best Companies</h1>
       <div class="col-lg-12 best-compaines-place">

       </div>

       <h1 class="trips-title">Trips</h1>
       <div class="col-lg-12 col-xs12 trips-place">
       </div>

   </div>

    <!-- ------------------------------- -->


    <!-- ------------------------------- -->
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
                        <small class="info-error" style="color:red">your information incorrect </small>
                        <small class="error-payment-msg" style="color: red;"></small>

                        <p>email</p>
                        <input type="email" class="fadeIn fourth customer-email" placeholder="">

                        <p>password</p>
                        <input type="password" class="fadeIn fourth customer-byCard-password" placeholder="" >

                        <p>card number</p>
                        <input type="number" class="fadeIn fourth customer-card" placeholder="" >

                        <input type="submit" class="fadeIn fourth  btn btn-danger accept-card-payment " value="accept">

                    </div>
                <!-- end payment-byCard-place-->
                </br>
                <button  class="fadeIn fourth btn btn-danger cancel-btn" >cancel</button>
        </div><!-- end formContent-->
    </div><!-- end fadeInDown-->
</div>
    <!-- end booking-place-->

    <!-- start companies area-->
    <div class="companies-area ">

        <div class="container">


            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content" style="background-color: white">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Companies</h4>
                        </div>
                        <div class="modal-body">



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- end companies area-->

@stop


@section('javascript')


<script>
    var companyID;
    var tripID;
    var seatPrice;
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
        $(".trips-place").fadeIn().html('<div class="spinner-border text-light" role="status">'+
            '<span class="sr-only">Loading...</span>'+
        '</div>');
        var customerID=$(".customerID").val();
        console.log("customerID:"+customerID);
        $.ajax({

           type: "get",
           url: "{{url('getTrips')}}/"+customerID,

           success: function ($data) {
               console.log("data after simillteryy:");
               console.log($data);
                    console.log("aaaaa");
               console.log("length:"+$data[0].length);
               for(var $x=$data[0].length-1; $x>=0;$x--){

                    $(".trips-place").append("<div class='card trips-card'>"+
                       "<div class='card-head'>"+
                       "<img  src='"+'uploads/companiesIcons/'+$data[1][$x][0].imagePath+"' class='card-img-top' alt='company logo' style='width: 300px; height: 200px'> "+
                        "</div>"+
                        "<div class='card-body'>"+

                        "<h5 class='startStation'>"+"<span class='startStation-title'>"+"<img src=assets/images/tripIcons/start-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='startStation-value'>"+ $data[0][$x].startStation +"</span>" +"</br>" +
                        "<span class='stopStation-title'>"+"<img src=assets/images/tripIcons/stop-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='stopStation-value'>" +$data[0][$x].stopStation + "</span>"+"</h5>"+
                        "<p class='card-text-trips'>"+"<span class='trip-dep-date-title'>" +"<img src=assets/images/tripIcons/dep-date.png style='width: 20px ;height: 20px'>"+"</span>" +"<span class='trip-dep-date-value'>"+$data[0][$x].departureDate + "</span>"+ "</br>"+
                        "<span class='num-seats-title'>"+"<img src=assets/images/tripIcons/seats.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='num-seats-value'>"+$data[0][$x].numSeats+"</span>"+"</br>"+
                        "<span class='num-seats-title'>"+"<img src=assets/images/tripIcons/seats.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='num-seats-value'>"+$data[0][$x].availableSeats+"</span>"+"</br>"+
                        "<span class='price-For-Seat-title'>"+"<img src=assets/images/tripIcons/price.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='price-For-Seat-value' style='color:red'>"+$data[0][$x].priceForSeat+"sp"+"</span>"+"</p>"+
                        " <a href='#' class='btn btn-dark booking-btn' seatPrice='"+$data[0][$x].priceForSeat+"' companyID='"+$data[0][$x].companyID+"' value="+$data[0][$x].tripID+">book a trip</a>"+

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
        $(".best-compaines-place").fadeIn().html('<div class="spinner-border text-light" role="status">'+
            '<span class="sr-only">Loading...</span>'+
            '</div>');
        $.ajax({
            type: "get",
            url: "{{route('showBestCompanies')}}",
            success: function ($data) {
                //console.log($data);
                console.log("ali");

                for(var $x = 0 ; $x <5 ; $x++){

                    $(".best-compaines-place").append("<div  class='card best-companies-card ' >"+
                        "<img src='uploads/companiesIcons/"+$data[$x].imagePath+" ' class='card-img-top' alt='company Logo' style='width: 250px; height: 200px;'>"+

                    "</div>"
                    );
                }

            }

        });
    }
    //end showBestCompanies

    //start booking-btn
    $("body").delegate('.booking-btn','click',function () {
        $(".header").hide();
        $(".trips-place").hide();
        $(".best-compaines-place").hide();
        $(".customer-footer").hide();
        $(".booking-place").slideDown();
        $('#result-search-modal').modal('up');
        companyID = $(this).attr('companyID');
        tripID = $(this).attr('value');
        seatPrice = $(this).attr('seatPrice');
        console.log("booking btn ");
    });
    //end booking-btn

    //start payment-cash-btn
    $(".booking-place").delegate('.payment-cash-btn','click',function ()    {
        $(".payment-cash-place").slideToggle();
    });//end payment-cash-btn

    //start payment-byCard-btn
    $(".booking-place").delegate('.payment-byCard-btn','click',function () {
        $(".payment-byCard-place").slideToggle();
    });//end payment-cash-btn

    //start cancel-btn
    $(".booking-place").delegate('.cancel-btn','click',function () {

            backBtn();
        location.reload();


        });//end cancel-btn

    //start accept-cach-payment
    $(".booking-place").delegate('.accept-cach-payment','click',function () {

        console.log("number:"+$(".booking-seats").val());
       console.log("comanyID:"+companyID);
        console.log("tripID:"+tripID);
        $.ajax({

            type: "post",
            url: "{{route('addPendingPassenger')}}",
            data: {
                _token: "{{csrf_token()}}",
                password: $(".customer-password").val(),
                phoneNumber: $(".customer-phoneNumber").val(),
                seatsNumber:$(".booking-seats").val(),
                tripID: tripID,
                companyID: companyID,

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

    //start accept-card-payment
    $(".booking-place").delegate('.accept-card-payment','click',function(){
        console.log("comanyID:"+companyID);
        console.log("tripID:"+tripID);
        console.log("seatPrice:"+seatPrice);
        console.log("number of seats:"+ $(".booking-seats").val());
        console.log("customer email:"+ $(".customer-email").val());
        console.log("customer password:"+ $(".customer-byCard-password").val());
        console.log("customer caed number:"+ $(".customer-card").val());

        $.ajax({
           type: "post",
           url: "{{route('customerCardPayment')}}",
           data: {
               _token: "{{csrf_token()}}",
               companyID: companyID,
               tripID: tripID,
               seatPrice: seatPrice,
               seatsNumber: $(".booking-seats").val(),
               email: $(".customer-email").val(),
               password: $(".customer-byCard-password").val(),
               cardNumber:  $(".customer-card").val(),
           },
            success: function ($data) {

               if($data =="booking successfully" ){
                   alert('booking successfully');
                   backBtn();
                   location.reload();
               }else{
                   $(".error-payment-msg").fadeIn().text($data).delay(2000).fadeOut();
               }
            }
        });

    });
    //end accept-card-payment

   //start backBtn
    function backBtn(){
        $(".header").fadeIn();
        $(".trips-place").fadeIn();
        $(".best-compaines-place").fadeIn();
        $(".customer-footer").fadeToggle();
        $(".booking-place").fadeToggle();
    }
    //back backBtn



    //start showTrips
    function showCompanyTrips(companyID){
        $.ajax({
            type: "get",
            url: "{{url('showTripsResult')}}/"+companyID,
            success: function($data){
                console.log($data);
               // $('#result-search-modal').modal('toggle');
                clear(".companies-result");
                for(var $x=0; $x<$data.length;$x++){

                    $(".companies-result").append("<div class='card trips-card'>"+

                        "<div class='card-body'>"+
                        "<div class='bar'>" +
                        "<div class='emptybar'></div>"+
                        "<div class='filledbar'></div>"+
                        "</div>"+
                        "<h5 class='startStation'>"+"<span class='startStation-title'>"+"<img src=assets/images/tripIcons/start-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='startStation-value'>"+ $data[$x].startStation +"</span>" +"</br>" +
                        "<span class='stopStation-title'>"+"<img src=assets/images/tripIcons/stop-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='stopStation-value'>" +$data[$x].stopStation + "</span>"+"</h5>"+
                        "<p class='card-text-trips'>"+"<span class='trip-dep-date-title'>" +"<img src=assets/images/tripIcons/dep-date.png style='width: 20px ;height: 20px'>"+"</span>" +"<span class='trip-dep-date-value'>"+$data[$x].departureDate + "</span>"+ "</br>"+
                        "<span class='num-seats-title'>"+"<img src=assets/images/tripIcons/seats.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='num-seats-value'>"+$data[$x].numSeats+"</span>"+"</br>"+
                        "<span class='num-seats-title'>"+"<img src=assets/images/tripIcons/seats.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='num-seats-value'>"+$data[$x].availableSeats+"</span>"+"</br>"+
                        "<span class='price-For-Seat-title'>"+"<img src=assets/images/tripIcons/price.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='price-For-Seat-value' style='color:red'>"+$data[$x].priceForSeat+"sp"+"</span>"+"</p>"+
                        " <a href='#' class='btn btn-dark booking-btn' seatPrice='"+$data[$x].priceForSeat+"' companyID='"+$data[$x].companyID+"' value="+$data[$x].tripID+">book a trip</a>"+

                        "</div>"+
                        "</div>"

                    );
                }

            },
            error: function($da){
                console.log($da);
            },
        })
    }
    //end showTrips

    //start show companyTripsResault
    $(".companies-result-place").delegate('.trips-resault','click',function(){
        console.log($(this).attr('companyID'));
        showCompanyTrips($(this).attr('companyID'));
    });
    //end show companyTripsResault
</script>

@stop
