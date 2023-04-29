@extends('layouts.layout_login')

@section('content_login')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Xác thực địa chỉ email của bạn') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Một liên kết xác minh mới đã được gửi đến email của bạn. ') }}
                        </div>
                    @endif

                    {{ __('Trước khi tiếp tục, vui lòng kiểm tra email của bạn để biết liên kết xác minh.') }}
                    {{ __('Nếu bạn không nhận được email, hãy bấm vào liên kết phía dưới.') }} <br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resent') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Bấm vào đây để lấy yêu cầu xác minh mới') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
