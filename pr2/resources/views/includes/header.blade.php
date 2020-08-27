<div class="row header">
    <div class="col-lg-7">
        <ul class="header " >

            @if($status[0] === 1)
                <li role="presentation" class="header-li"><a href="{{route('index')}}">log out</a></li>
                <li role="presentation" class="header-li customer-name"><a href="{{route('CustomerProfile',$status[1]->name)}}">{{$status[1]->name}}</a></li>
            @else
                <li role="presentation" class="header-li"><a href="{{route('login')}}">login</a></li>
                <li role="presentation" class="header-li"><a href="{{route('signUP')}}" >sign up</a></li>
            @endif
            <li role="presentation" class="header-li"><a href="{{route('index')}}">Home</a></li>
            <li role="presentation" class="header-li"><a href="#">companies</a></li>
            <li role="presentation" class="header-li"><a href="#">about us</a></li>
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