@extends('layouts.layout_login')

@section('content_login')
<div id="logreg-forms">
    <form class="form-signin" method="POST" action="{{route('login')}}">
        @csrf
        <h1 class="h3 mb-3" style="text-align: center; font-weight: bold; color: #fff">Đăng nhập</h1>
        <div class="input-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group">
            <input style="margin: 20px 0;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="input-group">
          <button class="btn btn-md btn-rounded btn-block form-control submit" type="submit"><i class="fas fa-sign-in-alt"></i>{{ __('Login') }}</button>
        </div>

        {{-- <a href="#" id="forgot_pswd">Forgot password?</a>
        <hr>
        <!-- <p>Don't have an account!</p>  -->
        <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i>Đăng ký</button> --}}
    </form>

    <form action="#" class="form-reset">
        <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
        <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
    </form>

    <form action="#" class="form-signup">
        <div class="social-login">
            <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
        </div>
        <div class="social-login">
            <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
        </div>

        <p style="text-align:center">OR</p>

        <input type="text" id="user-name" class="form-control" placeholder="Full name" required="" autofocus="">
        <input type="email" id="user-email" class="form-control" placeholder="Email address" required autofocus="">
        <input type="password" id="user-pass" class="form-control" placeholder="Password" required autofocus="">
        <input type="password" id="user-repeatpass" class="form-control" placeholder="Confirm Password" required autofocus="">

        <div class="input-group">
            <button class="btn btn-md btn-block submit" type="submit"><i class="fas fa-user-plus"></i>Sign Up</button>
        </div>
        <a href="#" id="cancel_signup"><i class="fa fa-angle-left"></i> Back</a>
    </form>
    <br>
</div> 
@endsection