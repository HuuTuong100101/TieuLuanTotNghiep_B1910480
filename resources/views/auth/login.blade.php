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
        </form>
        <br>
    </div> 
@endsection