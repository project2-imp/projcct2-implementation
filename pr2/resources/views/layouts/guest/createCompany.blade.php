@extends('layouts.formTamplate')
@section('createCompany')
    <div class="main">

        <section class="signup">
            <div class="container">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            @if($status[0] == 0)

                    <div class="signup-content">



                        <form method="POST" id="signup-form" action="{{route('createCompanyAccount')}}" enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <h2 class="form-title">Create company account</h2>

                            <div class="form-group">
                                <input type="text" class="form-input" name="companyName" id="companyName" placeholder="Your company Name"/>
                            </div>

                            @error('companyName')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <input type="email" class="form-input" name="email" id="email" placeholder="company Email"/>
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
                                <input type="number" class="form-input" name="phoneNumber" id="phoneNumber" placeholder="company phone number"/>
                            </div>

                            @error('phoneNumber')
                            <small class="form-text label-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <input type="text" class="form-input" name="address" id="address" placeholder="company address"/>
                            </div>

                            @error('address')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="alert alert-light">select company Icon</label>
                                <input type="file" class=" form-control btn btn-dark"  name="companyIcon" />
                            </div>


                            <div class="form-group">
                                <input type="submit" name="submit" id="submit" class="form-submit" value="create new company"/>
                            </div>

                        </form>

                        <p class="loginhere">
                            Have already an company account ? <a href="{{route('loginCompanyAccount')}}" class="loginhere-link">Login company</a>
                        </p>
                    </div>

                @else
                <div class="alert alert-success" role="alert">
                    <h1 class="company-name"> {{$status[1]}} </h1>
                    <h2>Thank you for registeration</h2>
                    <p>Your request has been received
                    we will send accept or reject message for your email</p>
                </div>
                <a href="{{route('index')}}" class="btn btn-success">back to main page</a>

            @endif
                </div>
        </section>

    </div>



@stop