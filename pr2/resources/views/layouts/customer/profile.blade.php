    @extends('layouts.customer.profileMaster')
    @section('content')

        <input type="hidden" class="customerID" value={{request()->route('customerID')}}>
       <div class="row">
        <!-- start profile info -->

           <div class=" col-lg-3 profile-info">

            <div class="profile-photo">
            </div>

           </div>

        <!-- end profile info -->

           <div class=" col-lg-6 content">

               <div class="row">
                   <div class="col-lg-12">
                       <table  class="table table-active active-trips"  style="width:100%">

                           <th class="table-header">
                           <h3> Active Trips</h3>
                           <td>Start station</td>
                           <td>Stop station</td>
                           <td>Dep Date</td>
                           <td>Dep Time</td>
                           <td>Price</td>
                           <td>number of seats</td>
                           </th>
                           <tbody class="active-trips-place">

                           </tbody>
                       </table>

                   </div>
                   <div class="col-lg-12 balance-card-place">

                   </div>

               </div>

           </div>

           <div class=" col-lg-2 short-info">
               <div class="row">
                   <div class="col-lg-12">
                       <h3>account statistics </h3>
                       <ul class="list-group">
                           <li class="list-group-item active"></li>
                           <li class="list-group-item"><span class="short-title">following companies:</span> <span class="following-companies-val">0</span> </li>
                           <li class="list-group-item"><span class="short-title all-trips-value">all trips:</span> <span class="all-trips-val">0</span></li>
                           <li class="list-group-item"><span class="short-title">active trips:</span> <span class="active-trips-val">0</span></li>
                           <li class="list-group-item"><span class="short-title">completed trips:</span> <span class="completed-trips-val">0</span></li>
                           <li class="list-group-item"><span class="short-title">cash payment:</span> <span class="trips-payment-cash-val">0</span> </li>
                           <li class="list-group-item"><span class="short-title ">by card payment:</span> <span class="trips-payment-byCard-val">0</span></li>
                           <li class="list-group-item"><span class="short-title">total Amount:</span> <span class="total-amount-val">0</span></li>
                       </ul>
                   </div>
                   <div class="col-lg-12 card-details-place">
                       <h1 class="card-place">  Card details</h1>


                   </div>
               </div>

           </div>


       </div>

