@extends("admin.layouts.master")
@section("title")
Login
@endsection
@section("content")
<style>
    .btn-registerBtn {
        background-color: #ffffff;
        color: #2b2b2b;
        border-radius: 4px;
        transition: 0.2s linear all !important;
        border: 1px solid #c2c2c2;
        transition: 0.2s linear all !important;
    }
    .btn-registerBtn:hover {
        background-color: #f7f2ff !important;
        color: #2b2b2b;
        transition: 0.2s linear all !important;
        border-color: transparent;
    }
</style>

    <form class="registration-form py-5" action="{{ route('post.login') }}" method="POST" id="loginForm" style="margin: 0 auto 20px auto;">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ substr(url('/'), 0, strrpos(url('/'), '/')) }}/assets/img/logos/{{ config('appSettings.storeLogo') }}" alt="logo" class="img-fluid mb-3 mt-2" style="width: 135px;">
                    <h5 class="mb-0">Login to Dashboard</h5>
                    <span class="d-block text-muted">Enter your credentials below</span>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <label class="d-flex align-items-center">
                        <input type="checkbox" checked="checked" name="remember" class="mr-1" style="height: 1rem; width: 1rem">
                        <span>Remember me?</span>
                    </label>
                </div>
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block" style="height: 2.8rem; font-size: 1rem;">Log in <i
                        class="icon-circle-right2 ml-2"></i></button>
                </div>


                @if(config('appSettings.enPassResetEmail') == 'true')
                <div class="mb-2">
                    <a href="{{ route('forgotPassword') }}">Forgot Password?</a>
                </div>
                @endif

                <div class="content-divider text-muted form-group"><span> OR </span></div>
                <div class="content d-flex justify-content-center align-items-center mt-3">
                    <a class="btn btn-lg btn-registerBtn mr-2" href="{{ route('storeRegistration') }}">Register for Store</a>
                    <a class="btn btn-lg btn-registerBtn" href="{{ route('deliveryRegistration') }}">Register for Delivery</a>
                </div>
            </div>
        </div>
    </form>
@endsection