@extends('layouts.formTamplate')
@section('inputVCode')
<div class="main">


    <section class="inputVCode">
        <!-- <img src="images/signup-bg.jpg" alt=""> -->
        <div class="container">
            <div class="signup-content">
                <form method="POST" id="signup-form" action="{{route('validationCode')}}">
                    {{ csrf_field() }}
                    <h2 class="form-title">visit your email and input validation code here </h2>
                    <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="your email"/>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-input" name="VCode" id="VCode" placeholder="put validation code here"/>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="send code"/>
                    </div>
                </form>
                <p class="loginhere">
                    Have already an account ? <a href="#" class="loginhere-link">Login here</a>
                </p>
            </div>
        </div>
    </section>

</div>

@stop