@extends('admin.layouts.master')
@section("title") Edit Translation - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">Editing Language</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $language_name }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.updateTranslation') }}" method="POST" enctype="multipart/form-data">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                    Save Translation
                    <i class="icon-database-insert ml-1"></i>
                    </button>
                </div>
                <input type="hidden" name="translation_id" value="{{ $translation_id }}">
                <div class="form-group row mt-3">
                    <label class="col-lg-3 col-form-label"><strong>Language Name</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="language_name" placeholder="Enter new language name" required="required" value="{{ $language_name }}">
                    </div>
                </div>
                <hr>
                <!-- DESKTOP -->
                <button class="btn btn-primary translation-section-btn" type="button"> <i class="icon-display4 mr-1"></i>Desktop Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Heading</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopHeading"
                            value="{{ $data->desktopHeading }}" placeholder="Heading Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Sub Heading</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="desktopSubHeading" placeholder="Sub Heading Text" rows="6">{{ $data->desktopSubHeading }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Use App Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopUseAppButton"
                            value="{{ $data->desktopUseAppButton }}" placeholder="Use App Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement One Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementOneTitle"
                            value="{{ $data->desktopAchievementOneTitle }}" placeholder="Achievement One Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement One Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementOneSub"
                            value="{{ $data->desktopAchievementOneSub }}" placeholder="Achievement One Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Two Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementTwoTitle"
                            value="{{ $data->desktopAchievementTwoTitle }}" placeholder="Achievement Two Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Two Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementTwoSub"
                            value="{{ $data->desktopAchievementTwoSub }}" placeholder="Achievement Two Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Three Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementThreeTitle"
                            value="{{ $data->desktopAchievementThreeTitle }}" placeholder="Achievement Four Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Three Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementThreeSub"
                            value="{{ $data->desktopAchievementThreeSub }}" placeholder="Achievement Three Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Four Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementFourTitle"
                            value="{{ $data->desktopAchievementFourTitle }}" placeholder="Achievement Four Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Four Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementFourSub"
                            value="{{ $data->desktopAchievementFourSub }}" placeholder="Achievement Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Address</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="desktopFooterAddress">{{ $data->desktopFooterAddress }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Social Heading Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopFooterSocialHeader"
                            value="{{ $data->desktopFooterSocialHeader }}" placeholder="Social Heading Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Facebook Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialFacebookLink"
                            value="{{ $data->desktopSocialFacebookLink }}" placeholder="Facebook Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Google Plus Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialGoogleLink"
                            value="{{ $data->desktopSocialGoogleLink }}" placeholder="Google Plus Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Youtube Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialYoutubeLink"
                            value="{{ $data->desktopSocialYoutubeLink }}" placeholder="Youtube Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Instagram Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialInstagramLink"
                            value="{{ $data->desktopSocialInstagramLink }}" placeholder="Instagram Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>GDPR Message</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="gdprMessage">{{ $data->gdprMessage }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>GDPR Confirm Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="gdprConfirmButton"
                            value="{{ $data->gdprConfirmButton }}" placeholder="GDPR Confirm Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Change Language Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="changeLanguageText"
                            value="@if (!empty($data->changeLanguageText)) {{ $data->changeLanguageText }}@else{{ config('appSettings.changeLanguageText') }}@endif" placeholder="Change Language Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Try It On Phone Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopTryItOnPhoneTitle" value="@if (!empty($data->desktopTryItOnPhoneTitle)) {{ $data->desktopTryItOnPhoneTitle }}@else{{ config('appSettings.desktopTryItOnPhoneTitle') }}@endif" placeholder="Try It On Phone Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Try It On Phone SubTitle</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopTryItOnPhoneSubTitle" value="@if (!empty($data->desktopTryItOnPhoneSubTitle)) {{ $data->desktopTryItOnPhoneSubTitle }}@else{{ config('appSettings.desktopTryItOnPhoneSubTitle') }}@endif" placeholder="Try It On Phone SubTitle">
                    </div>
                </div>
                <!-- END DESKTOP -->
                <!-- MOBILE -->
                <!-- First Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>First Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Heading</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenHeading"
                            value="{{ $data->firstScreenHeading }}" placeholder="First Screen Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Sub Heading</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenSubHeading"
                            value="{{ $data->firstScreenSubHeading }}" placeholder="First Screen Sub Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Setup Locaion Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenSetupLocation"
                            value="{{ $data->firstScreenSetupLocation }}" placeholder="Setup Location Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Welcome Message Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenWelcomeMessage"
                            value="{{ $data->firstScreenWelcomeMessage }}" placeholder="Welcome Message Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenLoginText"
                            value="{{ $data->firstScreenLoginText }}" placeholder="Login Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenLoginBtn"
                            value="{{ $data->firstScreenLoginBtn }}" placeholder="Login Button Text">
                    </div>
                </div>
                <!-- END First Screen Settings -->
                <!-- Login Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Login/Register Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Error Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginErrorMessage"
                            value="{{ $data->loginErrorMessage }}" placeholder="Login Error Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Please Wait Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pleaseWaitText"
                            value="{{ $data->pleaseWaitText }}" placeholder="Please Wait Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginTitle"
                            value="{{ $data->loginLoginTitle }}" placeholder="Login Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login SubTitle Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginSubTitle"
                            value="{{ $data->loginLoginSubTitle }}" placeholder="Login SubTitle Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Email Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginEmailLabel"
                            value="{{ $data->loginLoginEmailLabel }}" placeholder="Login Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Password Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginPasswordLabel"
                            value="{{ $data->loginLoginPasswordLabel }}" placeholder="Login Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Dont have Account</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginDontHaveAccount"
                            value="{{ $data->loginDontHaveAccount }}" placeholder="Login Dont have Account">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenRegisterBtn"
                            value="{{ $data->firstScreenRegisterBtn }}" placeholder="Register Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="registerRegisterTitle"
                            value="{{ $data->registerRegisterTitle }}" placeholder="Register Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register SubTitle Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="registerRegisterSubTitle"
                            value="{{ $data->registerRegisterSubTitle }}" placeholder="Register SubTitle Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Name Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginNameLabel"
                            value="{{ $data->loginLoginNameLabel }}" placeholder="Register Name Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Phone Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginPhoneLabel"
                            value="{{ $data->loginLoginPhoneLabel }}" placeholder="Register Phone Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Already Have Account</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="regsiterAlreadyHaveAccount"
                            value="{{ $data->regsiterAlreadyHaveAccount }}" placeholder="Register Already Have Account">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Required Fields Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="fieldValidationMsg"
                            value="{{ $data->fieldValidationMsg }}" placeholder="Field Required Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Name Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="nameValidationMsg"
                            value="{{ $data->nameValidationMsg }}" placeholder="Name Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Email Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="emailValidationMsg"
                            value="{{ $data->emailValidationMsg }}" placeholder="Email Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Phone Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="phoneValidationMsg"
                            value="{{ $data->phoneValidationMsg }}" placeholder="Phone Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Phone & Password Min Length Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="minimumLengthValidationMessage"
                            value="{{ $data->minimumLengthValidationMessage }}" placeholder="Phone & Password Min Length Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Email/Phone Already Registered Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="emailPhoneAlreadyRegistered"
                            value="{{ $data->emailPhoneAlreadyRegistered }}" placeholder="Email/Phone Already Registered Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Email and Password donot match</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="emailPassDonotMatch"
                            value="{{ $data->emailPassDonotMatch }}" placeholder="Email and Password donot match">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter Phone Number to Verify Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="enterPhoneToVerify"
                            value="{{ $data->enterPhoneToVerify }}" placeholder="Enter Phone Number Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid OTP Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="invalidOtpMsg"
                            value="{{ $data->invalidOtpMsg }}" placeholder="Invalid OTP Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>OTP Sent Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="otpSentMsg"
                            value="{{ $data->otpSentMsg }}" placeholder="OTP Sent Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Resend OTP Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resendOtpMsg"
                            value="{{ $data->resendOtpMsg }}" placeholder="Resend OTP Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Resend OTP Countdown Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resendOtpCountdownMsg"
                            value="{{ $data->resendOtpCountdownMsg }}" placeholder="Resend OTP Countdown Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Verify OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="verifyOtpBtnText"
                            value="{{ $data->verifyOtpBtnText }}" placeholder="Verify OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Social Login 'Hi' Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="socialWelcomeText"
                            value="{{ $data->socialWelcomeText }}" placeholder="Social Login 'Hi' Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Social Login OR Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="socialLoginOrText"
                            value="{{ $data->socialLoginOrText }}" placeholder="Social Login OR Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Forgot Password Link Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="forgotPasswordLinkText" value="@if (!empty($data->forgotPasswordLinkText)) {{ $data->forgotPasswordLinkText }}@else{{ config('appSettings.forgotPasswordLinkText') }}@endif" placeholder="Forgot Password Link Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Reset Password Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resetPasswordPageTitle" value="@if (!empty($data->resetPasswordPageTitle)) {{ $data->resetPasswordPageTitle }}@else{{ config('appSettings.resetPasswordPageTitle') }}@endif" placeholder="Reset Password Page Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Reset Password Page Sub Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resetPasswordPageSubTitle" value="@if (!empty($data->resetPasswordPageSubTitle)) {{ $data->resetPasswordPageSubTitle }}@else{{ config('appSettings.resetPasswordPageSubTitle') }}@endif" placeholder="Reset Password Page Sub Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>User Not Found Error Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="userNotFoundErrorMessage" value="@if (!empty($data->userNotFoundErrorMessage)) {{ $data->userNotFoundErrorMessage }}@else{{ config('appSettings.userNotFoundErrorMessage') }}@endif" placeholder="User Not Found Error Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid Reset OTP Error Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="invalidOtpErrorMessage" value="@if (!empty($data->invalidOtpErrorMessage)) {{ $data->invalidOtpErrorMessage }}@else{{ config('appSettings.invalidOtpErrorMessage') }}@endif" placeholder="Invalid Reset OTP Error Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Send OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="sendOtpOnEmailButtonText" value="@if (!empty($data->sendOtpOnEmailButtonText)) {{ $data->sendOtpOnEmailButtonText }}@else{{ config('appSettings.sendOtpOnEmailButtonText') }}@endif" placeholder="Send OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Already Have OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="alreadyHaveResetOtpButtonText" value="@if (!empty($data->alreadyHaveResetOtpButtonText)) {{ $data->alreadyHaveResetOtpButtonText }}@else{{ config('appSettings.alreadyHaveResetOtpButtonText') }}@endif" placeholder="Already Have OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Dont Have OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="dontHaveResetOtpButtonText" value="@if (!empty($data->dontHaveResetOtpButtonText)) {{ $data->dontHaveResetOtpButtonText }}@else{{ config('appSettings.dontHaveResetOtpButtonText') }}@endif" placeholder="Dont Have OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter Reset OTP Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="enterResetOtpMessageText" value="@if (!empty($data->enterResetOtpMessageText)) {{ $data->enterResetOtpMessageText }}@else{{ config('appSettings.enterResetOtpMessageText') }}@endif" placeholder="Enter Reset OTP Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Verify Reset OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="verifyResetOtpButtonText" value="@if (!empty($data->verifyResetOtpButtonText)) {{ $data->verifyResetOtpButtonText }}@else{{ config('appSettings.verifyResetOtpButtonText') }}@endif" placeholder="Verify Reset OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter New Password Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="enterNewPasswordText" value="@if (!empty($data->enterNewPasswordText)) {{ $data->enterNewPasswordText }}@else{{ config('appSettings.enterNewPasswordText') }}@endif" placeholder="Enter New Password Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Password Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="newPasswordLabelText" value="@if (!empty($data->newPasswordLabelText)) {{ $data->newPasswordLabelText }}@else{{ config('appSettings.newPasswordLabelText') }}@endif" placeholder="New Password Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Set New Password Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="setNewPasswordButtonText" value="@if (!empty($data->setNewPasswordButtonText)) {{ $data->setNewPasswordButtonText }}@else{{ config('appSettings.setNewPasswordButtonText') }}@endif" placeholder="Set New Password Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login/Registration Policy Message</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="registrationPolicyMessage" placeholder="Sub Heading Text" rows="6">@if (!empty($data->registrationPolicyMessage)) {{ $data->registrationPolicyMessage }}@else{{ config('appSettings.registrationPolicyMessage') }}@endif</textarea>
                    </div>
                </div>
                <!-- END Login Screen Settings-->
                <!-- HomePage Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>HomePage Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Custom Home Message
                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize mx-1">NEW</span> <i class="icon-question3 ml-1" data-popup="tooltip" title="This will be displayed after the promo sliders and before the stores on the homepage (Custom HTML can be used)" data-placement="left"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="customHomeMessage" placeholder="Custom Home Message - Leave empty to hide" rows="6">@if (!empty($data->customHomeMessage)) {{ $data->customHomeMessage }}@else{{ config('appSettings.customHomeMessage') }}@endif</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTypeDelivery"
                            value="{{ $data->deliveryTypeDelivery }}" placeholder="Delivery Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Self Pickup Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTypeSelfPickup"
                            value="{{ $data->deliveryTypeSelfPickup }}" placeholder="Self Pickup Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Store Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noRestaurantMessage"
                            value="{{ $data->noRestaurantMessage }}" placeholder="No Store Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Count Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantCountText"
                            value="{{ $data->restaurantCountText }}" placeholder="Store Count Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Featured Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantFeaturedText"
                            value="{{ $data->restaurantFeaturedText }}" placeholder="Store Featured Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Mins Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="homePageMinsText"
                            value="{{ $data->homePageMinsText }}" placeholder="Mins Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>For Two Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="homePageForTwoText"
                            value="{{ $data->homePageForTwoText }}" placeholder="For Two Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Near Me Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerNearme"
                            value="{{ $data->footerNearme }}" placeholder="Footer Near Me Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Explore Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerExplore"
                            value="{{ $data->footerExplore }}" placeholder="Footer ExploreText">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerCart"
                            value="{{ $data->footerCart }}" placeholder="Footer Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Account Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerAccount"
                            value="{{ $data->footerAccount }}" placeholder="Footer Account Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Alerts Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerAlerts"
                            value="@if (!empty($data->footerAlerts)) {{ $data->footerAlerts }}@else{{ config('appSettings.footerAlerts') }}@endif" placeholder="Footer Alerts Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Results Found Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exploreNoResults"
                            value="@if (!empty($data->exploreNoResults)) {{ $data->exploreNoResults }}@else{{ config('appSettings.exploreNoResults') }}@endif" placeholder="Footer Account Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Restaurant Not Active Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantNotActiveMsg"
                            value="@if (!empty($data->restaurantNotActiveMsg)) {{ $data->restaurantNotActiveMsg }}@else{{ config('appSettings.restaurantNotActiveMsg') }}@endif" placeholder="Restaurant Not Active Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Homepage SearchBar Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="mockSearchPlaceholder"
                            value="@if (!empty($data->mockSearchPlaceholder)) {{ $data->mockSearchPlaceholder }}@else{{ config('appSettings.mockSearchPlaceholder') }}@endif" placeholder="Homepage SearchBar Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer PWA Install Prompt Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pwaInstallFooterMessage" value="@if (!empty($data->pwaInstallFooterMessage)) {{ $data->pwaInstallFooterMessage }}@else{{ config('appSettings.pwaInstallFooterMessage') }}@endif" placeholder="Footer PWA Install Prompt Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer PWA Install Prompt Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pwaInstallFooterInstallText" value="@if (!empty($data->pwaInstallFooterInstallText)) {{ $data->pwaInstallFooterInstallText }}@else{{ config('appSettings.pwaInstallFooterInstallText') }}@endif" placeholder="Footer PWA Install Prompt Button Text">
                    </div>
                </div>
                <!--END HomePage Screen Settings -->
                <!-- Alerts Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Alerts Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Mark All Read Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="markAllAlertReadText"
                            value="@if (!empty($data->markAllAlertReadText)) {{ $data->markAllAlertReadText }}@else{{ config('appSettings.markAllAlertReadText') }}@endif" placeholder="Mark All Read Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No New Alerts Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noNewAlertsText"
                            value="@if (!empty($data->noNewAlertsText)) {{ $data->noNewAlertsText }}@else{{ config('appSettings.noNewAlertsText') }}@endif" placeholder="No New Alerts Text">
                    </div>
                </div>
                <!-- END Alerts Screen Settings -->
                <!-- Explore Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Explore Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Search Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantSearchPlaceholder"
                            value="{{ $data->restaurantSearchPlaceholder }}" placeholder="Store Search Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exploreRestautantsText"
                            value="{{ $data->exploreRestautantsText }}" placeholder="Stores Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Items Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exploreItemsText"
                            value="{{ $data->exploreItemsText }}" placeholder="Items Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter At Least 3 Characters Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="searchAtleastThreeCharsMsg"
                            value="{{ $data->searchAtleastThreeCharsMsg }}" placeholder="Enter At Least 3 Characters Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Explore Item's By Store Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exlporeByRestaurantText" value="@if (!empty($data->exlporeByRestaurantText)) {{ $data->exlporeByRestaurantText }}@else{{ config('appSettings.exlporeByRestaurantText') }}@endif" placeholder="Explore Item's By Store Text">
                    </div>
                </div>
                <!-- END Explore Screen Settings -->
                <!-- Items Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Items Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Recommended Badge Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="recommendedBadgeText"
                            value="{{ $data->recommendedBadgeText }}" placeholder="Recommended Badge Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popular Item Badge Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="popularBadgeText"
                            value="{{ $data->popularBadgeText }}" placeholder="Popular Item Badge Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Item Badge Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="newBadgeText"
                            value="{{ $data->newBadgeText }}" placeholder="New Item Badge Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Recommended Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemsPageRecommendedText"
                            value="{{ $data->itemsPageRecommendedText }}" placeholder="Recommended Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Fixed Cart View Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="floatCartViewCartText"
                            value="{{ $data->floatCartViewCartText }}" placeholder="Fixed Cart View Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Fixed Cart Items Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="floatCartItemsText"
                            value="{{ $data->floatCartItemsText }}" placeholder="Fixed Cart Items Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Customizable Item Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customizableItemText"
                            value="{{ $data->customizableItemText }}" placeholder="Customization Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Customization Heading</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customizationHeading"
                            value="{{ $data->customizationHeading }}" placeholder="Customization Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Customizable Done Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customizationDoneBtnText"
                            value="{{ $data->customizationDoneBtnText }}" placeholder="Customizable Done Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pure Veg Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pureVegText"
                            value="{{ $data->pureVegText }}" placeholder="Pure Veg Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Certificate Code Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="certificateCodeText"
                            value="{{ $data->certificateCodeText }}" placeholder="Certificate Code Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show More Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="showMoreButtonText"
                            value="{{ $data->showMoreButtonText }}" placeholder="Show More Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Less Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="showLessButtonText"
                            value="{{ $data->showLessButtonText }}" placeholder="Show Less Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Not Accepting Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="notAcceptingOrdersMsg"
                            value="{{ $data->notAcceptingOrdersMsg }}" placeholder="Not Accepting Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Search Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemSearchPlaceholder"
                            value="@if (!empty($data->itemSearchPlaceholder)) {{ $data->itemSearchPlaceholder }}@else{{ config('appSettings.itemSearchPlaceholder') }}@endif" placeholder="Item Search Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Search Reuslts Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemSearchText"
                            value="@if (!empty($data->itemSearchText)) {{ $data->itemSearchText }}@else{{ config('appSettings.itemSearchText') }}@endif" placeholder="Item Search Reuslts Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Search No Results Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemSearchNoResultText"
                            value="@if (!empty($data->itemSearchNoResultText)) {{ $data->itemSearchNoResultText }}@else{{ config('appSettings.itemSearchNoResultText') }}@endif" placeholder="Item Search No Results Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Menu Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemsMenuButtonText"
                            value="@if (!empty($data->itemsMenuButtonText)) {{ $data->itemsMenuButtonText }}@else{{ config('appSettings.itemsMenuButtonText') }}@endif" placeholder="Item Menu Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Percentage Discount Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemPercentageDiscountText"
                            value="@if (!empty($data->itemPercentageDiscountText)) {{ $data->itemPercentageDiscountText }}@else{{ config('appSettings.itemPercentageDiscountText') }}@endif" placeholder="Item Percentage Discount Text">
                    </div>
                </div>
                <!--END Items Screen Settings -->
                <!-- Cart Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Cart Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Custom Cart Message
                    <span class="badge badge-flat border-grey-800 text-danger text-capitalize mx-1">NEW</span> <i class="icon-question3 ml-1" data-popup="tooltip" title="This will be displayed on top of the cart page (Custom HTML can be used)" data-placement="left"></i>
                    </strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="customCartMessage" placeholder="Custom Cart Message - Leave empty to hide" rows="6">@if (!empty($data->customCartMessage)) {{ $data->customCartMessage }}@else{{ config('appSettings.customCartMessage') }}@endif
                        </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartPageTitle"
                            value="{{ $data->cartPageTitle }}" placeholder="Cart Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Items In Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartItemsInCartText"
                            value="{{ $data->cartItemsInCartText }}" placeholder="Items In Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Empty Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartEmptyText"
                            value="{{ $data->cartEmptyText }}" placeholder="Empty Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Suggestions Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartSuggestionPlaceholder"
                            value="{{ $data->cartSuggestionPlaceholder }}" placeholder="Cart Suggestions Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Coupon Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartCouponText"
                            value="{{ $data->cartCouponText }}" placeholder="Cart Coupon Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Applied Coupon Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartApplyCoupon"
                            value="{{ $data->cartApplyCoupon }}" placeholder="Applied Coupon Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid Coupon Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartInvalidCoupon"
                            value="{{ $data->cartInvalidCoupon }}" placeholder="Invalid Coupon Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Coupon Off Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartCouponOffText"
                            value="{{ $data->cartCouponOffText }}" placeholder="Coupon Off Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Coupon Not Logged In</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="couponNotLoggedin" value="@if (!empty($data->couponNotLoggedin)) {{ $data->couponNotLoggedin }}@else{{ config('appSettings.couponNotLoggedin') }}@endif" placeholder="Coupon Not Logged In">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Apply Coupon Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="applyCouponButtonText" value="@if (!empty($data->applyCouponButtonText)) {{ $data->applyCouponButtonText }}@else{{ config('appSettings.applyCouponButtonText') }}@endif"  placeholder="Apply Coupon Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Bill Details Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartBillDetailsText"
                            value="{{ $data->cartBillDetailsText }}" placeholder="Cart Bill Details Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Total Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartItemTotalText"
                            value="{{ $data->cartItemTotalText }}" placeholder="Cart Total Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart To Pay Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartToPayText"
                            value="{{ $data->cartToPayText }}" placeholder="Cart To Pay Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Charges Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryCharges"
                            value="{{ $data->cartDeliveryCharges }}" placeholder="Delivery Charges Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Charges Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRestaurantCharges"
                            value="{{ $data->cartRestaurantCharges }}" placeholder="Store Charges Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Select Your Address Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartSetYourAddress"
                            value="{{ $data->cartSetYourAddress }}" placeholder="Cart Select Your Address Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Address Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="buttonNewAddress"
                            value="{{ $data->buttonNewAddress }}" placeholder="New Address Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Change Location Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartChangeLocation"
                            value="{{ $data->cartChangeLocation }}" placeholder="Cart Change Location Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Deliver To Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliverTo"
                            value="{{ $data->cartDeliverTo }}" placeholder="Cart Deliver To Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Select Payment Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutSelectPayment"
                            value="{{ $data->checkoutSelectPayment }}" placeholder="Select Payment Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Login Header Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartLoginHeader"
                            value="{{ $data->cartLoginHeader }}" placeholder="Cart Login Header Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Login Sub Header Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartLoginSubHeader"
                            value="{{ $data->cartLoginSubHeader }}" placeholder="Cart Login Sub Header">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Login Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartLoginButtonText"
                            value="{{ $data->cartLoginButtonText }}" placeholder="Cart Login Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Self Pikcup Selected Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="selectedSelfPickupMessage"
                            value="{{ $data->selectedSelfPickupMessage }}" placeholder="Self Pikcup Selected Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tax Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="taxText"
                            value="{{ $data->taxText }}" placeholder="Tax Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Items Removed Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemsRemovedMsg"
                            value="{{ $data->itemsRemovedMsg }}" placeholder="Items Removed Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>On-going Order Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="ongoingOrderMsg"
                            value="{{ $data->ongoingOrderMsg }}" placeholder="On-going Order Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Not Operational Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRestaurantNotOperational"
                            value="{{ $data->cartRestaurantNotOperational }}" placeholder="Store Not Operational Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Min Order Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantMinOrderMessage"
                            value="@if (!empty($data->restaurantMinOrderMessage)) {{ $data->restaurantMinOrderMessage }}@else{{ config('appSettings.restaurantMinOrderMessage') }}@endif" placeholder="Min Order Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Remove Item Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRemoveItemButton"
                            value="@if (!empty($data->cartRemoveItemButton)) {{ $data->cartRemoveItemButton }}@else{{ config('appSettings.cartRemoveItemButton') }}@endif" placeholder="Remove Item Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Not Available Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartItemNotAvailable"
                            value="@if (!empty($data->cartItemNotAvailable)) {{ $data->cartItemNotAvailable }}@else{{ config('appSettings.cartItemNotAvailable') }}@endif" placeholder="Item Not Available Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Total Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderTextTotal"
                            value="@if (!empty($data->orderTextTotal)) {{ $data->orderTextTotal }}@else{{ config('appSettings.orderTextTotal') }}@endif"  placeholder="Order Total Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Bill Detail Delivery Tip Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipText" value="@if (!empty($data->tipText)) {{ $data->tipText }}@else {{ config('appSettings.tipText') }} @endif" placeholder="Bill Detail Delivery Tip Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Tip Header Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipsForDeliveryText" value="@if (!empty($data->tipsForDeliveryText)) {{ $data->tipsForDeliveryText }}@else {{ config('appSettings.tipsForDeliveryText') }} @endif" placeholder="Delivery Tip Header Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Tip Thank You Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipsThanksText" value="@if (!empty($data->tipsThanksText)) {{ $data->tipsThanksText }}@else {{ config('appSettings.tipsThanksText') }} @endif" placeholder="Delivery Tip Thank You Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Other Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipsOtherText" value="@if (!empty($data->tipsOtherText)) {{ $data->tipsOtherText }}@else {{ config('appSettings.tipsOtherText') }} @endif" placeholder="Tip Other Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery tip transaction Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTipTransactionMessage" value="@if (!empty($data->deliveryTipTransactionMessage)) {{ $data->deliveryTipTransactionMessage }}@else  {{ config('appSettings.deliveryTipTransactionMessage') }}@endif" placeholder="Delivery tip transaction Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Remove Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRemoveTipText" value="@if (!empty($data->cartRemoveTipText)) {{ $data->cartRemoveTipText }}@else  {{ config('appSettings.cartRemoveTipText') }}@endif" placeholder="Tip Remove Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Amount Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartTipAmountPlaceholderText" value="@if (!empty($data->cartTipAmountPlaceholderText)) {{ $data->cartTipAmountPlaceholderText }}@else  {{ config('appSettings.cartTipAmountPlaceholderText') }}@endif" placeholder="Tip Amount Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Percentage Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartTipPercentagePlaceholderText" value="@if (!empty($data->cartTipPercentagePlaceholderText)) {{ $data->cartTipPercentagePlaceholderText }}@else  {{ config('appSettings.cartTipPercentagePlaceholderText') }}@endif" placeholder="Tip Percentage Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Paid with wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderAmountPaidWithWallet" value="@if (!empty($data->orderAmountPaidWithWallet)) {{ $data->orderAmountPaidWithWallet }}@else  {{ config('appSettings.orderAmountPaidWithWallet') }}@endif" placeholder="Order Paid with wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Amount remaining to pay text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderAmountRemainingToPay" value="@if (!empty($data->orderAmountRemainingToPay)) {{ $data->orderAmountRemainingToPay }}@else  {{ config('appSettings.orderAmountRemainingToPay') }}@endif" placeholder="Order Amount remaining to pay text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Delivery Type Options Available Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryTypeOptionAvailableText" value="@if (!empty($data->cartDeliveryTypeOptionAvailableText)) {{ $data->cartDeliveryTypeOptionAvailableText }}@else  {{ config('appSettings.cartDeliveryTypeOptionAvailableText') }}@endif" placeholder="Cart Delivery Type Options Available Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Delivery Type Selected Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryTypeSelectedText" value="@if (!empty($data->cartDeliveryTypeSelectedText)) {{ $data->cartDeliveryTypeSelectedText }}@else  {{ config('appSettings.cartDeliveryTypeSelectedText') }}@endif" placeholder="Cart Delivery Type Selected Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Type Change Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryTypeChangeButtonText" value="@if (!empty($data->cartDeliveryTypeChangeButtonText)) {{ $data->cartDeliveryTypeChangeButtonText }}@else  {{ config('appSettings.cartDeliveryTypeChangeButtonText') }}@endif" placeholder="Delivery Type Change Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Choose Delivery Type Popup Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartChooseDeliveryTypeTitle" value="@if (!empty($data->cartChooseDeliveryTypeTitle)) {{ $data->cartChooseDeliveryTypeTitle }}@else  {{ config('appSettings.cartChooseDeliveryTypeTitle') }}@endif" placeholder="Choose Delivery Type Popup Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemTitle" value="@if (!empty($data->cartReplaceItemTitle)) {{ $data->cartReplaceItemTitle }}@else  {{ config('appSettings.cartReplaceItemTitle') }}@endif" placeholder="Cart Replace Item Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Sub Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemSubTitle" value="@if (!empty($data->cartReplaceItemSubTitle)) {{ $data->cartReplaceItemSubTitle }}@else  {{ config('appSettings.cartReplaceItemSubTitle') }}@endif" placeholder="Cart Replace Item Sub Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Action No</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemActionNo" value="@if (!empty($data->cartReplaceItemActionNo)) {{ $data->cartReplaceItemActionNo }}@else  {{ config('appSettings.cartReplaceItemActionNo') }}@endif" placeholder="Cart Replace Item Action No">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Action Yes</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemActionYes" value="@if (!empty($data->cartReplaceItemActionYes)) {{ $data->cartReplaceItemActionYes }}@else  {{ config('appSettings.cartReplaceItemActionYes') }}@endif" placeholder="Cart Replace Item Action Yes">
                    </div>
                </div>
                <!-- END Cart Screen Settings -->
                <!-- Checkout Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Checkout Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPageTitle"
                            value="{{ $data->checkoutPageTitle }}" placeholder="Checkout Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Payment List Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaymentListTitle"
                            value="{{ $data->checkoutPaymentListTitle }}" placeholder="Checkout Payment List Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Payment In Process Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaymentInProcess"
                            value="{{ $data->checkoutPaymentInProcess }}" placeholder="Checkout Payment In Process Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Stripe Text Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeText"
                            value="{{ $data->checkoutStripeText }}" placeholder="Stripe Text Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Stripe Sub Text Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeSubText"
                            value="{{ $data->checkoutStripeSubText }}" placeholder="Stripe Sub Text Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash On Delivery Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCodText"
                            value="{{ $data->checkoutCodText }}" placeholder="Cash On Delivery Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash On Delivery Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCodSubText"
                            value="{{ $data->checkoutCodSubText }}" placeholder="Cash On Delivery Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>PayStack Payment Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="paystackPayText"
                            value="{{ $data->paystackPayText }}" placeholder="PayStack Payment Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Paytm Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaytmText" value="@if(!empty($data->checkoutPaytmText)){{ $data->checkoutPaytmText }}@else{{ config('appSettings.checkoutPaytmText') }}@endif" placeholder="Paytm Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Paytm Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaytmSubText" value="@if(!empty($data->checkoutPaytmSubText)){{ $data->checkoutPaytmSubText }}@else{{ config('appSettings.checkoutPaytmSubText') }}@endif" placeholder="Paytm Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Razorpay Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutRazorpayText"
                            value="{{ $data->checkoutRazorpayText }}" placeholder="Razorpay Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Razorpay Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutRazorpaySubText"
                            value="{{ $data->checkoutRazorpaySubText }}" placeholder="Razorpay Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>User Banned Message</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="userInActiveMessage" placeholder="User Banned Message" rows="6">@if(!empty($data->userInActiveMessage)){{ $data->userInActiveMessage }}@else{{ config('appSettings.userInActiveMessage') }}@endif</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Too many requests message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tooManyApiCallMessage" value="@if(!empty($data->tooManyApiCallMessage)){{ $data->tooManyApiCallMessage }}@else{{ config('appSettings.tooManyApiCallMessage') }}@endif" placeholder="Too many requests message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ideal Stripe Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeIdealText" value="@if(!empty($data->checkoutStripeIdealText)){{ $data->checkoutStripeIdealText }}@else{{ config('appSettings.checkoutStripeIdealText') }}@endif" placeholder="Ideal Stripe Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ideal Stripe Checkout Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeIdealSubText" value="@if(!empty($data->checkoutStripeIdealSubText)){{ $data->checkoutStripeIdealSubText }}@else{{ config('appSettings.checkoutStripeIdealSubText') }}@endif" placeholder="Ideal Stripe Checkout Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>FPX Stripe Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeFpxText" value="@if(!empty($data->checkoutStripeFpxText)){{ $data->checkoutStripeFpxText }}@else{{ config('appSettings.checkoutStripeFpxText') }}@endif" placeholder="FPX Stripe Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>FPX Stripe Checkout SubText</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeFpxSubText" value="@if(!empty($data->checkoutStripeFpxSubText)){{ $data->checkoutStripeFpxSubText }}@else{{ config('appSettings.checkoutStripeFpxSubText') }}@endif" placeholder="FPX Stripe Checkout SubText">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>MercadoPago Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutMercadoPagoText" value="@if(!empty($data->checkoutMercadoPagoText)){{ $data->checkoutMercadoPagoText }}@else{{ config('appSettings.checkoutMercadoPagoText') }}@endif" placeholder="MercadoPago Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>MercadoPago Checkout Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutMercadoPagoSubText" value="@if(!empty($data->checkoutMercadoPagoSubText)){{ $data->checkoutMercadoPagoSubText }}@else{{ config('appSettings.checkoutMercadoPagoSubText') }}@endif" placeholder="MercadoPago Checkout Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>PayMongo Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPayMongoText" value="@if(!empty($data->checkoutPayMongoText)){{ $data->checkoutPayMongoText }}@else{{ config('appSettings.checkoutPayMongoText') }}@endif" placeholder="PayMongo Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>PayMongo Checkout Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPayMongoSubText" value="@if(!empty($data->checkoutPayMongoSubText)){{ $data->checkoutPayMongoSubText }}@else{{ config('appSettings.checkoutPayMongoSubText') }}@endif" placeholder="PayMongo Checkout Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Pay Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPayText" value="@if(!empty($data->checkoutPayText)){{ $data->checkoutPayText }}@else{{ config('appSettings.checkoutPayText') }}@endif" placeholder="Checkout Pay Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Card Number Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardNumber"
                            value="@if(!empty($data->checkoutCardNumber)){{ $data->checkoutCardNumber }}@else{{ config('appSettings.checkoutCardNumber') }}@endif" placeholder="Checkout Card Number Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Expiration Date Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardExpiration"
                            value="@if(!empty($data->checkoutCardExpiration)){{ $data->checkoutCardExpiration }}@else{{ config('appSettings.checkoutCardExpiration') }}@endif" placeholder="Checkout Expiration Date Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout CVV Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardCvv"
                            value="@if(!empty($data->checkoutCardCvv)){{ $data->checkoutCardCvv }}@else{{ config('appSettings.checkoutCardCvv') }}@endif" placeholder="Checkout CVV Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Postal Code Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardPostalCode"
                            value="@if(!empty($data->checkoutCardPostalCode)){{ $data->checkoutCardPostalCode }}@else{{ config('appSettings.checkoutCardPostalCode') }}@endif" placeholder="Checkout Postal Code Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Full Name Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardFullname"
                            value="@if(!empty($data->checkoutCardFullname)){{ $data->checkoutCardFullname }}@else{{ config('appSettings.checkoutCardFullname') }}@endif" placeholder="Checkout Full Name Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Ideal Select Bank Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutIdealSelectBankText"
                            value="@if(!empty($data->checkoutIdealSelectBankText)){{ $data->checkoutIdealSelectBankText }}@else{{ config('appSettings.checkoutIdealSelectBankText') }}@endif" placeholder="Checkout Ideal Select Bank Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout FPX Select Bank Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutFpxSelectBankText"
                            value="@if(!empty($data->checkoutFpxSelectBankText)){{ $data->checkoutFpxSelectBankText }}@else{{ config('appSettings.checkoutFpxSelectBankText') }}@endif" placeholder="Checkout FPX Select Bank Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Flutterwave Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutFlutterwaveText" value="@if(!empty($data->checkoutFlutterwaveText)){{ $data->checkoutFlutterwaveText }}@else{{ config('appSettings.checkoutFlutterwaveText') }}@endif" placeholder="Flutterwave Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Flutterwave Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutFlutterwaveSubText" value="@if(!empty($data->checkoutFlutterwaveSubText)){{ $data->checkoutFlutterwaveSubText }}@else{{ config('appSettings.checkoutFlutterwaveSubText') }}@endif" placeholder="Flutterwave Sub Text">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Khalti Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutKhaltiText" value="@if(!empty($data->checkoutKhaltiText)){{ $data->checkoutKhaltiText }}@else{{ config('appSettings.checkoutKhaltiText') }}@endif" placeholder="Khalti Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Khalti Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutKhaltiSubText" value="@if(!empty($data->checkoutKhaltiSubText)){{ $data->checkoutKhaltiSubText }}@else{{ config('appSettings.checkoutKhaltiSubText') }}@endif" placeholder="Khalti Sub Text">
                    </div>
                </div>

                <!-- Cash Change Block -->
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Change Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeTitle" value="@if(!empty($data->cashChangeTitle)){{ $data->cashChangeTitle }}@else{{ config('appSettings.cashChangeTitle') }}@endif" placeholder="Cash Change Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Amount Input Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeInputPlaceholder" value="@if(!empty($data->cashChangeInputPlaceholder)){{ $data->cashChangeInputPlaceholder }}@else{{ config('appSettings.cashChangeInputPlaceholder') }}@endif" placeholder="Cash Amount Input Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Amount Confirm Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeConfirmButton" value="@if(!empty($data->cashChangeConfirmButton)){{ $data->cashChangeConfirmButton }}@else{{ config('appSettings.cashChangeConfirmButton') }}@endif" placeholder="Cash Amount Confirm Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Amount Footer Help Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeHelpText" value="@if(!empty($data->cashChangeHelpText)){{ $data->cashChangeHelpText }}@else{{ config('appSettings.cashChangeHelpText') }}@endif" placeholder="Cash Amount Footer Help Text">
                    </div>
                </div>
                <!-- End Cash Change Block -->

                <!-- END Checkout Screen Settings -->


                <!-- Running Order Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Running Order Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Placed Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderPlacedTitle"
                            value="{{ $data->runningOrderPlacedTitle }}" placeholder="Order Placed Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Placed Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderPlacedSub"
                            value="{{ $data->runningOrderPlacedSub }}" placeholder="Order Placed Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Preparing Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderPreparingTitle"
                            value="{{ $data->runningOrderPreparingTitle }}" placeholder="Order Preparing Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Preparing Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderPreparingSub"
                            value="{{ $data->runningOrderPreparingSub }}" placeholder="Order Preparing Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>On Way Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderOnwayTitle"
                            value="{{ $data->runningOrderOnwayTitle }}" placeholder="On Way Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>On Way Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderOnwaySub"
                            value="{{ $data->runningOrderOnwaySub }}" placeholder="On Way Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Assigned Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveryAssignedTitle"
                            value="{{ $data->runningOrderDeliveryAssignedTitle }}" placeholder="Delivery Assigned Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Assigned Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveryAssignedSub"
                            value="{{ $data->runningOrderDeliveryAssignedSub }}" placeholder="Delivery Assigned Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Canceled Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderCanceledTitle"
                            value="{{ $data->runningOrderCanceledTitle }}" placeholder="Order Canceled Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Canceled Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderCanceledSub"
                            value="{{ $data->runningOrderCanceledSub }}" placeholder="Order Canceled Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Ready for Pickup Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderReadyForPickup"
                            value="{{ $data->runningOrderReadyForPickup }}" placeholder="Order Ready for Pickup Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Ready for Pickup Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderReadyForPickupSub"
                            value="{{ $data->runningOrderReadyForPickupSub }}" placeholder="Order Ready for Pickup Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Awaiting Payment Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="awaitingPaymentStatusText" value="@if(!empty($data->awaitingPaymentStatusText)){{ $data->awaitingPaymentStatusText }}@else{{ config('appSettings.awaitingPaymentStatusText') }}@endif" placeholder="Awaiting Payment Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Payment Failed Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="paymentFailedStatusText" value="@if(!empty($data->paymentFailedStatusText)){{ $data->paymentFailedStatusText }}@else{{ config('appSettings.paymentFailedStatusText') }}@endif" placeholder="Payment Failed Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Delivered Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDelivered"
                            value="@if(!empty($data->runningOrderDelivered)){{ $data->runningOrderDelivered }}@else{{ config('appSettings.runningOrderDelivered') }}@endif" placeholder="Order Delivered Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Delivered Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveredSub"
                            value="@if(!empty($data->runningOrderDeliveredSub)){{ $data->runningOrderDeliveredSub }}@else{{ config('appSettings.runningOrderDeliveredSub') }}@endif" placeholder="Order Delivered Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Refresh Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderRefreshButton"
                            value="{{ $data->runningOrderRefreshButton }}" placeholder="Refresh Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Text after Name</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyAfterName"
                            value="{{ $data->deliveryGuyAfterName }}" placeholder="Delivery Guy Text after Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Vehicle Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="vehicleText"
                            value="{{ $data->vehicleText }}" placeholder="Vehicle Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Call Now Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="callNowButton"
                            value="{{ $data->callNowButton }}" placeholder="Call Now Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Allow Location Access Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="allowLocationAccessMessage"
                            value="{{ $data->allowLocationAccessMessage }}" placeholder="Allow Location Access Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Track Order Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="trackOrderText"
                            value="{{ $data->trackOrderText }}" placeholder="Track Order Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Placed Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPlacedStatusText"
                            value="{{ $data->orderPlacedStatusText }}" placeholder="Order Placed Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Preparing Order Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="preparingOrderStatusText"
                            value="{{ $data->preparingOrderStatusText }}" placeholder="Preparing Order Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Assigned Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyAssignedStatusText"
                            value="{{ $data->deliveryGuyAssignedStatusText }}" placeholder="Delivery Guy Assigned Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Picked Up Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPickedUpStatusText"
                            value="{{ $data->orderPickedUpStatusText }}" placeholder="Order Picked Up Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivered Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveredStatusText"
                            value="{{ $data->deliveredStatusText }}" placeholder="Delivered Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Canceled Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="canceledStatusText"
                            value="{{ $data->canceledStatusText }}" placeholder="Canceled Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ready For Pickup Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="readyForPickupStatusText"
                            value="{{ $data->readyForPickupStatusText }}" placeholder="Ready for Pickup Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy New Order Notification Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyNewOrderNotificationMsg"
                            value="{{ $data->deliveryGuyNewOrderNotificationMsg }}" placeholder="Delivery Guy New Order Notification Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy New Order Notification Message Sub</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyNewOrderNotificationMsgSub"
                            value="{{ $data->deliveryGuyNewOrderNotificationMsgSub }}" placeholder="Delivery Guy New Order Notification Message Sub">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Pin Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveryPin"
                            value="{{ $data->runningOrderDeliveryPin }}" placeholder="Delivery Pin Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Awaiting Payment Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="awaitingPaymentTitle" value="@if (!empty($data->awaitingPaymentTitle)) {{ $data->awaitingPaymentTitle }}@else{{ config('appSettings.awaitingPaymentTitle') }}@endif" placeholder="waiting Payment Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Awaiting Payment Sub Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="awaitingPaymentSubTitle" value="@if (!empty($data->awaitingPaymentSubTitle)) {{ $data->awaitingPaymentSubTitle }}@else{{ config('appSettings.awaitingPaymentSubTitle') }}@endif" placeholder="Awaiting Payment Sub Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Payment Mode Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderDetailsPaymentMode"
                            value="@if (!empty($data->orderDetailsPaymentMode)) {{ $data->orderDetailsPaymentMode }}@else{{ config('appSettings.orderDetailsPaymentMode') }}@endif" placeholder="Order Payment Mode Text">
                    </div>
                </div>
                <!-- END Running Order Screen Settings -->
                <!-- Account Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Account Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Account Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyAccount"
                            value="{{ $data->accountMyAccount }}" placeholder="My Account Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Manage Address Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountManageAddress"
                            value="{{ $data->accountManageAddress }}" placeholder="Manage Address Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Does Not Deliver To Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="addressDoesnotDeliverToText"
                            value="{{ $data->addressDoesnotDeliverToText }}" placeholder="Does Not Deliver To Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Orders Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyOrders"
                            value="{{ $data->accountMyOrders }}" placeholder="My Orders Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Helo & FAQ Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountHelpFaq"
                            value="{{ $data->accountHelpFaq }}" placeholder="Helo & FAQ Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Logout Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountLogout"
                            value="{{ $data->accountLogout }}" placeholder="Logout Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyWallet"
                            value="{{ $data->accountMyWallet }}" placeholder="My Wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Orders Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noOrdersText"
                            value="{{ $data->noOrdersText }}" placeholder="No Orders Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Canceled Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderCancelledText"
                            value="{{ $data->orderCancelledText }}" placeholder="Order Canceled Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Choose Avatar Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="chooseAvatarText"
                            value="@if (!empty($data->chooseAvatarText)) {{ $data->chooseAvatarText }}@else{{ config('appSettings.chooseAvatarText') }}@endif" placeholder="Choose Avatar Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Favourite Stores</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyFavouriteStores"
                            value="@if (!empty($data->accountMyFavouriteStores)) {{ $data->accountMyFavouriteStores }}@else{{ config('appSettings.accountMyFavouriteStores') }}@endif" placeholder="My Favourite Stores">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Favourite Stores Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="favouriteStoresPageTitle"
                            value="@if (!empty($data->favouriteStoresPageTitle)) {{ $data->favouriteStoresPageTitle }}@else{{ config('appSettings.favouriteStoresPageTitle') }}@endif" placeholder="Favourite Stores Page Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tax/Vat Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountTaxVatText"
                            value="@if (!empty($data->accountTaxVatText)) {{ $data->accountTaxVatText }}@else{{ config('appSettings.accountTaxVatText') }}@endif" placeholder="Tax/Vat Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tax/Vat Save Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customerVatSave"
                            value="@if (!empty($data->customerVatSave)) {{ $data->customerVatSave }}@else{{ config('appSettings.customerVatSave') }}@endif" placeholder="Tax/Vat Save Button Text">
                    </div>
                </div>
                <!-- END Account Screen Settings -->
                <!-- Search Location Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Search Location Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Search Location Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="searchAreaPlaceholder"
                            value="{{ $data->searchAreaPlaceholder }}" placeholder="Search Location Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Search Popular Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="searchPopularPlaces"
                            value="{{ $data->searchPopularPlaces }}" placeholder="Search Popular Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Use Current Location Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="useCurrentLocationText"
                            value="{{ $data->useCurrentLocationText }}" placeholder="Use Current Location Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>GPS Access not Granted Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="gpsAccessNotGrantedMsg"
                            value="{{ $data->gpsAccessNotGrantedMsg }}" placeholder="GPS Access not Granted Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Your Location Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="yourLocationText"
                            value="{{ $data->yourLocationText }}" placeholder="Your Location Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Address Field Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="editAddressAddress"
                            value="{{ $data->editAddressAddress }}" placeholder="Address Field Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Edit Address Tag</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="editAddressTag"
                            value="{{ $data->editAddressTag }}" placeholder="Edit Address Tag">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Address Tag Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="addressTagPlaceholder"
                            value="{{ $data->addressTagPlaceholder }}" placeholder="Address Tag Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Save Address Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="buttonSaveAddress"
                            value="{{ $data->buttonSaveAddress }}" placeholder="Save Address Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Saved Addresses (Location page)</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="locationSavedAddresses" value="@if (!empty($data->locationSavedAddresses)) {{ $data->locationSavedAddresses }}@else{{ config('appSettings.locationSavedAddresses') }}@endif" placeholder="Saved Addresses">
                    </div>
                </div>
                <!-- END Search Location Screen Settings -->
                <!--  Address Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Address Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delete Address Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deleteAddressText"
                            value="{{ $data->deleteAddressText }}" placeholder="Delete Address Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Address Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noAddressText" 
                            value="@if (!empty($data->noAddressText)) {{ $data->noAddressText }}@else{{ config('appSettings.noAddressText') }}@endif" placeholder="No Address Text">
                    </div>
                </div>
                <!-- END Address Screen Settings -->
                <hr>
                <!--  Wallet Translations -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Wallet Translations </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Wallet Transactions Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noWalletTransactionsText"
                            value="{{ $data->noWalletTransactionsText }}" placeholder="No Wallet Transactions Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Deposit Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="walletDepositText"
                            value="{{ $data->walletDepositText }}" placeholder="Wallet Deposit Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Withdraw Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="walletWithdrawText"
                            value="{{ $data->walletWithdrawText }}" placeholder="Wallet Withdraw Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pay Partial with Wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="payPartialWithWalletText"
                            value="{{ $data->payPartialWithWalletText }}" placeholder="Pay Partial with Wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet money Will be Deducted Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="willbeDeductedText"
                            value="{{ $data->willbeDeductedText }}" placeholder="Wallet money Will be Deducted Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pay Full With Wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="payFullWithWalletText"
                            value="{{ $data->payFullWithWalletText }}" placeholder="Pay Full With Wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Payment for Order Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPaymentWalletComment"
                            value="{{ $data->orderPaymentWalletComment }}" placeholder="Wallet Comment - Payment for Order Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Partial Payment for Order Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPartialPaymentWalletComment"
                            value="{{ $data->orderPartialPaymentWalletComment }}" placeholder="Wallet Comment - Partial Payment for Order Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Order Refund Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderRefundWalletComment"
                            value="{{ $data->orderRefundWalletComment }}" placeholder="Wallet Comment - Order Refund Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Order Partial Refund Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPartialRefundWalletComment"
                            value="{{ $data->orderPartialRefundWalletComment }}" placeholder="Wallet Comment - Order Partial Refund Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Redeem Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="walletRedeemBtnText"
                            value="{{ $data->walletRedeemBtnText }}" placeholder="Wallet Redeem Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Cancel Order Main Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cancelOrderMainButton"
                            value="{{ $data->cancelOrderMainButton }}" placeholder="Order Cancel - Cancel Order Main Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Will Be Refunded Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="willBeRefundedText"
                            value="{{ $data->willBeRefundedText }}" placeholder="Order Cancel - Will Be Refunded Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Will Not Be Refunded Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="willNotBeRefundedText"
                            value="{{ $data->willNotBeRefundedText }}" placeholder="Order Cancel - Will Not Be Refunded Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Do you want to cancel text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderCancellationConfirmationText"
                            value="{{ $data->orderCancellationConfirmationText }}" placeholder="Order Cancel - Do you want to cancel text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Yes Cancel Order Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="yesCancelOrderBtn"
                            value="{{ $data->yesCancelOrderBtn }}" placeholder="Order Cancel - Yes Cancel Order Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Go Back Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cancelGoBackBtn"
                            value="{{ $data->cancelGoBackBtn }}" placeholder="Order Cancel - Go Back Button">
                    </div>
                </div>
                <!--  END Wallet Translations -->
                <hr>
                <!--  Delivery Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Delivery Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Welcome Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryWelcomeMessage"
                            value="{{ $data->deliveryWelcomeMessage }}" placeholder="Delivery Welcome Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Accepted Orders Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryAcceptedOrdersTitle"
                            value="{{ $data->deliveryAcceptedOrdersTitle }}" placeholder="Accepted Orders Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Accepted Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNoOrdersAccepted"
                            value="{{ $data->deliveryNoOrdersAccepted }}" placeholder="No Accepted Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Orders Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNewOrdersTitle"
                            value="{{ $data->deliveryNewOrdersTitle }}" placeholder="New Orders Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No New Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNoNewOrders"
                            value="{{ $data->deliveryNoNewOrders }}" placeholder="No New Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pickedup Orders Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryPickedupOrdersTitle"
                            value="@if (!empty($data->deliveryPickedupOrdersTitle)) {{ $data->deliveryPickedupOrdersTitle }}@else{{ config('appSettings.deliveryPickedupOrdersTitle') }}@endif" placeholder="Pickedup Orders Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Pickedup Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNoPickedupOrdersMsg"
                            value="@if (!empty($data->deliveryNoPickedupOrdersMsg)) {{ $data->deliveryNoPickedupOrdersMsg }}@else{{ config('appSettings.deliveryNoPickedupOrdersMsg') }}@endif" placeholder="No Pickedup Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Items</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrderItems"
                            value="{{ $data->deliveryOrderItems }}" placeholder="Order Items">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Address</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryRestaurantAddress"
                            value="{{ $data->deliveryRestaurantAddress }}" placeholder="Store Address">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Address</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryDeliveryAddress"
                            value="{{ $data->deliveryDeliveryAddress }}" placeholder="Delivery Address">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Get Direction Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGetDirectionButton"
                            value="{{ $data->deliveryGetDirectionButton }}" placeholder="Get Direction Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Online Payment</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOnlinePayment"
                            value="{{ $data->deliveryOnlinePayment }}" placeholder="Online Payment">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Cash on Delivery Payment</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCashOnDelivery"
                            value="{{ $data->deliveryCashOnDelivery }}" placeholder="Delivery Cash on Delivery Payment">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Pin Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryDeliveryPinPlaceholder"
                            value="{{ $data->deliveryDeliveryPinPlaceholder }}" placeholder="Delivery Pin Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Accept to Deliver Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryAcceptOrderButton"
                            value="{{ $data->deliveryAcceptOrderButton }}" placeholder="Accept to Deliver Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Picked Up Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryPickedUpButton"
                            value="{{ $data->deliveryPickedUpButton }}" placeholder="Picked Up Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivered Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryDeliveredButton"
                            value="{{ $data->deliveryDeliveredButton }}" placeholder="Delivered Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Completed Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrderCompletedButton"
                            value="{{ $data->deliveryOrderCompletedButton }}" placeholder="Order Completed Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Already Accepted Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryAlreadyAccepted"
                            value="{{ $data->deliveryAlreadyAccepted }}" placeholder="Delivery Already Accepted Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid Delivery Pin Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryInvalidDeliveryPin"
                            value="{{ $data->deliveryInvalidDeliveryPin }}" placeholder="Invalid Delivery Pin Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Logout Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryLogoutDelivery"
                            value="{{ $data->deliveryLogoutDelivery }}" placeholder="Delivery Logout Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Logout Confirmation</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryLogoutConfirmation"
                            value="{{ $data->deliveryLogoutConfirmation }}" placeholder="Delivery Logout Confirmation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Orders Refresh Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrdersRefreshBtn"
                            value="{{ $data->deliveryOrdersRefreshBtn }}" placeholder="Delivery Orders Refresh Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Placed Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrderPlacedText"
                            value="{{ $data->deliveryOrderPlacedText }}" placeholder="Order Placed Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer New Orders</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterNewTitle"
                            value="@if (!empty($data->deliveryFooterNewTitle)) {{ $data->deliveryFooterNewTitle }}@else{{ config('appSettings.deliveryFooterNewTitle') }}@endif" placeholder="Delivery Footer New Orders">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer Accepted</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterAcceptedTitle"
                            value="@if (!empty($data->deliveryFooterAcceptedTitle)) {{ $data->deliveryFooterAcceptedTitle }}@else{{ config('appSettings.deliveryFooterAcceptedTitle') }}@endif" placeholder="Delivery Footer Accepted">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer Pickedup</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterPickedup"
                            value="@if (!empty($data->deliveryFooterPickedup)) {{ $data->deliveryFooterPickedup }}@else{{ config('appSettings.deliveryFooterPickedup') }}@endif" placeholder="Delivery Footer Pickedup">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer My Account</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterAccount"
                            value="@if (!empty($data->deliveryFooterAccount)) {{ $data->deliveryFooterAccount }}@else{{ config('appSettings.deliveryFooterAccount') }}@endif" placeholder="Delivery Footer My Account">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account Earnings Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningsText"
                            value="@if (!empty($data->deliveryEarningsText)) {{ $data->deliveryEarningsText }}@else{{ config('appSettings.deliveryEarningsText') }}@endif" placeholder="Delivery Account Earnings Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account COD Collection Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCollectionText"
                            value="@if (!empty($data->deliveryCollectionText)) {{ $data->deliveryCollectionText }}@else{{ config('appSettings.deliveryCollectionText') }}@endif" placeholder="Delivery Account COD Collection Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account On-Going Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOnGoingText"
                            value="@if (!empty($data->deliveryOnGoingText)) {{ $data->deliveryOnGoingText }}@else{{ config('appSettings.deliveryOnGoingText') }}@endif" placeholder="Delivery Account On-Going Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account Completed Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCompletedText"
                            value="@if (!empty($data->deliveryCompletedText)) {{ $data->deliveryCompletedText }}@else{{ config('appSettings.deliveryCompletedText') }}@endif" placeholder="Delivery Account Completed Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Commission Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCommissionMessage"
                            value="@if (!empty($data->deliveryCommissionMessage)) {{ $data->deliveryCommissionMessage }}@else{{ config('appSettings.deliveryCommissionMessage') }}@endif" placeholder="Delivery Commission Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Updating System Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="updatingMessage"
                            value="@if (!empty($data->updatingMessage)) {{ $data->updatingMessage }}@else{{ config('appSettings.updatingMessage') }}@endif"
                            placeholder="Updating System Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Categories Page Filters Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="categoriesFiltersText" value="@if (!empty($data->categoriesFiltersText)) {{ $data->categoriesFiltersText }}@else{{ config('appSettings.categoriesFiltersText') }}@endif" placeholder="Categories Page Filters Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Categories Page No Store Found Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="categoriesNoRestaurantsFoundText" value="@if (!empty($data->categoriesNoRestaurantsFoundText)) {{ $data->categoriesNoRestaurantsFoundText }}@else{{ config('appSettings.categoriesNoRestaurantsFoundText') }}@endif" placeholder="Categories Page No Store Found Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Total Earnings Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTotalEarningsText"
                            value="@if (!empty($data->deliveryTotalEarningsText)) {{ $data->deliveryTotalEarningsText }}@else{{ config('appSettings.deliveryTotalEarningsText') }}@endif" placeholder="Delivery Guy Total Earnings Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Use Phone To Access Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryUsePhoneToAccessMsg"
                            value="@if (!empty($data->deliveryUsePhoneToAccessMsg)) {{ $data->deliveryUsePhoneToAccessMsg }}@else{{ config('appSettings.deliveryUsePhoneToAccessMsg') }}@endif" placeholder="Delivery Use Phone To Access Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Max Order Reached</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryMaxOrderReachedMsg"
                            value="@if (!empty($data->deliveryMaxOrderReachedMsg)) {{ $data->deliveryMaxOrderReachedMsg }}@else{{ config('appSettings.deliveryMaxOrderReachedMsg') }}@endif" placeholder="Delivery Max Order Reached">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Earnings Commission Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningCommissionText" value="@if (!empty($data->deliveryEarningCommissionText)) {{ $data->deliveryEarningCommissionText }}@else{{ config('appSettings.deliveryEarningCommissionText') }}@endif" placeholder="Delivery Guy Earnings Commission Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Earnings Tip Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningTipText" value="@if (!empty($data->deliveryEarningTipText)) {{ $data->deliveryEarningTipText }}@else{{ config('appSettings.deliveryEarningTipText') }}@endif" placeholder="Delivery Guy Earnings Tip Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Earnings Total Earning Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningTotalEarningText" value="@if (!empty($data->deliveryEarningTotalEarningText)) {{ $data->deliveryEarningTotalEarningText }}@else{{ config('appSettings.deliveryEarningTotalEarningText') }}@endif" placeholder="Delivery Guy Earnings Total Earning Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Last 7 Days Earning Chart Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryLastSevenDaysEarningTitle"
                            value="@if (!empty($data->deliveryLastSevenDaysEarningTitle)) {{ $data->deliveryLastSevenDaysEarningTitle }}@else{{ config('appSettings.deliveryLastSevenDaysEarningTitle') }}@endif" placeholder="Delivery Guy Last 7 Days Earning Chart Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Toggle Light/Dark Mode Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryToggleLightDarkMode" value="@if (!empty($data->deliveryToggleLightDarkMode)) {{ $data->deliveryToggleLightDarkMode }}@else{{ config('appSettings.deliveryToggleLightDarkMode') }}@endif" placeholder="Delivery Toggle Light/Dark Mode Button Text">
                    </div>
                </div>
                <!--  END Delivery Screen Settings -->
                <!-- InAppNotification Screen Setting -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>In App Notification Popup </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Notification Close Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="inAppCloseButton"
                            value="@if (!empty($data->inAppCloseButton)) {{ $data->inAppCloseButton }}@else{{ config('appSettings.inAppCloseButton') }}@endif" placeholder="Notification Close Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Notification Open Link Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="inAppOpenLinkButton"
                            value="@if (!empty($data->inAppOpenLinkButton)) {{ $data->inAppOpenLinkButton }}@else{{ config('appSettings.inAppOpenLinkButton') }}@endif" placeholder="Notification Open Link Button Text">
                    </div>
                </div>
                <!-- END InAppNotification Screen Setting -->
                <!-- iOSPWAPrompt Screen Setting -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>iOS PWA Custom Popup</button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupTitle" value="@if (!empty($data->iOSPWAPopupTitle)) {{ $data->iOSPWAPopupTitle }}@else{{ config('appSettings.iOSPWAPopupTitle') }}@endif" placeholder="Popup Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupBody" value="@if (!empty($data->iOSPWAPopupBody)) {{ $data->iOSPWAPopupBody }}@else{{ config('appSettings.iOSPWAPopupBody') }}@endif" placeholder="Popup Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Share Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupShareButtonLabel" value="@if (!empty($data->iOSPWAPopupShareButtonLabel)) {{ $data->iOSPWAPopupShareButtonLabel }}@else{{ config('appSettings.iOSPWAPopupShareButtonLabel') }}@endif" placeholder="Popup Share Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Add To HomeScreen Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupAddButtonLabel" value="@if (!empty($data->iOSPWAPopupAddButtonLabel)) {{ $data->iOSPWAPopupAddButtonLabel }}@else{{ config('appSettings.iOSPWAPopupAddButtonLabel') }}@endif" placeholder="Popup Add To HomeScreen Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Cancel Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupCloseButtonLabel" value="@if (!empty($data->iOSPWAPopupCloseButtonLabel)) {{ $data->iOSPWAPopupCloseButtonLabel }}@else{{ config('appSettings.iOSPWAPopupCloseButtonLabel') }}@endif" placeholder="Popup Cancel Button Text">
                    </div>
                </div>
                <!-- END iOSPWAPrompt Screen Setting -->
                <!-- OfflineMode Screen Setting -->
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Offline Title Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="offlineTitleMessage" value="@if (!empty($data->offlineTitleMessage)) {{ $data->offlineTitleMessage }}@else{{ config('appSettings.offlineTitleMessage') }}@endif" placeholder="Offline Title Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Offline Sub-Title Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="offlineSubTitleMessage" value="@if (!empty($data->offlineSubTitleMessage)) {{ $data->offlineSubTitleMessage }}@else{{ config('appSettings.offlineSubTitleMessage') }}@endif" placeholder="Offline Sub-Title Message">
                    </div>
                </div>
                <!-- END OfflineMode Screen Setting -->
                <!-- Rating and Reviews Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Ratings and Review</button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Order Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderRateOrderButton" value="@if (!empty($data->orderRateOrderButton)) {{ $data->orderRateOrderButton }}@else{{ config('appSettings.orderRateOrderButton') }}@endif" placeholder="Rate Order Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ratings Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="reviewsPageTitle" value="@if (!empty($data->reviewsPageTitle)) {{ $data->reviewsPageTitle }}@else{{ config('appSettings.reviewsPageTitle') }}@endif" placeholder="Ratings Page Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate your order Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarModRatingPageTitle" value="@if (!empty($data->rarModRatingPageTitle)) {{ $data->rarModRatingPageTitle }}@else{{ config('appSettings.rarModRatingPageTitle') }}@endif" placeholder="Rate your order Page Title">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Delivery Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarModDeliveryRatingTitle" value="@if (!empty($data->rarModDeliveryRatingTitle)) {{ $data->rarModDeliveryRatingTitle }}@else{{ config('appSettings.rarModDeliveryRatingTitle') }}@endif" placeholder="Rate Delivery Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Delivery Feedback Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarReviewBoxTitleDeliveryFeedback" value="@if (!empty($data->rarReviewBoxTitleDeliveryFeedback)) {{ $data->rarReviewBoxTitleDeliveryFeedback }}@else{{ config('appSettings.rarReviewBoxTitleDeliveryFeedback') }}@endif" placeholder="Rate Delivery Feedback Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Store Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarModRestaurantRatingTitle" value="@if (!empty($data->rarModRestaurantRatingTitle)) {{ $data->rarModRestaurantRatingTitle }}@else{{ config('appSettings.rarModRestaurantRatingTitle') }}@endif" placeholder="Rate Store Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Store Feedback Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarReviewBoxTitleStoreFeedback" value="@if (!empty($data->rarReviewBoxTitleStoreFeedback)) {{ $data->rarReviewBoxTitleStoreFeedback }}@else{{ config('appSettings.rarReviewBoxTitleStoreFeedback') }}@endif" placeholder="Rate Store Feedback Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Feeback textbox placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarReviewBoxTextPlaceHolderText" value="@if (!empty($data->rarReviewBoxTextPlaceHolderText)) {{ $data->rarReviewBoxTextPlaceHolderText }}@else{{ config('appSettings.rarReviewBoxTextPlaceHolderText') }}@endif" placeholder="Feeback textbox placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rating reqired error message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="ratingsRequiredMessage" value="@if (!empty($data->ratingsRequiredMessage)) {{ $data->ratingsRequiredMessage }}@else{{ config('appSettings.ratingsRequiredMessage') }}@endif" placeholder="Rating reqired error message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Review Submit Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarSubmitButtonText" value="@if (!empty($data->rarSubmitButtonText)) {{ $data->rarSubmitButtonText }}@else{{ config('appSettings.rarSubmitButtonText') }}@endif" placeholder="Review Submit Button Text">
                    </div>
                </div>
                <!-- END Rating and Reviews Screen Settings -->
                <!-- END MOBILE -->
                @csrf
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                    Save Translation
                    <i class="icon-database-insert ml-1"></i>
                    </button>
                </div>
                <div class="text-left">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteTranslationConfirmModal">
                    Delete Translation
                    <i class="icon-cancel-circle2 ml-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="deleteTranslationConfirmModal" class="modal fade mt-5" tabindex="-1">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="font-weight-bold">Are you sure?</span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <span class="help-text">Attention!!! This change is permanent. <br> You can use the "<strong>DISABLE</strong>" feature to temporarily disable the translation.</span>
                <div class="modal-footer mt-4">
                    <a href="{{ route('admin.deleteTranslation', $translation_id) }}" class="btn btn-primary">Yes Delete</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.summernote-editor').summernote({
               height: 200,
               popover: {
                   image: [],
                   link: [],
                   air: []
                 }
        });
</script>
@endsection