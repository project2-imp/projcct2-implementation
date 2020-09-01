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
                    <!-- add trip list -->
                    <ul>

                        <div class="form-group trip-added-message">
                            <label class="alert alert-success"> trip added succesfully</label>
                        </div>
                        <div class="form-group blocked-company-alert">
                            <label class="alert alert-danger">your company is blocked you can't add any trips</label>
                        </div>


                        <div class=" col-lg-4 add-trip-area">

                            <!-- ---start add trip area--->

                            <input type="hidden" class="companyName" name="companyName" value="{{$companyName[0]->name}}">
                            <div class="form-group ">
                                <label for="usr">start station:</label>
                                <input type="text" class="form-control startStation" name="startStation"   placeholder="start station">
                            </div>

                            <div class="form-group">
                                <label for="pwd">stop station:</label>
                                <input type="text" class="form-control stopStation" name="stopStation" placeholder="stop station">
                            </div>

                            <div class="form-group">
                                <label for="pwd">Departure date:</label>
                                <input type="date" class="form-control DepartureDate" name="DepartureDate" placeholder="Departure date">
                            </div>

                            <div class="form-group">
                                <label for="pwd">number of seats:</label>
                                <input type="number" class="form-control seatsNum" name="seatsNum" placeholder="number of seats">
                            </div>

                            <div class="form-group">
                                <label for="pwd">price for 1 seat:</label>
                                <input type="number" class="form-control price" name="price" placeholder="prise for 1 seat">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-success add-trip-btn" value="add">
                            </div>


                        </div>
                        <!-- ---end add trip area--->

                    </ul>
                </li>

            </ul>
        </div>
    </nav>
<!-- end nav -->

<!-- start links -->
    <div class="row links">
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

<!-- ---start content--->
    <div class="row content" id="content">
        <!-- start active-trips-area -->
        <div class="col-lg-8 active-trips-area">
            <!-- Table -->
            <h3 style="color: #4cae4c;">Active trips:</h3>
            <table class="table active-trips-table">
                <thead class="active-trips-table-head">
                <tr>

                    <th>Trip ID</th>
                    <th>Start station</th>
                    <th>stop station</th>
                    <th>departureDate</th>
                    <th>numSeats</th>
                    <th>priceForSeat</th>
                </tr>
    </thead>
                <tbody class="customers-table-content" style="color: gray">

                </tbody>
            </table>
            <!-- start edit-trip-area -->
            <div class="edit-trip-area">
                <div class="form-group ">
                    <label for="usr">Departure Date:</label>
                    <input type="date" class="form-control Date" name="DepartureDate"   placeholder="start station">
                </div>

                <div class="form-group">
                    <label for="pwd">Number of Seats:</label>
                    <input type="number" class="form-control seatsNumber" name="seatsNum" placeholder="stop station">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success accept-edit-btn" tripId="" name="accept-edit" value="edit">
                </div>
            </div>
            <!-- end edit-trip-area -->

        </div>
        <!-- end active-trips-area -->

        <!-- start pending-customers-area -->
        <div class="col-lg-4 pending-customers">
            <button class="btn btn-info pending-customers-btn">pending customers</button>
            <ul class="list-group pending-customers-list">


            </ul>
        </div>
        <!-- start followers-area -->
    </div>
<!-- ---end content--->

@stop
@section('javascrip')

