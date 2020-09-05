<div class="row header">
    <div class="col-lg-7">

        <ul class="header " >

                <li role="presentation" class="header-li brand"><img src="{{url('assets/images/logo/logo.jpg')}}" style="width:100px;height:100px"></li>

        @if($status[0] === 1)
                <li role="presentation" class="header-li logout"><a href="{{route('index')}}">log out</a></li>
                <li role="presentation" class="header-li customer-name"><a href="{{route('CustomerProfile',$status[1]->name)}}">{{$status[1]->name}}</a></li>
            @else
                <li role="presentation" class="header-li login"><a href="{{route('login')}}">login</a></li>
                <li role="presentation" class="header-li signup"><a href="{{route('signUP')}}" >sign up</a></li>
            @endif
            <li role="presentation" class="header-li home"><a href="{{route('index')}}">Home</a></li>
            <li role="presentation" class="header-li get-companies"><a href="#">companies</a></li>
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
    $(".companies-area").hide();
    $(".browse-trips").click(function () {
        $('html,body').animate({
            scrollTop: $(".trips-place").offset().top
        }, 'slow');
       });

    $(".get-companies").click(function () {
    $.ajax({
       type: "get",
       url: "{{route('getCompanies')}}",
       success: function ($data) {
            $(".header").fadeOut();
           console.log("length");
           console.log($data[0].length);
           for(var $x = 0 ; $x <$data[0].length ; $x++) {
               $(".companies-area").append('<div class="row">'+
                   '<div class="col-md-3 col-sm-6">'+
                   '<div class="card card-block">'+
                   '<h4 class="card-title text-right"><i class="material-icons">'+$data[0][$x].name+'</i></h4>'+
                   '<img src="uploads/companiesIcons/'+$data[0][$x].imagePath+'" alt="company Icon">'+
                   '<h5 class="card-title mt-3 mb-3">'+$data[0][$x].name+'</h5>'+
                   '<p class="card-text">'+$data[0][$x].address+'</p>'+
                   '<p class="card-text">'+$data[0][$x].phoneNumber+'</p>'+
                   '</div>'+
                   '</div>'
           );

           }
           },
        error:function ($a) {
            console.log($a);
        }
    });
        $(".companies-area").slideToggle();
        $('html,body').animate({
            scrollTop: $(".companies-area").offset().top
        }, 'fast');    });

    </script>
@stop
