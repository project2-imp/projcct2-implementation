@extends('layouts.company.companyMaster')
@section('dashboard')

<!-- start nav -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">logout</a>
        <a class="navbar-brand" href="#">{{ $companyName[0]->name }}</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" profile-link href="#"><img class=" companyIcon" src='uploads/companiesIcons/{{ $companyName[0]->imagePath}}' style="width:50px;height:60px;"> <span class="sr-only">(current)</span></a>

                </li>
                <li class="nav-item">
                    <a class="nav-link show-active-trips" href="#">My Trips</a>
                </li>
                <li class="nav-item">
                    <a class=" pending-customers-btn"  href="#" data-toggle="modal" data-target="#myPendingCustomers">pending customers</a>
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

<!--start profile info -->
<div class=" row company-profile-info">
    <div class="progress company-rating">
        <div class="progress-bar company-rating" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
            <p class="rating-label"></p>
        </div>
    </div>
    <div class=" row jumbotron">
      <div class="col-lg-8 col-sm-12">
         <!-- profile info-->
            <div class="company-info">
            </div>

      </div>
        <!--  start short info-->
        <div class="col-lg-4 col-sm-12">

                <!-- start links -->
                <ul class="list-group">
                    <li class="list-group-item">
                        <a  href="#" class="followers-btn" data-toggle="modal" data-target="#myFollowers">Followers:</a>
                        <span class="customers-number" style="color: coral"></span>
                    </li>
                    <li class="list-group-item">
                        <h4 class="trips-numbertitle"  style="color: #337ab7">trips number:</h4>
                        <span class="trips-number" style="color: coral"></span>
                    </li>
                    <li class="list-group-item">
                        <ul class="list-group pending-customers-list">
                        </ul>
                    </li>
                </ul>
                 <!-- <div class="col-lg-12 pending-customers">
                </div> -->

                <!-- end links -->
        </div>
        <!--  end short info-->


    </div>


</div>
<!--end profile info -->

<!--start active trips area -->
<div class="row">
    <div class="col-lg-12 active-trips-area">
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
   <!-- last -->

</div>
<!--end active trips area -->


<!-- start followers modal-->
<div class="followers-place">
<div class="container">
<!-- start followers area-->
<div class="modal fade" id="myFollowers" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="background-color: white">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <input type="text" class="form-control report-content" placeholder="input report resaion ... " style="height: 100px; margin-top: 10px">
                <button class="btn btn-success accept-report-btn"  customerID="'+$data[$x].customerID+'" style="margin-left: 240px;margin-top: 5px">send</button>
                <h4 class="report-result" style=" color:green; margin-left: 220px "></h4>
                <h4 class="modal-title">Followers</h4>
            </div>
            <div class="modal-body">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
    <!-- end followers area-->
</div>
</div>
<!-- end followers modal-->

<!-- start pending-customers area-->
<div class="pending-customers-place">
    <div class="container">
        <!-- start pending-customers area-->
        <div class="modal fade" id="myPendingCustomers" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="background-color: white">
                    <div class="modal-header pending-customers-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">pending customers</h4>
                    </div>
                    <div class="modal-body pending-customers-content">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- end pending-customers area-->
    </div>
</div>

<!-- end pending-customers area-->



<!-- ---start content--->
    <div class="row " id="content">
        <!-- start active-trips-area -->
        <div class="col-lg-12 active-trips-area">

        </div>
        <!-- end active-trips-area -->


    </div>
<!-- ---end content--->

@stop
@section('javascrip')

