<div class="row header">
    <div class="col-lg-7">

        <ul class="header " >

                <li role="presentation" class="header-li brand"><img src="{{url('assets/images/logo/logo.jpg')}}" style="width:100px;height:100px"></li>

        @if($status[0] === 1)
                <li role="presentation" class="header-li logout"><a href="{{route('index')}}">log out</a></li>
                <li role="presentation" class="header-li customer-name"><a href="{{route('CustomerProfile',$status[1]->name)}}">{{$status[1]->name}}</a></li>
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
        <div class="col-lg-12">
            <div class="input-group search-place">

                <input type="text" class="form-control" placeholder="Search for trips , companies">
                <span class="input-group-btn">
                <button class="btn btn-success" type="button">Go!</button>
            </span>

            </div>
        </div>
        <div class="doc-header">YOUR FAVORITE TRIPS AND COMPANIES HERE</div>
        <div class="doc-body">
            <p>search and book trips for best of companies</p>
            <button class="btn btn-default browse-trips">browse trips</button>
        </div>

    </div>


</div>

@section('headerJS')
    <script>
        var customerID =$(".customerID").val();
    $(".companies-area").hide();
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
                    console.log("comcom");
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

    </script>
@stop
