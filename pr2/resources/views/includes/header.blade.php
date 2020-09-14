<div class="row header">
    <div class="col-lg-7">

        <ul class="header " >

                <li role="presentation" class="header-li brand"><img src="{{url('assets/images/logo/logo.jpg')}}" style="width:100px;height:100px"></li>

        @if($status[0] === 1)
                <li role="presentation" class="header-li logout"><a href="{{route('index')}}">log out</a></li>
                <li role="presentation" class="header-li customer-name"><a href="{{route('CustomerProfile',$status[1]->customerID)}}"><img src="uploads/customersIcons/{{$status[1]->imagePath}}" style="width: 50px;height: 50px;border-radius: 100%;"></a></li>
                <input type="hidden" class=" customerID"  value="{{$status[1]->customerID}}">
            @else
                <li role="presentation" class="header-li login"><a href="{{route('login')}}">login</a></li>
                <li role="presentation" class="header-li signup"><a href="{{route('signUP')}}" >sign up</a></li>
            @endif
            <li role="presentation" class="header-li home"><a href="{{route('index')}}">Home</a></li>
            <li role="presentation" class="header-li get-companies"><button type="button" class="btn btn-dark btn-lg" data-toggle="modal" data-target="#myModal">companies</button></li>
            <li role="presentation" class="header-li about-us"><a href="#">about us</a></li>
        </ul>


    </div>
    <div class="col-lg-5 site-doc">

        <div class="input-group">
      <span class="input-group-btn">
        <button class="btn btn-success search-btn" data-toggle="modal" data-target="#result-search-modal" type="button" style="margin: 0px">Go!</button>
      </span>
            <input type="text" class="form-control search-content" id="search-content" placeholder="Search for..." style="margin: 0px" >

        </div>
        <ul class="list-group search-history">
        </ul>
        <div class="doc-header">YOUR FAVORITE TRIPS AND COMPANIES HERE</div>
        <div class="doc-body">
            <p>search and book trips for best of companies</p>
            <button class="btn btn-default browse-trips">browse trips</button>
        </div>

    </div>


    <!-- start result-search modal -->
    <div class="modal fade" id="result-search-modal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" style="background-color: white">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Search Result</h4>

                </div>
                <div class="modal-body">

                    <div class="trips-result">
                        <h3>Trips...</h3>
                        <div class="trips-result-place"></div>
                    </div>
                    <h1>________________</h1>
                    <div class="companies-result">
                        <h3>Companies...</h3>
                        <ul class="list-group companies-result-place"></ul>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default close" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <!-- end result-search modal -->

</div>