@stop
@section('javascrip')

        <script>

        var customerID = $(".customerID").val();
        var activeTrips;
        var status=0;
        loadProfileInfo();
        console.log("ali");
        loadActiveTrips();
        loadFollowingCompanies();
        getStatistics();
        loadCardDetails();
        $(".profile-info").delegate('.edit-profile-btn','click',function () {
            editProfile()
        });

        function loadProfileInfo(){

            $.ajax({
               type: "get",
                url: "{{url('getProfileInfo')}}/"+customerID,
                success: function ($data) {
                    //console.log($data);
                    var imagePath ="uploads/customersIcons/"+$data.imagePath;
                    imagePath.toString();



                    $(".profile-info").append('<ul class="list-group"> <li class="list-group-item active"></li><li> <div class="card" style="">'+
                        '<img src="" >'+
                        '<div class="card-body">' +
                        ' <h4 class="card-title"> <span><img class="profile-icon" src="{{url('assets/images/customerIcons/name.png')}}" style="width: 50px;height: 50px;"></span> <input class="form-control pr-name" type="text" value="'+$data.name+'"></h4>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/email.png')}}" style="width: 50px;height: 50px;"> <input class="form-control pr-email" type="email" value="' +$data.email+'"></p>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/password.png')}}" style="width: 50px;height: 50px;"><input class="form-control pr-password" type="text" value="' +$data.password+'"></p>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/phone.png')}}" style="width: 50px;height: 50px;"> <input class="form-control pr-phone"  type="text" value="' +$data.phoneNumber+'"></p>' +
                        '<p class="card-text"><img class="profile-icon" src="{{url('assets/images/customerIcons/address.png')}}" style="width: 50px;height: 50px;"> <input class="form-control pr-address" type="text" value="' +$data.address+'"></p>' +
                        '<button class="btn btn-info edit-profile-btn">edit profile</button>' +

                        '</div>' +


                        '</div> </li>   </ul> ');
                }

            });

        }

        function loadActiveTrips() {
            $.ajax({
               type: "get",
                url: "{{url('getActiveTrips')}}/"+customerID,
                success: function ($data) {
                   console.log("data here");

                    console.log($data);
                    for(i=0; i<$data[0].length;i++){
                    $(".active-trips-place").append('<tr>' +
                        '<td></td>' +
                        '<td>'+$data[0][i].startStation+'</td>' +
                        '<td>'+$data[0][i].stopStation+'</td>' +
                        '<td>'+$data[0][i].departureDate+'</td>' +
                        '<td>'+$data[0][i].departureTime+'</td>' +
                        '<td>'+$data[0][i].priceForSeat+'</td>' +
                        '<td class="seats-num">'+$data[1][i].seatsNumber+'</td>' +

                        '</tr>');
                    }
                activeTrips=$data.length;
                 $(".active-trips-val").text(activeTrips);
                }

            });
        }

        function loadFollowingCompanies(){
            $.ajax({
               type: "get",
               url: "{{url('loadFollowingCompanies')}}/"+customerID,
                success: function ($data) {
                    $(".following-companies-val").text($data);

                },
            });
        }



        function editProfile(){
            console.log("ali");
            console.log($(".pr-name").val());
            console.log($(".pr-email").val());
            console.log($(".pr-password").val());
            console.log($(".pr-address").val());
            console.log($(".pr-phone").val());
            console.log($(".pr-card").val());

            $.ajax({

               type: "post",
               url: "{{route('editProfile')}}",
                data:{
                    _token: "{{csrf_token()}}",
                    customerID:"{{request()->route('customerID')}}",
                    newName:$(".pr-name").val(),
                    newEmail:$(".pr-email").val(),
                    newPassword:$(".pr-password").val(),
                    newAddress:$(".pr-address").val(),
                    newPhoneNumber:$(".pr-phone").val(),
                },
                success: function ($data) {
                   console.log($data);
                   if($data == "information updated"){

                        alert($data);
                        clear(".profile-info");
                        loadProfileInfo();
                   }
                   else{
                       alert($data);

                   }
                    console.log($data);
                }
            });
        }

        function clear(tagName) {
            $(tagName).text("");

        }

        function getStatistics(){
            $.ajax({

               type: "get",
               url: "{{url('getStatistics')}}/"+customerID,
               success: function ($dt) {
                   console.log($dt);
                    $(".all-trips-val").text($dt.tripsNum);
                    $(".trips-payment-cash-val").text($dt.cashTrips);
                    $(".trips-payment-byCard-val").text($dt.byCardTrips);
                    $(".total-amount-val").text($dt.totalAmount+"sp");
               },
            });

        }

        function loadCardDetails() {

            $.ajax({

                type: "get",

                url: "{{url('loadCardDetails')}}/"+customerID,
                success: function ($data) {
                    if($data == "no card"){

                        $(".card-details-place").append('<h3>No Card</h3>' +
                            '<ul class="list-group">' +
                            '<li class="list-group-item active"></li>'+
                            '</ul>'+
                            '<button class="btn btn-info create-card-btn">create new card </button>'
                    );
                    }
                    else{
                        $(".card-details-place").append('<ul class="list-group">' +
                            '<li class="list-group-item active"></li>'+
                            '<li class="list-group-item"><img src="{{url('assets/images/customerIcons/card.png')}}" style="width:50px;heigth:50px"><span class="card-value">'+$data.cardNumber+'</span></li>' +
                            '<li class="list-group-item"><img src="{{url('assets/images/customerIcons/coins.png')}}"style="width:50px;heigth:50px"> <span class="balance-value">'+$data.balance+"sp"+'</span></li>' +
                            '</ul>'+
                            '<button class="btn btn-info add-balance-btn">add Balance </button>');
                    }
                }

            });
        }

        $(".card-details-place").delegate('.add-balance-btn','click',function () {
           status++;
            if(status %2 ==0){
            $(".add-balance-form").slideUp();
            }
            else{
                $(".balance-card-place").html('<div class=" add-balance-form">'+
                    '<span>input balance card here</span>'+
                    '<input type="number" class="form-control" placeholder="" aria-describedby="basic-addon1">'+
                    '<button class="btn btn-info accept-add-balance-btn">add</button>')+
                '</div>'
            }


        })

        $(".card-details-place").delegate('.create-card-btn','click',function () {
            console.log(customerID);
            $.ajax({

               type: "get",
               url: "{{url('createCard')}}/"+customerID,
               success: function ($data){
                 console.log($data);
                 if($data == "card created"){
                     alert($data);
                     location.reload();

                 }
               },
            });
        })
    </script>
@stop

