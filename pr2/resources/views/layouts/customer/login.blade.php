@extends('layouts.formTamplate')
@section('login')

    <div class="main">

        <section class="login">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">

                    <form method="POST" id="signup-form" action="{{route('loginAccount')}}">

                        {{ csrf_field() }}

                        <h2 class="form-title">Login your Account</h2>

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

                        <div class="form-group error-login">


                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="login"/>
                        </div>

                    </form>

                    <p class="loginhere">
                        can't have an account ? <a href="{{route('signUP')}}" class="loginhere-link">sign up here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

@stop