<script>
    var tripID=0;
    var counter=0;
    var customerID;
    var reportCounter=0;
    var companyName =  $(".companyName").val();
    $(".trip-added-message").hide();
    $(".blocked-company-alert").hide();
    $(".add-trip-area").hide();
    $(".edit-trip-area").hide();
    $(".pending-customers-list").hide();
    $(".close").click(function () {
        $('#myPendingCustomers').on('hidden.bs.modal', function () {
            location.reload();
        });});
    $(".close").click(function () {

        $('#myFollowers').on('hidden.bs.modal', function () {
            location.reload();
        });});

    loadTrips();
    loadFollowers();
    loadTripsNum();
    loadProfileInfo();
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
            $(".active-trips-area").show(500);
            $(".company-profile-info").show(500);

        }
        else{
            $(".links").hide(500);
            $(".content").hide(500);
            $(".add-trip-area").slideToggle();
            $(".active-trips-area").hide(500);
            $(".company-profile-info").hide(500);

        }
        $(".trip-added-message").hide();
        $(".blocked-company-alert").hide();



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


    //start show-active-trips
    $(".show-active-trips").click(function () {
        $('html,body').animate({
            scrollTop: $(".active-trips-area").offset().top
        }, 'slow');
    });
    //end show-active-trips

    //start loadFollowers num

    function loadFollowers(){
        console.log();
        $.ajax({
           type: "post",
           url: "{{route('getFollowersNum')}}",
            data:{
               _token:"{{csrf_token()}}",
               companyID: $(".companyName").val(),
            },
            success: function ($data) {
                  $(".customers-number").append('<h4>'+$data+'</h4>');
            },
            error: function ($data) {
            console.log($data);

               },
        });
    }
    //end loadFollowers num

    //start loadTripsNum
        function loadTripsNum() {
            $.ajax({
               type: "post",
               url:"{{route('getTripsNum')}}",
               data: {
                _token: "{{csrf_token()}}",
                companyName: $(".companyName").val(),
               },
                success: function ($data) {
                   console.log($data);
                    $(".trips-number").append('<h4>'+$data+'</h4>');
                },
            });
        }
    //end loadTripsNum
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
     $(".pending-customers-content").delegate(".accept-cach-payment","click",function(){
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
                if($data == "customer accepted"){
                    alert($data);
                    clear(".pending-customers-content");
                    getPendingCustomers();

                }

                else  alert("error try again");

            }

        });
     });
    //end accept-cach-payment

    //start reject-cach-payment
    $(".pending-customers-content").delegate(".reject-cach-payment","click",function(){
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
                if($data == "customer deleted")
                {
                    alert($data);
                    clear(".pending-customers-content");
                    getPendingCustomers();

                }
                else alert("error try again");
                console.log($data);
            }

        });
    });
    //end reject-cach-payment


    //start getFollowers
    $(".followers-btn").click(function () {
        $(".followers-place").slideDown();
       $.ajax({
            type: "post",
           url:"{{route('getFollowers')}}",
            data:{
                companyName: $(".companyName").val(),
                _token:"{{csrf_token()}}",

            },
            success:function ($data) {

                console.log($data);

                for(var $x = 0 ; $x <$data.length ; $x++) {
                 $(".modal-body").append('<ul class="list-group">'+
                        //'<li class="list-group-item companyIcon"><img src="uploads/customersIcon/'+$data[0][$x].imagePath+'" alt="customer Icon">'+ '</li>'+
                        '<li class="list-group-item">' +'<span class="address-icon"><img src="assets/images/adminIcons/address.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[$x].address+'</span>'+'</li>'+
                        '<li class="list-group-item">'+'<span class="address-icon"><img src="assets/images/adminIcons/email.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[$x].email+'</span>'+'</li>'+
                        '<li class="list-group-item">'+'<span class="address-icon"><img src="assets/images/adminIcons/phone.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[$x].phoneNumber+'</span>'+'</li>'+
                        '<li class="list-group-item"><button class="btn btn-warning report-btn" customerID="'+$data[$x].customerID+'">report</button></li>'+
                     '</ul>'

                 );}
                $(".report-content").hide();
                $(".accept-report-btn").hide();
           },
        });
    });
    //end getFollowers

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
                if($data[0] == null){
                    $(".pending-customers-content").html('<label class="alert-primary">no Pending customers</label>');
                }
                else{
                    for($i=0 ; $i <$data[0].length;$i++){
                        $(".pending-customers-content").append('<ul class="list-group">' +
                            '<li class="list-group-item"><span>trip ID:'+$data[0][$i].tripID+'</span></li>'+
                            '<li class="list-group-item"><img src="assets/images/customerIcons/name.png" style="width: 50px;height:50px;"><span>'+$data[1][$i].name+'</span></li>'+
                            '<li class="list-group-item"><img src="assets/images/customerIcons/email.png" style="width: 50px;height:50px;"><span>'+$data[1][$i].email+'</span></li>'+
                            '<li class="list-group-item"><img src="assets/images/customerIcons/phone.png" style="width: 50px;height:50px;"><span>'+$data[1][$i].phoneNumber+'</span></li>'+
                            '<li class="list-group-item"><img src="assets/images/customerIcons/address.png" style="width: 50px;height:50px;"><span>'+$data[1][$i].address+'</span></li>'+
                            '<li class="list-group-item"><img src="assets/images/tripIcons/seats.png" style="width: 50px;height:50px;"><span>'+$data[0][$i].seatsNumber+'</span></li>'+
                            '<li class="list-group-item"><div class="btn-group" role="group" aria-label="...">' +
                            '<button type="button"  class="btn btn-success accept-cach-payment" tripID="'+$data[0][$i].tripID+'" customerID="'+$data[0][$i].customerID+'">accept</button>'+
                            '<button type="button"  class="btn btn-danger reject-cach-payment" tripID="'+$data[0][$i].tripID+'" customerID="'+$data[0][$i].customerID+'">reject</button>'+


                            '</div>'+
                            '</li>'+
                            '</ul>');
                    }
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

    //start reoport-btn
    $(".modal-body").delegate('.report-btn','click',function () {
        reportCounter++;
        customerID=$(this).attr('customerID');
        console.log("customer:"+$(this).attr('customerID'));
        $(".report-content").slideToggle();
        $(".accept-report-btn").slideToggle();
        if(reportCounter %2 == 1){
            $('html,.modal').animate({
                scrollTop: $(".modal-header").offset().top
            }, 'slow');
        }


    });
    //end reoport-btn

    //send accept-report-btn
    $(".modal-header").delegate('.accept-report-btn','click',function () {

        $.ajax({

            type: "post",
            url: "{{route('reportCustomer')}}",
            data: {
                _token: "{{csrf_token()}}",
                customerID: customerID,
                companyName:companyName,
                repostContent:$(".report-content").val(),
            },
            success: function($data){
                console.log($data);
                $(".report-result").text($data);


            },
            error: function($data){
                console.log($data);
            },

        });
    });

    //end accept-report-btn

    //start profile info
        function loadProfileInfo() {
            $.ajax({

               type: "get",
               url: "{{url('getCompanyInfo')}}/"+companyName,
                success:function ($data) {
                   var value = $data.rating;
                    var val = value.toString();
                    var rating = val+"%";
                    if(value >= 0 && value <=30){
                        $(".company-rating").addClass("progress-bar-danger");
                    }
                    else if (value >30 && value<=50){
                         $(".company-rating").addClass("progress-bar-warning");
                    }
                    else if (value >50 && value<=70){
                        $(".company-rating").addClass("progress-bar-info");
                    }
                    else if (value >70 ){
                        $(".company-rating").addClass("progress-bar-success");
                    }
                   $(".rating-label").text("rating:"+rating);
                   $(".company-rating").css("width",rating);
                    console.log($data);
                    $(".company-info").append('<ul class="list-group"> <li class="list-group-item active"></li><li> <div class="card" style="">'+
                        '<img src="" >'+
                        '<div class="card-body">' +
                        ' <h4 class="card-title"> <span><img class="name-icon" src="{{url('assets/images/customerIcons/name.png')}}" style="width: 50px;height: 50px;"></span> <h3 class="pr-name"  value="'+$data.name+'">'+$data.name+'</h4>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/email.png')}}" style="width: 50px;height: 50px;"> <input class="form-control pr-email" type="email" value="' +$data.email+'"></p>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/password.png')}}" style="width: 50px;height: 50px;"><input class="form-control pr-password" type="text" value="' +$data.password+'"></p>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/phone.png')}}" style="width: 50px;height: 50px;"> <input class="form-control pr-phone"  type="text" value="' +$data.phoneNumber+'"></p>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/address.png')}}" style="width: 50px;height: 50px;"> <input class="form-control pr-address" type="text" value="' +$data.address+'"></p>' +
                        '<br>'+
                        '<button class="btn btn-info edit-companyProfile-btn">edit profile</button>' +

                        '</div>' +


                        '</div> </li>   </ul> ');
                }
            });

        }
    //end profile info

    // start edit-companyProfile-btn
    $(".company-info").delegate('.edit-companyProfile-btn','click',function () {

        $.ajax({

           type: "post",
           url: "{{route('editCompanyInfo')}}",
           data: {
               _token: " {{csrf_token()}}",
               companyName: companyName,
               newEmail: $(".pr-email").val(),
               newPassword: $(".pr-password").val(),
               newPhoneNumber: $(".pr-phone").val(),
               newAddress: $(".pr-address").val(),
           },
            success:function ($data) {
               console.log($data);
                alert($data);
                clear(".company-info");
                loadProfileInfo();

            }
        });
    });
    //end edit-companyProfile-btn
</script>
@stop
