@extends('layouts.formTamplate')
@section('signup')
<div class="main">

    <section class="signup">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container">
            <div class="signup-content">

                <form method="POST" id="signup-form" action="{{route('createCustomerAccount')}}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <h2 class="form-title">Create customer account</h2>

                    <div class="form-group">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                    </div>

                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                    </div>

                    @error('email')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <div class="form-group">
                        <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                    </div>

                    @error('password')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <div class="form-group">
                        <input type="number" class="form-input" name="phoneNumber" id="phoneNumber" placeholder="your phone number"/>
                    </div>

                    @error('phoneNumber')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <div class="form-group">
                        <input type="text" class="form-input" name="address" id="address" placeholder="your address"/>
                    </div>

                    @error('address')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <div class="form-group">
                        <label class="alert alert-light">select profile picutre</label>
                        <input type="file" class=" form-control btn btn-dark"  name="customerIcon" />
                    </div>
                    @error('image')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror

                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                    </div>


                </form>

                <p class="loginhere">
                    Have already an account ? <a href="{{route('login')}}" class="loginhere-link">Login here</a>
                </p>
            </div>
        </div>
    </section>

</div>

@stop
