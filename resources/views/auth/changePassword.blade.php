@extends("admin.layouts.master")
@section("title")
Forgot Password
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
    .captcha-code > img {
    	border-radius: 4px;
    }
    .text-danger {
    	color: #fe784d !important;
    }
    .registration-form {
    	min-width: 370px;
    }
    @media (min-width: 320px) and (max-width: 767px) { 
	      .registration-form {
	    	min-width: 100%;
	    } 
    }
</style>
 <form class="registration-form py-5" action="{{ route('changePasswordPost') }}" method="POST" style="margin: 0 auto 20px auto;">
    <div class="card mb-0">
        <div class="card-body">
            <div class="text-center mb-3">
                <span id="regIcon">
                     <i class='icon-key icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1'></i>
                </span>
                <h5 class="mb-0">Password Reset</h5>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="text" class="form-control" placeholder="Password Reset Code" name="code" required="required" value="{{ old('code') }}" autocomplete="new-code">
                <div class="form-control-feedback">
                    <i class="icon-key text-muted"></i>
                </div>
                {!! $errors->first('code', '<p class="text-danger small">:message</p>') !!}
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
                <input type="password" class="form-control" placeholder="New Password" name="password" required="required" value="{{ old('password') }}" autocomplete="new-password">
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
                {!! $errors->first('password', '<p class="text-danger small">:message</p>') !!}
            </div>

            <div class="captcha-code mb-2">
                {!! captcha_img('flat') !!}
            </div>
            <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required="required">
                <div class="form-control-feedback">
                    <i class="icon-font-size text-muted"></i>
                </div>
                {!! $errors->first('captcha', '<p class="text-danger small">:message</p>') !!}
            </div>

            @csrf
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" style="height: 2.8rem; font-size: 1rem;">Reset Password <i
                    class="icon-circle-right2 ml-2"></i></button>
            </div>

            <div class="content-divider text-muted form-group"><span> OR </span></div>
            <div class="content d-flex justify-content-center align-items-center mt-3">
                <a class="btn btn-lg btn-registerBtn mr-2" href="{{ route('get.login') }}">Login to Admin or Store Owner</a>
            </div>
        </div>
    </div>
</form>

@if(Session::has('invalidFields'))
    <script>
        $(function () {
            $.jGrowl("{{ Session::get('invalidFields') }}", {
                position: 'bottom-center',
                header: 'Woopss!!!',
                theme: 'bg-danger',
            });    
        });
    </script>
@endif
@endsection