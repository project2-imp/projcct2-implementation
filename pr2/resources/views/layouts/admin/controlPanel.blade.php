@extends('layouts.admin.adminMaster')
@section('content')
    <!-- search div -->
    <div class="row">
        <div class="col-lg-12">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <!-- end search div-->

    <!-- short information div-->
    <div class="row short-information">

     <div class="col-lg-3 custoemer-link">
        <h3 class="total-customers">Total customer:</h3>
        <p class="customers-value">124</p>
         <a class=" customers-link" href="#">List Customers</a>
     </div>

     <div class="col-lg-3 company-link">
         <h3 class="total-companies">Total Companies:</h3>
         <p class="companies-value">4674</p>
         <a class=" companies-link" href="#">List Companies</a>
     </div>

     <div class="col-lg-3 pendingCompany-link">
         <h3 class="total-pendingC">Pending Companies:</h3>
         <p class="pendingC-value">74</p>
         <a class=" notification-link" href="#"> show </a>

     </div>


        <div class="col-lg-2 ">
            <a class=" more-link" href="#"> more </a>
                <ul class="more-option">
                    <li><a class="add-admin-link" href="#">add new admin</a></li>
                    <li><a class="back-link" href="#">back</a></li>

                </ul>
        </div>
        <div class="col-lg-3 new-admin-palce">
           <div class="success-add-admin-msg">
               <span class="alert alert-success">Admin Added</span>
           </div>
            <div class="error-add-admin-msg">
                <span class="alert alert-danger"> please try again</span>
            </div>
            <div  id="formContent">

                <input type="text" id="name" class="fadeIn second admin-name" name="name" placeholder="name">
                <input type="email" id="email" class="fadeIn second admin-email" name="email" placeholder="email">
                <input type="password" id="password" class="fadeIn third admin-password" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth add-admin-btn" value="Add">

            </div>
        </div>
    </div>
    <!-- end short information div-->

    <!-- reports & pending companies div-->
    <div class="row">

        <!--pending companies div-->
        <div class="col-lg-5 gray-background pending-companies-area">

            <h3 style="color: lightgreen">Pending Companies:</h3>
            <table class="table pendingCompanies-table">
                <thead class="pending-table-head">
                <tr>
                    <th>company name</th>
                    <th>company email</th>
                    <th>more details</th>
                </tr>
                </thead>
                <tbody class="pending-table-body" style="color: darkslategrey">

                </tbody>
            </table>

        </div>
        <!--end pending companies div-->

        <!--pending companies details div-->
        <div class="col-lg-6 details-pending-companies-area">
            <div class="alert alert-success" role="alert">
                <h1 class="companyName-content">company name</h1>
                <img class="email-icon" src="{{url('/assets/images/adminIcons/email.png')}}" style="width:50px;height:60px;">
                <p class="email-content"></p>

                <img class="phone-icon" src="{{url('/assets/images/adminIcons/phone.png')}}" style="width:50px;height:60px;">
                <p class="phone-content"></p>

                <img class="address-icon" src="{{url('/assets/images/adminIcons/address.png')}}" style="width:50px;height:60px;">
                <p class="address-content"></p>

                <img class="card-icon" src="{{url('/assets/images/adminIcons/card.png')}}" style="width:50px;height:60px;">
                <p class="card-content"></p>

                <span class=" btn-accept-place"> </span>
                <span class=" btn-reject-place"> </span>
                <!-- start accept message-->
                <div class=" alert-success Accept-message" style="text-align: center">
                    Company is Accepted
                </div>
                <!-- end accept  message-->

                <!-- start accept message-->
                <div class=" alert-success Reject-message" style="text-align: center">
                    Company is Rejected
                </div>
                <!-- end accept  message-->
            </div>
        </div>
        <!--end pending companies details div-->



    </div>
    <!-- end reports & pending companies div-->

    <!-- start browse customers & companies div-->
    <div class="row">
            <!-- browse customers div-->
            <div class="customers-container-area col-lg-12 col-xs-12">

                    <!-- Table -->
                    <h3 style="color: steelblue">Customers details:</h3>
                    <table class="table customers-table">
                        <thead class="customers-table-head">
                        <tr>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th class="var-with-table">Status</th>
                           <!-- <th class="more-details">Card Number</th>
                            <th class="more-details">Card Balance</th> -->
                        </tr>
                        </thead>
                        <tbody class="customers-table-content" style="color: darkslategrey">

                        </tbody>
                    </table>


            </div>
