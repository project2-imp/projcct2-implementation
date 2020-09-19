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
         <p class="companies-value">14</p>
         <a class=" companies-link" href="#">List Companies</a>
     </div>

     <div class="col-lg-3 pendingCompany-link">
         <h3 class="total-pendingC">Pending Companies:</h3>
         <p class="pendingC-value">74</p>
         <a class=" notification-link" href="#"> show </a>

     </div>


        <div class="col-lg-2 reports-link">
            <h3 class="total-reports">All reports:</h3>
            <p class="reports-value">26</p>
            <li role="presentation" class="header-li get-companies"><a  class="reports-btn" data-toggle="modal" data-target="#myReports">show reports</a></li>

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
                <button class="btn btn-dark back-link" href="#">back</button>

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
            <div class="customers-container-area col-lg-12 col-xs-12" style="background-color: white; ">

                    <!-- Table -->
                    <h3 style="color: steelblue;">Customers details:</h3>
                    <h4 class="customer-spinner"></h4>
                    <table class="table customers-table">
                        <thead class="customers-table-head">
                        <tr>

                            <th>Avatar</th>
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
    
    <!-- start reports modal -->
    <div class="reports-content">  </div>
    <div class="modal fade" id="myReports" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reports</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <!-- end reports modal -->
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
    $(".close").click(function () {
        $('#myReports').on('hidden.bs.modal', function () {
            location.reload();
        });});

    loadCustoemrs();
    loadCompanies();
    loadPendingCompanies();
    getReportsNum();

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
        $(".reports-link").slideToggle();
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
        $(".reports-link").slideToggle();
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
            $(".customers-value").text($data[0].length);
            $data.forEach(function (dt) {
                console.log("aliddd");
                console.log(dt);
                for(var $i = 0; $i<dt.length ; $i++){
                     var $imagePath ="/uploads/customersIcons/"+dt[$i].imagePath ;
                    $(".customers-table-content").append("<tr>"+

                        "<td>"+"<img src="+$imagePath+" style='width: 50px; height: 50px ;border-radius:50px' >"+"</td>"+
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
            $(".companies-value").text($dataa[0].length);
            $dataa.forEach(function (dtt) {
                for (var $i = 0 ; $i < dtt.length ; $i ++){
                    var $imagePath ="/uploads/companiesIcons/"+dtt[$i].imagePath ;
                    $(".companies-table-content").append("<tr>"+
                        "<td>"+"<img src="+$imagePath+" style='width: 50px; height: 50px ;border-radius:50px' >"+"</td>"+
                        "<td>"+dtt[$i].name+"</td>"+
                        "<td>"+dtt[$i].email+"</td>"+
                        "<td>"+dtt[$i].phoneNumber+"</td>"+
                        "<td>"+dtt[$i].address+"</td>"+
                        "<td>"+dtt[$i].status+"</td>"+
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
    function loadPendingCompanies(){
    $.ajax({
        method: "Get",
        url: "{{route('getPendingCompanies')}}",
        success: function ($data) {
            console.log($data);
            $(".pendingC-value").text($data.length);
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

    });}
    //------------end load pending comapnies-----------


    //-----------show more pending copmany info-------------------

    $("body").delegate(".more-details-link","click",function () {
        $(".details-pending-companies-area").slideUp();
        $(".details-pending-companies-area").slideDown();
        var $AcceptBtnClassName = "class='btn btn-success btn-accept'";
        var $AcceptBtnValue="monther";
        console.log("ali");
        morePenCustomerInfo($(this).val());

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
               console.log("alialill");
               $(".pending-table-body").slideUp();
               clear(".pending-table-body");
                loadPendingCompanies();
               $(".pending-table-body").slideDown();
               $(".details-pending-companies-area").slideUp();
               clear(".companies-table-content");
               loadCompanies();
                },
            error: function ($reject) {
                console.log($reject);
               alert("try again");
            }

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
                $(".pending-table-body").slideUp();
                clear(".pending-table-body");
                loadPendingCompanies();
                $(".pending-table-body").slideDown();
                $(".details-pending-companies-area").slideUp();
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

            $(".customer-spinner").fadeIn().html(' <p>waiting...</p> <div class="spinner-border text-light" role="status">'+
                '<span class="sr-only">Loading...</span>'+
                '</div>');

            $.ajax({

                type: "post",
                url: "{{route('blockAccount')}}",
                data: {
                    '_token':"{{csrf_token()}}",
                    'customerEmail':$(this).val()
                },
                success: function ($data) {
                    if($data == "blocked"){

                        clear(".customers-table-content");
                        $(".customers-table").slideDown();
                        loadCustoemrs();
                        $(".customer-spinner").fadeOut();
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

    // start morePenCustomerInfo
    function morePenCustomerInfo( link){
        $.ajax({
            type: "post",
            url: " {{route('companyInfo')}}",
            data: {
                '_token' : "{{csrf_token()}}",
                'name' : link,
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
    }
    // end morePenCustomerInfo


    //start getReportsNum
    function getReportsNum(){
        $.ajax({

            type: "get",
            url: "{{route('getReportsNum')}}",
            success: function($data){
                console.log($data);
                $(".reports-value").text($data);
            },
        
            error: function($d){
                console.log($d);
            },
        });
    }

    
        $("body").delegate('.reports-btn','click',function () {
          getReports();
        });

//start getReports
    function getReports(){
         $.ajax({
              type: "get",
               url: "{{route('getReports')}}",
               success: function ($d) {
                   console.log($d);
                   for (var i =0;i< $d[0].length ; i++) {
                   
                         $(".modal-body").append('<ul class="list-group">'+

                              '<li class="list-group-item"><p class="report-title">from:</p><span class="report-value">'+$d[2][i].name+'</span></li>'+  
                              '<li class="list-group-item"><p class="report-title">to:</p><span class="report-value">'+$d[1][i].email+'</span></li>'+  
                              '<li class="list-group-item"><p class="report-title">report Content:</p><span class="report-value">'+$d[0][i].reportContent+'</span></li>'+  
'<li class="list-group-item">'+makeBlockUnblockBtn($d[0][i].email,$d[0][i].status,"customer")+'<button class="btn btn-danger delete-report-btn" report-id="'+$d[0][i].reportID+'">delete report</button></li>'+  

                              

                            '</ul>');
               
                    }
               },
               


           });
    }

    //end getReports


    //start delete report
        $(".modal-body").delegate(".delete-report-btn","click",function(){
                console.log($(this).attr('report-id'));
            $.ajax({

                  type: "get",
                  url: "{{url('deleteReport')}}/"+$(this).attr('report-id'),
                  success: function($data){
                    if($data == "report deleted"){
                        clear('.modal-body');
                          getReports();  
                    }
                  },
                  error: function($er){
                    console.log($er);
                  }  

            });

        });
    
//end delete report
    

    $(".customers-link").click(function(){
        $('html,body').animate({
            scrollTop: $(".customers-container-area").offset().top
        }, 'slow');
    
    });

    $(".companies-link").click(function(){
        $('html,body').animate({
            scrollTop: $(".companies-container-area").offset().top
        }, 'slow');
    
    });
</script>

@stop