@section('headerJS')
    <script>

        //start reload after colse modal
        $(".close").click(function () {
            $('#result-search-modal').on('hidden.bs.modal', function () {
               location.reload();
            });
        });
        //end reload after colse modal

        $(".search-history").hide();
        var customerID =$(".customerID").val();

    $(".browse-trips").click(function () {
        $('html,body').animate({
            scrollTop: $(".trips-place").offset().top
        }, 'slow');
       });

    $(".get-companies").click(function () {
        getCompanies();
        $(".companies-area").slideDown();
            });

        //start getCompanies
        function getCompanies() {
            $.ajax({
                type: "get",
                url: "{{route('getCompanies')}}",
                success: function ($data) {
                    console.log($data);

                    console.log("length");
                    console.log($data[0].length);

                    for(var $x = 0 ; $x <$data[0].length ; $x++) {
                        var val=$data[0][$x].rating;
                        var value = val.toString();
                        var rating = value+"%";
                        console.log(rating);


                        $(".modal-body").append('<ul class="list-group">'+
                            '<li class="list-group-item companyIcon"><img src="uploads/companiesIcons/'+$data[0][$x].imagePath+'" alt="company Icon">'+ '</li>'+

                            '<li class="list-group-item"><div class="progress">\n' +
                            '  <div class="progress-bar progress-bar-success " role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=" width:'+rating+' " >\n' +
                            +$data[0][$x].rating+"%"+


                            '</div>\n' +
                            '<li class="list-group-item rating-place">'+
                            '<div class="btn-group btn-group-sm" role="group">'+
                            '<a class="'+$data[0][$x].companyID+'"id="follow-unfollow-place">'+makeFollowCancelFollowBtn(customerID,$data[0][$x].companyID)+'</a>'+

                            '<a class="btn btn-dark rate-up">  <img src="assets/images/companyIcons/plus.png" style="width:15px;height:15px;"></a>'+
                            '<a class="btn btn-warning ">Rating</a> '+

                            '<a class="btn btn-dark rate-down"><img src="assets/images/companyIcons/minus.png" style="width:15px;height: 15px;"></a> '+

                            '</div>'+

                            '</li>'+


                            '</li>'+
                            '<li class="list-group-item">' +'<span class="address-icon"><img src="assets/images/adminIcons/address.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[0][$x].address+'</span>'+'</li>'+
                            '<li class="list-group-item">'+'<span class="address-icon"><img src="assets/images/adminIcons/email.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[0][$x].email+'</span>'+'</li>'+
                            '<li class="list-group-item">'+'<span class="address-icon"><img src="assets/images/adminIcons/phone.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[0][$x].phoneNumber+'</span>'+'</li>'+
                            '</div>'+


                            '</li>'+
                            '</ul>'
                        );

                    }
                },
                error:function ($a) {
                    console.log($a);
                }
            });
        }
        //end getCompanies



    function makeFollowCancelFollowBtn( customerID,companyID) {

        $.ajax({
            type: "post",
            url: "{{route('checkFollower')}}",
            data:{
                _token:"{{csrf_token()}}",
                customerID:customerID,
                companyID:companyID,
            },
            success: function ($data) {
                console.log($data);

                if($data == 'follower'){
                    console.log("ali");
                    $("."+companyID).html('<a class="btn btn-danger cancel-follow-btn " companyID="'+companyID+'" >unfollow</a>');



                }
                 else if ('nonFollower'){
                    console.log("mortada");
                    $("."+companyID).html('<a class="btn btn-info follow-btn " companyID="'+companyID+'" >follow</a>');


                            }

            },
            error:function ($r) {
                console.log($r);

            }
        });
    }

  //start accept-follow-btn
    $(".modal-body").delegate('.follow-btn','click',function () {

        $.ajax({
           type: "post",
           url: "{{route('followCompany')}}",
           data: {
               _token: "{{csrf_token()}}",
               customerID:customerID,
               companyID:$(this).attr('companyID'),
           },
            success: function ($data) {
                console.log($data);
            clear(".modal-body");
                getCompanies();
                $(".companies-area").slideDown();

            },
            error:function ($r) {
                console.log($r);
            },
        });
    });
    //end accept-follow-btn

   //start accept-cancel-follow-btn
        $(".modal-body").delegate('.cancel-follow-btn','click',function () {
            $.ajax({
                type: "post",
                url: "{{route('cancelFollowCompany')}}",
                data: {
                    _token: "{{csrf_token()}}",
                    customerID:customerID,
                    companyID:$(this).attr('companyID'),
                },
                success: function ($data) {
                    console.log($data);
                    clear(".modal-body");
                    getCompanies();
                    $(".companies-area").slideDown();

                },
                error:function ($r) {
                    console.log($r);
                },
            });
        });
   //end accept-cancel-follow-btn

        //start clear content
        function clear(tagName) {
            $(tagName).text("");

        }
        //end clear content

        //start search-content
        $(document).on('keyup','#search-content',function () {
            console.log("alimonther");

            $.ajax({

               type: "post",
                url: "{{route('customerSearchHistory')}}",
                data:{
                  _token: "{{csrf_token()}}",
                  customerID: customerID,
                  searchContent: $(this).val(),
                },
                success: function ($data){
                    clear(".search-history");
                    console.log($data);
                    for(i=0;i<$data.length;i++){
                    $(".search-history").append('<li class="list-group-item" class="search-Suggestion"><a   href="#" class="search-Suggestion" result=" ' +$data[i].searchContent+ ' " style="color:cornflowerblue;">'+$data[i].searchContent+'</a></li>');
                    }

                }
            });

            $(".search-history").slideDown();
        });
        //end search-content



        //start search-btn
        $(".search-btn").click(function () {
        $(".modal-title").append('<div class="spinner-border" role="status">\n' +
            '  <span class="sr-only">Loading...</span>\n' +
            '</div>');
                $.ajax({
                type: "get",
                url: "{{url('customerSearch')}}/"+customerID+"/"+$("#search-content").val(),
                success: function ($data) {
                    console.log($data);
                    if($data[0][0] == null){
                        $(".companies-result-place").html("<p> no Companies found !</p>");
                    }
                    else{
                        console.log("data[0]")
                        console.log($data[0]);

                            for(i=0;i<$data[0].length;i++)
                            {
                                var val=$data[0][i].rating;
                                //var value = val.toString();
                                var rating = val+"%";

                                $(".companies-result-place").append('<li class="list-group-item companyIcon"><img src="uploads/companiesIcons/'+$data[0][i].imagePath+'" alt="company Icon">'+ '</li>'+
                                    '<li class="list-group-item"><div class="progress">\n' +
                                    '  <div class="progress-bar progress-bar-success " role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style=" width:'+rating+' " >\n' +
                                    +$data[0][i].rating+"%"+
                                    '</div>\n'+
                                    '</li>'+
                                    '<li class="list-group-item">' +'<span class="address-icon"><img src="assets/images/adminIcons/address.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[0][i].address+'</span>'+'</li>'+
                                    '<li class="list-group-item">'+'<span class="address-icon"><img src="assets/images/adminIcons/email.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[0][i].email+'</span>'+'</li>'+
                                    '<li class="list-group-item">'+'<span class="address-icon"><img src="assets/images/adminIcons/phone.png" style="width: 55px;height: 55px"> </span>' +'<span>'+$data[0][i].phoneNumber+'</span>'+'</li>'+
                                    '<a class="btn btn-success trips-resault" href="#'+'" companyID="'+$data[0][i].companyID+'">show trips</a>'+
                                    '</div>'+
                                    '</li>'
                                );

                            }


                    }
                    if($data[0][1] == null){
                        $(".trips-result-place").html("<p> no Trips found !</p>");
                    }
                    else{
                        console.log("tripssss");
                        console.log($data[0][1]);

                        for($x=0;$x<$data[1].length;$x++)
                        {

                        $(".trips-result-place").append("<div class='card trips-card'>"+

                            "<div class='card-body'>"+
                            "<div class='bar'>" +
                            "<div class='emptybar'></div>"+
                            "<div class='filledbar'></div>"+
                            "</div>"+
                            "<h5 class='startStation'>"+"<span class='startStation-title'>"+"<img src=assets/images/tripIcons/start-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='startStation-value'>"+ $data[1][$x].startStation +"</span>" +"</br>" +
                            "<span class='stopStation-title'>"+"<img src=assets/images/tripIcons/stop-station.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='stopStation-value'>" +$data[1][$x].stopStation + "</span>"+"</h5>"+
                            "<p class='card-text-trips'>"+"<span class='trip-dep-date-title'>" +"<img src=assets/images/tripIcons/dep-date.png style='width: 20px ;height: 20px'>"+"</span>" +"<span class='trip-dep-date-value'>"+$data[1][$x].departureDate + "</span>"+ "</br>"+
                            "<span class='num-seats-title'>"+"<img src=assets/images/tripIcons/seats.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='num-seats-value'>"+$data[1][$x].numSeats+"</span>"+"</br>"+
                            "<span class='num-seats-title'>"+"<img src=assets/images/tripIcons/seats.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='num-seats-value'>"+$data[1][$x].availableSeats+"</span>"+"</br>"+
                            "<span class='price-For-Seat-title'>"+"<img src=assets/images/tripIcons/price.png style='width: 20px ;height: 20px'>"+"</span>"+"<span class='price-For-Seat-value' style='color:red'>"+$data[1][$x].priceForSeat+"sp"+"</span>"+"</p>"+
                            " <a href='#' class='btn btn-dark booking-btn' seatPrice='"+$data[1][$x].priceForSeat+"' companyID='"+$data[1][$x].companyID+"' value="+$data[1][$x].tripID+">book a trip</a>"+

                            "</div>"+
                            "</div>");
                                }

                    }
                },
                error: function ($da) {

                    console.log($da);
                },

            });

        });
        //end search-content


        //start searchByLink
        $(".search-history").delegate('.search-Suggestion','click',function () {
            $("#search-content").val($(this).attr('result'));
            console.log("resrs");
            console.log($("#search-content").val());
        });
        //end searchByLink

        $("body").click(function () {
            $(".search-history").slideUp();
        });








    </script>
@stop