<p>alialalialaia</p>


        <!-- end browse customers div-->
            <!--start browse companies div-->
            <div class="companies-container-area col-lg-12 col-xs-12">

                <!-- Table -->
                <h3 style="color: lightcoral">Companies details:</h3>
                <table class="table companies-table">
                    <thead class="companies-table-head">
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th class="var-with-table">Status</th>
                        <!-- <th class="more-details">Card Number</th>
                        <th class="more-details">Rating</th> -->

                    </tr>
                    </thead>
                    <tbody class="companies-table-content" style="color:darkslategrey">

                    </tbody>
                </table>


            </div>
            <!-- end browse companies div-->
            <div class="col-lg-4 blocked-users"></div>
        </div>
    <!-- end browse customers & companies div-->
@stop

@section('javascript')
<script>
    $(".Accept-message").hide();
    $(".Reject-message").hide();
    $(".new-pending-palce").hide();
    $(".new-admin-palce").hide();
    $(".more-option").hide();
    $(".back-link").hide();
    $(".success-add-admin-msg").hide();
    $(".error-add-admin-msg").hide();
    $(".details-pending-companies-area").hide();
    loadCustoemrs();
    loadCompanies();

    //-------------start more-link--------------------
        $(".more-link").click(function () {
            $(".more-option").slideToggle();
        });
   //----------------end more-link--------------------

    //-------------start add-admin-link--------------------
    $(".add-admin-link").click(function () {
        $(".custoemer-link").slideToggle();
        $(".company-link").slideToggle();
        $(".pendingCompany-link").slideToggle();
        $(".new-admin-palce").slideToggle();
        $(".add-admin-link").slideToggle();
        $(".back-link").slideToggle();



    });
    //----------------end add-admin-link--------------------

    //-------------start back-link--------------------
    $(".back-link").click(function () {
        $(".custoemer-link").slideToggle();
        $(".success-add-admin-msg").fadeToggle();
        $(".error-add-admin-msg").fadeToggle();
        $(".company-link").slideToggle();
        $(".pendingCompany-link").slideToggle();
        $(".new-admin-palce").slideToggle();
        $(".add-admin-link").slideToggle();
        $(".back-link").slideToggle();

    });
    //----------------end back-link--------------------


    //------------------load customers----------------
    function loadCustoemrs(){
    $.ajax({
        type: "GET",
        url: "{{route('getCustomers')}}",
        success: function ($data) {
            $data.forEach(function (dt) {
                console.log("aliddd");
                console.log(dt);
                for(var $i = 0; $i<dt.length ; $i++){
                    $(".customers-table-content").append("<tr>"+
                        "<td>"+dt[$i].name+"</td>"+
                        "<td>"+dt[$i].email+"</td>"+
                        "<td>"+dt[$i].phoneNumber+"</td>"+
                        "<td>"+dt[$i].address+"</td>"+
                        "<td>"+dt[$i].status+"</td>"+
                        "<td>"+makeBlockUnblockBtn(dt[$i].email,dt[$i].status,"customer")+"</td>"+


                        +"</tr>"
                    );
                }
            });
        },
    });}
    //---------------end load customers---------------

    //----------------load companies------------------
    function loadCompanies(){
    $.ajax({
        type: "GET",
        url: "{{route('getCompanies')}}",
        success: function ($dataa) {
            console.log($dataa);
            $dataa.forEach(function (dtt) {
                for (var $i = 0 ; $i < dtt.length ; $i ++){
                    $(".companies-table-content").append("<tr>"+
                        "<td>"+"<img src='{{url('/uploads/companiesIcons/"+dtt[$i].imaagePath+"')}}' >"+"</td>"+
                        "<td>"+dtt[$i].name+"</td>"+
                        "<td>"+dtt[$i].email+"</td>"+
                        "<td>"+dtt[$i].phoneNumber+"</td>"+
                        "<td>"+dtt[$i].adress+"</td>"+
                        "<td>"+dtt[$i].cardNumber+"</td>"+
                        "<td>"+makeBlockUnblockBtn(dtt[$i].email,dtt[$i].status,"company")+"</td>"+
                        "</tr>"
                    );
                }
            });
        },
        error:function ($d) {
            console.log($d);

        },
    });}
    //------------------end load companies-------------

    //------------load pending companies---------------

    $.ajax({
        method: "Get",
        url: "{{route('getPendingCompanies')}}",
        success: function ($data) {
            console.log($data);
            $data.forEach(function ($dt) {
                for ($i = 0; $i < $dt.length; $i++) {
                    $(".pending-table-body").append("<tr>"+
                        "<td>" + $dt[$i].name + "</td>"+
                        "<td>" + $dt[$i].email + "</td>"+
                        "<td>"+"<button  class=' btn btn-success more-details-link' value="+ $dt[$i].name+" href='#'>more</button>"+"</td>"+
                        "</tr>"
                    );
                }
            });
        }

    });
    //------------end load pending comapnies-----------


    //-----------show more pending copmany info-------------------
    $("body").delegate(".more-details-link","click",function () {
        $(".details-pending-companies-area").slideUp();
        $(".details-pending-companies-area").slideDown();
        var $AcceptBtnClassName = "class='btn btn-success btn-accept'";
        var $AcceptBtnValue="monther";
        console.log("ali");
        $.ajax({
           type: "post",
           url: " {{route('companyInfo')}}",
           data: {
               '_token' : "{{csrf_token()}}",
               'name' : $(this).val(),
           },
           success: function ($data) {
                console.log($data);

                $(".companyName-content").html("<h1>"+$data[0].name+"</h1>");
                $(".email-content").html("<p>"+$data[0].email+"</p>");
                $(".phone-content").html("<p>"+$data[0].phoneNumber+"</p>");
                $(".address-content").html("<p>"+$data[0].address+"</p>");
                $(".card-content").html("<p>"+$data[0].cardNumber+"</p>");
                $(".btn-accept-place").html("<button  class='btn btn-success btn-accept 'value='  "+$data[0].name+" ' >Accept</button>");
                $(".btn-reject-place").html("<button  class='btn btn-danger  btn-reject 'value=' "+ $data[0].name+" ' >Reject</button>");

           },
        });


    });
    //-----------end show more pending copmany info----

    //--------start Accept pending company-------------
    $("body").delegate('.btn-accept','click',function () {
        console.log($(this).val() );
        $.ajax({
            type: "post",
            url: "{{route('acceptCompany')}}",
            data: {
                '_token': "{{csrf_token()}}",
                'name': $(this).val(),
            },
            
           success: function ($data) {
                console.log($data);
                $(".details-pending-companies-area").fadeOut();
                $(".Accept-message").show(1000);
                $(".details-pending-companies-area").fadeIn();
               $(".Accept-message").hide();
           },

        });

    })
    //--------end Accept pending company---------------

    //--------------start reject pending company-------
    $("body").delegate('.btn-reject','click',function () {
        $.ajax({

            type: "post",
            url: "{{route('rejectCompany')}}",
            data:{
                '_token': "{{csrf_token()}}",
                'name': $(this).val(),
            },
            success: function ($data) {
                    console.log($data);
                    $(".details-pending-companies-area").fadeOut();
                    $(".Reject-message").show();
                    $(".details-pending-companies-area").fadeIn();
                    $(".Reject-message").hide();

                    },
            error: function ($reject) {
                console.log($reject);
            }
        })

    })
    //--------------end reject pending company-------

    //--------------start add new admin--------------
    $("body").delegate('.add-admin-btn','click',function () {
        console.log('ali');
        $.ajax({

            type: "post",
            url: "{{route('addNewAdmin')}}",
            data:{
                '_token': "{{csrf_token()}}",
                'name': $(".admin-name").val(),
                'email': $(".admin-email").val(),
                'password': $(".admin-password").val(),
            },
            success: function ($data) {
                console.log($data);
                if($data == "success"){
                    $(".success-add-admin-msg").fadeToggle();
                    $(".error-add-admin-msg").hide();

                }
                else{
                    $(".error-add-admin-msg").fadeToggle();
                    $(".success-add-admin-msg").hide();
                }
                },
            error: function ($reject) {
                console.log($reject);
            }
        })

    });
    //--------------end add new admin----------------

    //--------------start block-account-btn----------
        $(".customers-table").delegate(".block-customer-btn","click",function(){
            $.ajax({

                type: "post",
                url: "{{route('blockAccount')}}",
                data: {
                    '_token':"{{csrf_token()}}",
                    'customerEmail':$(this).val()
                },
                success: function ($data) {
                    if($data == "blocked"){
                        $(".customers-table").slideUp();
                        clear(".customers-table-content");
                        $(".customers-table").slideDown();
                        loadCustoemrs();
                    }
                }


            });
        });
    //--------------end block-account-btn----------

    //--------------start unblock-account-btn----------
    $(".customers-table").delegate(".unblock-customer-btn","click",function(){
        $.ajax({

            type: "post",
            url: "{{route('unblockAccount')}}",
            data: {
                '_token':"{{csrf_token()}}",
                'customerEmail':$(this).val()
            },
            success: function ($data) {
                if($data == "unblocked"){
                    $(".customers-table").slideUp();
                    clear(".customers-table-content");
                    $(".customers-table").slideDown();
                    loadCustoemrs();
                }
            }


        });
    });
    //--------------end unblock-account-btn----------

    //--------------start block-company-btn----------
    $(".companies-table").delegate(".block-company-btn","click",function(){
        $.ajax({

            type: "post",
            url: "{{route('blockCompany')}}",
            data: {
                '_token':"{{csrf_token()}}",
                'companyEmail':$(this).val()
            },
            success: function ($data) {
                if($data == "blocked"){
                    $(".companies-table").slideUp();
                    clear(".companies-table-content");
                    $(".companies-table").slideDown();
                    loadCompanies();
                    console.log($data);
                }
            }


        });
    });
    //--------------end block-company-btn----------


    //--------------start unblock-company-btn----------
    $(".companies-table").delegate(".unblock-company-btn","click",function(){
        $.ajax({

            type: "post",
            url: "{{route('unblockCompany')}}",
            data: {
                '_token':"{{csrf_token()}}",
                'companyEmail':$(this).val()
            },
            success: function ($data) {
                if($data == "unblocked"){
                    $(".companies-table").slideUp();
                    clear(".companies-table-content");
                    $(".companies-table").slideDown();
                    loadCompanies();
                }
            }


        });
    });
    //--------------end unblock-company-btn----------

    //start makeBlockUnblockBtn
    function makeBlockUnblockBtn(value , status , type){
        if (type == "customer"){


        if(status == "blocked")
        return "<button class='btn btn-danger unblock-customer-btn ' value='"+value+"' >unblock account</button>";
        else
            return "<button class='btn btn-success block-customer-btn ' value='"+value+"' >block account</button>";
        }
        else if (type == "company"){
            if(status == "blocked")
                return "<button class='btn btn-danger unblock-company-btn ' value='"+value+"' >unblock company</button>";
            else
                return "<button class='btn btn-success block-company-btn ' value='"+value+"' >block company</button>";

        }
        }
    //end makeBlockUnblockBtn

    //start clear content
    function clear(tagName) {
        $(tagName).text("");

    }
    //end clear content



</script>

@stop