<script>
    var tripID=0;
    var counter=0;
    $(".trip-added-message").hide();
    $(".blocked-company-alert").hide();
    $(".add-trip-area").hide();
    $(".edit-trip-area").hide();
    $(".pending-customers-list").hide();
    loadTrips();

    //start add trip link
    $(".add-trip-link").click(function () {
        counter++;
        clear(".customers-table-content");
        loadTrips();

        console.log(counter);
        if(counter %2 == 0){
            $(".add-trip-area").slideToggle();
            $(".links").show(500);
            $(".content").show(500);

        }
        else{
            $(".links").hide(500);
            $(".content").hide(500);
            $(".add-trip-area").slideToggle();


        }
        $(".trip-added-message").hide();
        $(".blocked-company-alert").hide();
       // $(".trips-number").toggle();
       // $(".customers-number").toggle();


    });
    //end add trip link

    //start addTrip proccess
    $("body").delegate('.add-trip-btn','click',function () {


        $.ajax({

            type: "post",
            url: "{{route('addTrip')}}",
            data:{
                '_token': "{{csrf_token()}}",
                'companyName':$(".companyName").val(),
                'startStation': $(".startStation").val(),
                'stopStation': $(".stopStation").val(),
                'departureDate': $(".DepartureDate").val(),
                'seatsNum': $(".seatsNum").val(),
                'price': $(".price").val(),

            },
            success: function ($data) {
                console.log($data);
                if($data == "blocked"){
                    $(".blocked-company-alert").slideToggle();
                }
                else{
                    $(".trip-added-message").slideDown();
                }
            },
            error: function ($reject) {
                console.log($reject);
            }
        })

    });
    //end addTrip proccess

    //------------------start load trips----------------
    function loadTrips(){
    $.ajax({
        type: "post",
        url: "showTrips",
        data:{
            '_token': "{{csrf_token()}}",
            'companyName': $(".companyName").val(),
        },
        success: function ($data) {
            var editBtn="<button class='btn btn-success edit-trip' value="+$data+">edit</button>";
            $data.forEach(function (dt) {
                for(var $i = 0; $i<dt.length ; $i++){
                    $(".customers-table-content").append("<tr>"+
                        "<td>"+dt[$i].tripID+"</td>"+
                        "<td>"+dt[$i].startStation+"</td>"+
                        "<td>"+dt[$i].stopStation+"</td>"+
                        "<td>"+dt[$i].departureDate+"</td>"+
                        "<td>"+dt[$i].numSeats+"</td>"+
                        "<td>"+dt[$i].priceForSeat+"</td>"+
                        "<td>"+makeEditBtn('btn btn-success','edit-Trip',dt[$i].tripID,'edit',dt[$i].departureDate,dt[$i].numSeats)+"</td>"+
                        "<td>"+makeDeleteBtn('btn btn-danger','delete-Trip',dt[$i].tripID,'delete')+"</td>"

                        +"</tr>"
                    );
                }
            });

        },
        error: function ($reject) {
            console.log($reject);
        }
    });};
    //---------------end load trips---------------

    //--------------start edit trips--------------

    $(".active-trips-table").delegate(".edit-Trip","click",function () {

        tripID=$(this).val();
        console.log("edit");
        console.log("tripID="+tripID);
        console.log($(this).val());
        console.log($(this).attr('departureDate'));
        console.log($(this).attr('numSeats'));
        $(".Date").val($(this).attr('departureDate'));
        $(".seatsNumber").val($(this).attr('numSeats'));
        $(".edit-trip-area").show();
        $(".active-trips-table").hide();

    });
    //--------------end edit trips--------------

    //--------------start accept-edit-btn--------------
    $("body").delegate(".accept-edit-btn","click",function () {
        console.log("tripID="+tripID);
       $.ajax({
           type: "post",
           url: "{{route('editTrip')}}",
           data: {
               '_token' : "{{csrf_token()}}",
               'tripID': tripID,
               'newDate': $(".Date").val(),
               'newSeats': $(".seatsNumber").val(),
           },
           success: function ($data) {
                if($data == 'updated'){
                    clear(".customers-table-content");
                    loadTrips();
                    $(".edit-trip-area").hide();
                    $(".active-trips-table").show();

                }

           },

       });
    });
    //--------------end accept-edit-btn--------------


    //--------------start delete trips--------------
    $("body").delegate(".delete-Trip","click",function () {
        console.log("delete");
        $.ajax({

           type: "post",
           url: "{{route('deleteTrip')}}",
           data:{
               '_token' : "{{csrf_token()}}",
               'tripID' : $(this).val(),
           },
            success: function ($data) {
                if($data == "deleted"){
                  console.log($data);
                    clear(".customers-table-content");
                    loadTrips();
                }
            }
        });
    })
    //--------------end delete trips--------------

    //--------------start pending-customers-btn--------------
    $(".pending-customers-btn").click(function () {
        getPendingCustomers();
        //show pending customers list
        $(".pending-customers-list").slideToggle();
    });
    //--------------end pending-customers-btn--------------

    //start more-pending-customers-btn
    $(".pending-customers").delegate('.more-pending-customers-btn','click',function () {
        var tripID = $(this).attr('tripID');
        var customerID = $(this).attr('customerID');
        $.ajax({
            type: "post",
            url: "{{route('getMorePendingCustoemrs')}}",
            data:{
                '_token' : "{{csrf_token()}}",
                'customerID': $(this).attr('customerID'),
            },
            success: function ($data) {
                console.log("monther");
                console.log($data);
                clear(".pending-customers");
                $(".pending-customers-list").slideUp();
                $(".pending-customers").append('<div class="card" style="width: 18rem;">'+
                    '<img src="..." class="card-img-top" alt="...">'+
                    '<div class="card-body">'+
                    '<img src="assets/images/adminIcons/customer.png" width="40px" height="40px">'+
                    '<h5 class="card-title pending-customer-name">'+$data.name+'</h5>'+
                    '<img src="assets/images/adminIcons/email.png" width="40px" height="40px">'+
                '<p class="card-text pending-customer-email">'+$data.email+'</p>'+
                    '<img src="assets/images/adminIcons/phone.png" width="40px" height="40px">'+
                    '<p class="card-text pending-customer-phone">'+$data.phoneNumber+'</p>'+
                '<div class="btn-toolbar" role="group">'+
                '<button tripID='+tripID+' class="btn btn-primary accept-cach-payment" customerID='+customerID+' >accept</button>'+
                '<button tripID='+tripID+' class=" btn  btn-danger reject-cach-payment" customerID='+customerID+' >reject</button>'+
                    '</div>'+
                    '</br>'+
                '<a href="#" class="btn btn-dark">back</a>'+
                '</div>'+
                '</div>');

            },
        });
    });
    //end more pending-customers-btn

    //start accept-cach-payment
     $(".pending-customers").delegate(".accept-cach-payment","click",function(){
       console.log("tripID:"+$(this).attr('tripID'));
         console.log("customer:"+$(this).attr('customerID'));

         $.ajax({
           type: "post",
           url: "{{route('addPassenger')}}",
           data:{
            '_token': "{{csrf_token()}}",
            'customerID' :$(this).attr('customerID'),
            'tripID' :$(this).attr('tripID'),
           },
            success: function ($data) {
                console.log("alalalal");

                console.log($data);
            }

        });
     });
    //end accept-cach-payment

    //start reject-cach-payment
    $(".pending-customers").delegate(".reject-cach-payment","click",function(){
        console.log("tripID:"+$(this).attr('tripID'));
        console.log("customer:"+$(this).attr('customerID'));

        $.ajax({
            type: "post",
            url: "{{route('deletePassenger')}}",
            data:{
                '_token': "{{csrf_token()}}",
                'customerID' :$(this).attr('customerID'),
                'tripID' :$(this).attr('tripID'),
            },
            success: function ($data) {
                console.log("deleted");

                console.log($data);
            }

        });
    });
    //end reject-cach-payment

    //--------start makeEditBtn---------------------
    function makeEditBtn(btnType,className,value,btnName,departureDate,numSeats) {
        return "<button class='"+btnType+" "+className+" ' value='"+value+"'  departureDate='"+departureDate+"' numSeats='"+numSeats +"'>"+btnName+"</button>";
    }
    //--------end makeEditBtn---------------------

    //--------start makeDeleteBtn---------------------
    function makeDeleteBtn(btnType,className,value,btnName) {
        return "<button class='"+btnType+" "+className+" ' value="+value+">"+btnName+"</button>";
    }
    //--------end makeDeleteBtn---------------------

    function clear(tagName) {
        $(tagName).text("");

    }

    //start getPendingCustomers
    function getPendingCustomers() {
        var companyName = $(".companyName").val() ;
        $.ajax({
            type: "get",
            url: "{{url('getPendingCustomers')}}/"+companyName,

            success: function ($data) {
                console.log($data);
                for($i=0 ; $i <10;$i++){
                    $(".pending-customers-list").append(
                        "<a href='#'  seatsNum="+$data[$i].seatsNumber+" tripID="+$data[$i].tripID+" class='more-pending-customers-btn' customerID="+$data[$i].customerID+"><li class='list-group-item'><span style='color:lightseagreen'>tripID:</span><span style='color:coral'> "+$data[$i].tripID+"</span>"+"<span style='color:lightseagreen'> number of seats:</span> <span style='color:coral'>"+$data[$i].seatsNumber+"</a></li>"
                    );
                }
            },
        });
    }
    //end getPendingCustomers

    //start getMorePendingCustoemrs
    function getMorePendingCustoemrs() {
        $.ajax({
           type: "post",
           url: "{{route('getMorePendingCustoemrs')}}",
           data:{
               '_token' : "{{csrf_token()}}",
               'customerID': $(this).attr('tripID'),

           },
           success: function ($data) {
               console.log($data);
               clear(".customers-table-content");

           },
        });
    }
    //end getMorePendingCustoemrs
</script>
@stop
