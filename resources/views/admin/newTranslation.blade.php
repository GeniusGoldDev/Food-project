@extends('admin.layouts.master')
@section("title") New Translation - Dashboard
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">New Translation</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.saveNewTranslation') }}" method="POST" enctype="multipart/form-data">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                    Save Translation
                    <i class="icon-database-insert ml-1"></i>
                    </button>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-lg-3 col-form-label"><strong>Language Name</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="language_name" placeholder="Enter new language name" required="required">
                    </div>
                </div>
                <hr>
                <!-- DESKTOP -->
                <button class="btn btn-primary translation-section-btn" type="button"> <i class="icon-display4 mr-1"></i>Desktop Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Heading</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopHeading"
                            value="{{ config('appSettings.desktopHeading') }}" placeholder="Heading Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Sub Heading</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="desktopSubHeading" placeholder="Sub Heading Text" rows="6">{{ config('appSettings.desktopSubHeading') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Use App Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopUseAppButton"
                            value="{{ config('appSettings.desktopUseAppButton') }}" placeholder="Use App Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement One Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementOneTitle"
                            value="{{ config('appSettings.desktopAchievementOneTitle') }}" placeholder="Achievement One Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement One Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementOneSub"
                            value="{{ config('appSettings.desktopAchievementOneSub') }}" placeholder="Achievement One Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Two Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementTwoTitle"
                            value="{{ config('appSettings.desktopAchievementTwoTitle') }}" placeholder="Achievement Two Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Two Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementTwoSub"
                            value="{{ config('appSettings.desktopAchievementTwoSub') }}" placeholder="Achievement Two Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Three Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementThreeTitle"
                            value="{{ config('appSettings.desktopAchievementThreeTitle') }}" placeholder="Achievement Four Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Three Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementThreeSub"
                            value="{{ config('appSettings.desktopAchievementThreeSub') }}" placeholder="Achievement Three Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Four Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementFourTitle"
                            value="{{ config('appSettings.desktopAchievementFourTitle') }}" placeholder="Achievement Four Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Achievement Four Sub Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopAchievementFourSub"
                            value="{{ config('appSettings.desktopAchievementFourSub') }}" placeholder="Achievement Sub Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Address</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="desktopFooterAddress">{{ config('appSettings.desktopFooterAddress') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Social Heading Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopFooterSocialHeader"
                            value="{{ config('appSettings.desktopFooterSocialHeader') }}" placeholder="Social Heading Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Facebook Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialFacebookLink"
                            value="{{ config('appSettings.desktopSocialFacebookLink') }}" placeholder="Facebook Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Google Plus Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialGoogleLink"
                            value="{{ config('appSettings.desktopSocialGoogleLink') }}" placeholder="Google Plus Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Youtube Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialYoutubeLink"
                            value="{{ config('appSettings.desktopSocialYoutubeLink') }}" placeholder="Youtube Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Instagram Link</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopSocialInstagramLink"
                            value="{{ config('appSettings.desktopSocialInstagramLink') }}" placeholder="Instagram Link (Icon won't be shown if left empty)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>GDPR Message</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="gdprMessage">{{ config('appSettings.gdprMessage') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>GDPR Confirm Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="gdprConfirmButton"
                            value="{{ config('appSettings.gdprConfirmButton') }}" placeholder="GDPR Confirm Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Change Language Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="changeLanguageText"
                            value="{{ config('appSettings.changeLanguageText') }}" placeholder="Change Language Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Try It On Phone Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopTryItOnPhoneTitle"
                            value="{{ config('appSettings.desktopTryItOnPhoneTitle') }}" placeholder="Try It On Phone Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Try It On Phone SubTitle</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="desktopTryItOnPhoneSubTitle"
                            value="{{ config('appSettings.desktopTryItOnPhoneSubTitle') }}" placeholder="Try It On Phone SubTitle">
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
                            value="{{ config('appSettings.firstScreenHeading') }}" placeholder="First Screen Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Sub Heading</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenSubHeading"
                            value="{{ config('appSettings.firstScreenSubHeading') }}" placeholder="First Screen Sub Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Setup Locaion Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenSetupLocation"
                            value="{{ config('appSettings.firstScreenSetupLocation') }}" placeholder="Setup Location Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Welcome Message Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenWelcomeMessage"
                            value="{{ config('appSettings.firstScreenWelcomeMessage') }}" placeholder="Welcome Message Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenLoginText"
                            value="{{ config('appSettings.firstScreenLoginText') }}" placeholder="Login Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenLoginBtn"
                            value="{{ config('appSettings.firstScreenLoginBtn') }}" placeholder="Login Button Text">
                    </div>
                </div>
                <!-- END First Screen Settings -->
                <!-- Login Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Login/Register Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Error Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginErrorMessage"
                            value="{{ config('appSettings.loginErrorMessage') }}" placeholder="Login Error Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Please Wait Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pleaseWaitText"
                            value="{{ config('appSettings.pleaseWaitText') }}" placeholder="Please Wait Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginTitle"
                            value="{{ config('appSettings.loginLoginTitle') }}" placeholder="Login Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login SubTitle Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginSubTitle"
                            value="{{ config('appSettings.loginLoginSubTitle') }}" placeholder="Login SubTitle Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Email Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginEmailLabel"
                            value="{{ config('appSettings.loginLoginEmailLabel') }}" placeholder="Login Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Password Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginPasswordLabel"
                            value="{{ config('appSettings.loginLoginPasswordLabel') }}" placeholder="Login Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login Dont have Account</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginDontHaveAccount"
                            value="{{ config('appSettings.loginDontHaveAccount') }}" placeholder="Login Dont have Account">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="firstScreenRegisterBtn"
                            value="{{ config('appSettings.firstScreenRegisterBtn') }}" placeholder="Register Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="registerRegisterTitle"
                            value="{{ config('appSettings.registerRegisterTitle') }}" placeholder="Register Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register SubTitle Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="registerRegisterSubTitle"
                            value="{{ config('appSettings.registerRegisterSubTitle') }}" placeholder="Register SubTitle Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Name Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginNameLabel"
                            value="{{ config('appSettings.loginLoginNameLabel') }}" placeholder="Register Name Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Phone Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="loginLoginPhoneLabel"
                            value="{{ config('appSettings.loginLoginPhoneLabel') }}" placeholder="Register Phone Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Register Already Have Account</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="regsiterAlreadyHaveAccount"
                            value="{{ config('appSettings.regsiterAlreadyHaveAccount') }}" placeholder="Register Already Have Account">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Required Fields Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="fieldValidationMsg"
                            value="{{ config('appSettings.fieldValidationMsg') }}" placeholder="Field Required Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Name Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="nameValidationMsg"
                            value="{{ config('appSettings.nameValidationMsg') }}" placeholder="Name Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Email Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="emailValidationMsg"
                            value="{{ config('appSettings.emailValidationMsg') }}" placeholder="Email Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Phone Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="phoneValidationMsg"
                            value="{{ config('appSettings.phoneValidationMsg') }}" placeholder="Phone Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Phone & Password Min Length Validation Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="minimumLengthValidationMessage"
                            value="{{ config('appSettings.minimumLengthValidationMessage') }}" placeholder="Phone & Password Min Length Validation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Email/Phone Already Registered Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="emailPhoneAlreadyRegistered"
                            value="{{ config('appSettings.emailPhoneAlreadyRegistered') }}" placeholder="Email/Phone Already Registered Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Email and Password donot match</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="emailPassDonotMatch"
                            value="{{ config('appSettings.emailPassDonotMatch') }}" placeholder="Email and Password donot match">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter Phone Number to Verify Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="enterPhoneToVerify"
                            value="{{ config('appSettings.enterPhoneToVerify') }}" placeholder="Enter Phone Number Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid OTP Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="invalidOtpMsg"
                            value="{{ config('appSettings.invalidOtpMsg') }}" placeholder="Invalid OTP Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>OTP Sent Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="otpSentMsg"
                            value="{{ config('appSettings.otpSentMsg') }}" placeholder="OTP Sent Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Resend OTP Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resendOtpMsg"
                            value="{{ config('appSettings.resendOtpMsg') }}" placeholder="Resend OTP Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Resend OTP Countdown Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resendOtpCountdownMsg"
                            value="{{ config('appSettings.resendOtpCountdownMsg') }}" placeholder="Resend OTP Countdown Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Verify OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="verifyOtpBtnText"
                            value="{{ config('appSettings.verifyOtpBtnText') }}" placeholder="Verify OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Social Login 'Hi' Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="socialWelcomeText"
                            value="{{ config('appSettings.socialWelcomeText') }}" placeholder="Social Login 'Hi' Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Social Login OR Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="socialLoginOrText"
                            value="{{ config('appSettings.socialLoginOrText') }}" placeholder="Social Login OR Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Forgot Password Link Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="forgotPasswordLinkText" value="{{ config('appSettings.forgotPasswordLinkText') }}" placeholder="Forgot Password Link Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Reset Password Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resetPasswordPageTitle"
                            value="{{ config('appSettings.resetPasswordPageTitle') }}" placeholder="Reset Password Page Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Reset Password Page Sub Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="resetPasswordPageSubTitle"
                            value="{{ config('appSettings.resetPasswordPageSubTitle') }}" placeholder="Reset Password Page Sub Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>User Not Found Error Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="userNotFoundErrorMessage"
                            value="{{ config('appSettings.userNotFoundErrorMessage') }}" placeholder="User Not Found Error Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid Reset OTP Error Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="invalidOtpErrorMessage"
                            value="{{ config('appSettings.invalidOtpErrorMessage') }}" placeholder="Invalid Reset OTP Error Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Send OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="sendOtpOnEmailButtonText"
                            value="{{ config('appSettings.sendOtpOnEmailButtonText') }}" placeholder="Send OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Already Have OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="alreadyHaveResetOtpButtonText"
                            value="{{ config('appSettings.alreadyHaveResetOtpButtonText') }}" placeholder="Already Have OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Dont Have OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="dontHaveResetOtpButtonText"
                            value="{{ config('appSettings.dontHaveResetOtpButtonText') }}" placeholder="Dont Have OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter Reset OTP Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="enterResetOtpMessageText"
                            value="{{ config('appSettings.enterResetOtpMessageText') }}" placeholder="Enter Reset OTP Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Verify Reset OTP Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="verifyResetOtpButtonText"
                            value="{{ config('appSettings.verifyResetOtpButtonText') }}" placeholder="Verify Reset OTP Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter New Password Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="enterNewPasswordText"
                            value="{{ config('appSettings.enterNewPasswordText') }}" placeholder="Enter New Password Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Password Label Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="newPasswordLabelText"
                            value="{{ config('appSettings.newPasswordLabelText') }}" placeholder="New Password Label Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Set New Password Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="setNewPasswordButtonText"
                            value="{{ config('appSettings.setNewPasswordButtonText') }}" placeholder="Set New Password Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Login/Registration Policy Message</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="registrationPolicyMessage" placeholder="Sub Heading Text" rows="6"></textarea>
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
                        <textarea class="summernote-editor" name="customHomeMessage" placeholder="Custom Home Message - Leave empty to hide" rows="6">{{ config('appSettings.customHomeMessage') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTypeDelivery"
                            value="{{ config('appSettings.deliveryTypeDelivery') }}" placeholder="Delivery Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Self Pickup Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTypeSelfPickup"
                            value="{{ config('appSettings.deliveryTypeSelfPickup') }}" placeholder="Self Pickup Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Store Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noRestaurantMessage"
                            value="{{ config('appSettings.noRestaurantMessage') }}" placeholder="No Store Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Count Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantCountText"
                            value="{{ config('appSettings.restaurantCountText') }}" placeholder="Store Count Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Featured Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantFeaturedText"
                            value="{{ config('appSettings.restaurantFeaturedText') }}" placeholder="Store Featured Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Mins Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="homePageMinsText"
                            value="{{ config('appSettings.homePageMinsText') }}" placeholder="Mins Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>For Two Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="homePageForTwoText"
                            value="{{ config('appSettings.homePageForTwoText') }}" placeholder="For Two Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Near Me Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerNearme"
                            value="{{ config('appSettings.footerNearme') }}" placeholder="Footer Near Me Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Explore Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerExplore"
                            value="{{ config('appSettings.footerExplore') }}" placeholder="Footer ExploreText">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerCart"
                            value="{{ config('appSettings.footerCart') }}" placeholder="Footer Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Account Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerAccount"
                            value="{{ config('appSettings.footerAccount') }}" placeholder="Footer Account Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer Alerts Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="footerAlerts"
                            value="{{ config('appSettings.footerAlerts') }}" placeholder="Footer Alerts Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Restaurant Not Active Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantNotActiveMsg"
                            value="{{ config('appSettings.restaurantNotActiveMsg') }}" placeholder="Restaurant Not Active Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Homepage SearchBar Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="mockSearchPlaceholder"
                            value="{{ config('appSettings.mockSearchPlaceholder') }}" placeholder="Homepage SearchBar Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer PWA Install Prompt Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pwaInstallFooterMessage"
                            value="{{ config('appSettings.pwaInstallFooterMessage') }}" placeholder="Footer PWA Install Prompt Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Footer PWA Install Prompt Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pwaInstallFooterInstallText"
                            value="{{ config('appSettings.pwaInstallFooterInstallText') }}" placeholder="Footer PWA Install Prompt Button Text">
                    </div>
                </div>
                <!--END HomePage Screen Settings -->
                <!-- Alerts Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Alerts Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Mark All Read Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="markAllAlertReadText"
                            value="{{ config('appSettings.markAllAlertReadText') }}" placeholder="Mark All Read Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No New Alerts Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noNewAlertsText"
                            value="{{ config('appSettings.noNewAlertsText') }}" placeholder="No New Alerts Text">
                    </div>
                </div>
                <!-- END Alerts Screen Settings -->
                <!-- Explore Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Explore Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Search Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantSearchPlaceholder"
                            value="{{ config('appSettings.restaurantSearchPlaceholder') }}" placeholder="Store Search Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exploreRestautantsText"
                            value="{{ config('appSettings.exploreRestautantsText') }}" placeholder="Store Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Items Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exploreItemsText"
                            value="{{ config('appSettings.exploreItemsText') }}" placeholder="Items Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Enter At Least 3 Characters Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="searchAtleastThreeCharsMsg"
                            value="{{ config('appSettings.searchAtleastThreeCharsMsg') }}" placeholder="Enter At Least 3 Characters Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Results Found Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exploreNoResults"
                            value="{{ config('appSettings.exploreNoResults') }}" placeholder="No Results Found Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Explore Item's By Store Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="exlporeByRestaurantText" value="{{ config('appSettings.exlporeByRestaurantText') }}" placeholder="Explore Item's By Store Text">
                    </div>
                </div>
                <!-- END Explore Screen Settings -->
                <!-- Items Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Items Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Recommended Badge Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="recommendedBadgeText"
                            value="{{ config('appSettings.recommendedBadgeText') }}" placeholder="Recommended Badge Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popular Item Badge Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="popularBadgeText"
                            value="{{ config('appSettings.popularBadgeText') }}" placeholder="Popular Item Badge Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Item Badge Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="newBadgeText"
                            value="{{ config('appSettings.newBadgeText') }}" placeholder="New Item Badge Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Recommended Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemsPageRecommendedText"
                            value="{{ config('appSettings.itemsPageRecommendedText') }}" placeholder="Recommended Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Fixed Cart View Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="floatCartViewCartText"
                            value="{{ config('appSettings.floatCartViewCartText') }}" placeholder="Fixed Cart View Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Fixed Cart Items Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="floatCartItemsText"
                            value="{{ config('appSettings.floatCartItemsText') }}" placeholder="Fixed Cart Items Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Customizable Item Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customizableItemText"
                            value="{{ config('appSettings.customizableItemText') }}" placeholder="Customization Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Customization Heading</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customizationHeading"
                            value="{{ config('appSettings.customizationHeading') }}" placeholder="Customization Heading">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Customizable Done Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customizationDoneBtnText"
                            value="{{ config('appSettings.customizationDoneBtnText') }}" placeholder="Customizable Done Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pure Veg Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="pureVegText"
                            value="{{ config('appSettings.pureVegText') }}" placeholder="Pure Veg Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Certificate Code Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="certificateCodeText"
                            value="{{ config('appSettings.certificateCodeText') }}" placeholder="Certificate Code Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show More Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="showMoreButtonText"
                            value="{{ config('appSettings.showMoreButtonText') }}" placeholder="Show More Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Show Less Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="showLessButtonText"
                            value="{{ config('appSettings.showLessButtonText') }}" placeholder="Show Less Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Not Accepting Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="notAcceptingOrdersMsg"
                            value="{{ config('appSettings.notAcceptingOrdersMsg') }}" placeholder="Not Accepting Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Search Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemSearchPlaceholder"
                            value="{{ config('appSettings.itemSearchPlaceholder') }}" placeholder="Item Search Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Search Reuslts Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemSearchText"
                            value="{{ config('appSettings.itemSearchText') }}" placeholder="Item Search Reuslts Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Search No Results Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemSearchNoResultText"
                            value="{{ config('appSettings.itemSearchNoResultText') }}" placeholder="Item Search No Results Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Menu Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemsMenuButtonText"
                            value="{{ config('appSettings.itemsMenuButtonText') }}" placeholder="Item Menu Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Percentage Discount Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemPercentageDiscountText"
                            value="{{ config('appSettings.itemPercentageDiscountText') }}" placeholder="Item Percentage Discount Text">
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
                        <textarea class="summernote-editor" name="customCartMessage" placeholder="Custom Cart Message - Leave empty to hide" rows="6">{{ config('appSettings.customCartMessage') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartPageTitle"
                            value="{{ config('appSettings.cartPageTitle') }}" placeholder="Cart Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Items In Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartItemsInCartText"
                            value="{{ config('appSettings.cartItemsInCartText') }}" placeholder="Items In Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Empty Cart Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartEmptyText"
                            value="{{ config('appSettings.cartEmptyText') }}" placeholder="Empty Cart Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Suggestions Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartSuggestionPlaceholder"
                            value="{{ config('appSettings.cartSuggestionPlaceholder') }}" placeholder="Cart Suggestions Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Coupon Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartCouponText"
                            value="{{ config('appSettings.cartCouponText') }}" placeholder="Cart Coupon Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Applied Coupon Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartApplyCoupon"
                            value="{{ config('appSettings.cartApplyCoupon') }}" placeholder="Applied Coupon Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid Coupon Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartInvalidCoupon"
                            value="{{ config('appSettings.cartInvalidCoupon') }}" placeholder="Invalid Coupon Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Coupon Off Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartCouponOffText"
                            value="{{ config('appSettings.cartCouponOffText') }}" placeholder="Coupon Off Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Coupon Not Logged In</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="couponNotLoggedin"
                            value="{{ config('appSettings.couponNotLoggedin') }}" placeholder="Coupon Not Logged In">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Apply Coupon Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="applyCouponButtonText"
                            value="{{ config('appSettings.applyCouponButtonText') }}" placeholder="Apply Coupon Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Bill Details Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartBillDetailsText"
                            value="{{ config('appSettings.cartBillDetailsText') }}" placeholder="Cart Bill Details Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Total Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartItemTotalText"
                            value="{{ config('appSettings.cartItemTotalText') }}" placeholder="Cart Total Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart To Pay Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartToPayText"
                            value="{{ config('appSettings.cartToPayText') }}" placeholder="Cart To Pay Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Charges Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryCharges"
                            value="{{ config('appSettings.cartDeliveryCharges') }}" placeholder="Delivery Charges Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Charges Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRestaurantCharges"
                            value="{{ config('appSettings.cartRestaurantCharges') }}" placeholder="Store Charges Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Select Your Address Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartSetYourAddress"
                            value="{{ config('appSettings.cartSetYourAddress') }}" placeholder="Cart Select Your Address Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Address Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="buttonNewAddress"
                            value="{{ config('appSettings.buttonNewAddress') }}" placeholder="New Address Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Change Location Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartChangeLocation"
                            value="{{ config('appSettings.cartChangeLocation') }}" placeholder="Cart Change Location Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Deliver To Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliverTo"
                            value="{{ config('appSettings.cartDeliverTo') }}" placeholder="Cart Deliver To Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Select Payment Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutSelectPayment"
                            value="{{ config('appSettings.checkoutSelectPayment') }}" placeholder="Select Payment Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Login Header Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartLoginHeader"
                            value="{{ config('appSettings.cartLoginHeader') }}" placeholder="Cart Login Header Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Login Sub Header Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartLoginSubHeader"
                            value="{{ config('appSettings.cartLoginSubHeader') }}" placeholder="Cart Login Sub Header">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Login Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartLoginButtonText"
                            value="{{ config('appSettings.cartLoginButtonText') }}" placeholder="Cart Login Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Self Pikcup Selected Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="selectedSelfPickupMessage"
                            value="{{ config('appSettings.selectedSelfPickupMessage') }}" placeholder="Self Pikcup Selected Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tax Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="taxText"
                            value="{{ config('appSettings.taxText') }}" placeholder="Tax Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Items Removed Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="itemsRemovedMsg"
                            value="{{ config('appSettings.itemsRemovedMsg') }}" placeholder="Items Removed Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>On-going Order Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="ongoingOrderMsg"
                            value="{{ config('appSettings.ongoingOrderMsg') }}" placeholder="On-going Order Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Not Operational Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRestaurantNotOperational"
                            value="{{ config('appSettings.cartRestaurantNotOperational') }}" placeholder="Store Not Operational Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Min Order Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="restaurantMinOrderMessage"
                            value="{{ config('appSettings.restaurantMinOrderMessage') }}" placeholder="Min Order Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Remove Item Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRemoveItemButton"
                            value="{{ config('appSettings.cartRemoveItemButton') }}" placeholder="Remove Item Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Item Not Available Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartItemNotAvailable"
                            value="{{ config('appSettings.cartItemNotAvailable') }}" placeholder="Item Not Available Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Total Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderTextTotal"
                            value="{{ config('appSettings.orderTextTotal') }}" placeholder="Order Total Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Bill Detail Delivery Tip Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipText" value="{{ config('appSettings.tipText') }}" placeholder="Bill Detail Delivery Tip Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Tip Header Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipsForDeliveryText" value="{{ config('appSettings.tipsForDeliveryText') }}" placeholder="Delivery Tip Header Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Tip Thank You Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipsThanksText" value="{{ config('appSettings.tipsThanksText') }}" placeholder="Delivery Tip Thank You Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Other Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tipsOtherText" value="{{ config('appSettings.tipsOtherText') }}" placeholder="Tip Other Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery tip transaction Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTipTransactionMessage" value="{{ config('appSettings.deliveryTipTransactionMessage') }}" placeholder="Delivery tip transaction Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Remove Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartRemoveTipText" value="{{ config('appSettings.cartRemoveTipText') }}" placeholder="Tip Remove Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Amount Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartTipAmountPlaceholderText" value="{{ config('appSettings.cartTipAmountPlaceholderText') }}" placeholder="Tip Amount Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tip Percentage Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartTipPercentagePlaceholderText" value="{{ config('appSettings.cartTipPercentagePlaceholderText') }}" placeholder="Tip Percentage Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Paid with wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderAmountPaidWithWallet" value="{{ config('appSettings.orderAmountPaidWithWallet') }}" placeholder="Order Paid with wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Amount remaining to pay text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderAmountRemainingToPay" value="{{ config('appSettings.orderAmountRemainingToPay') }}" placeholder="Order Amount remaining to pay text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Delivery Type Options Available Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryTypeOptionAvailableText" value="{{ config('appSettings.cartDeliveryTypeOptionAvailableText') }}" placeholder="Cart Delivery Type Options Available Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Delivery Type Selected Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryTypeSelectedText" value="{{ config('appSettings.cartDeliveryTypeSelectedText') }}" placeholder="Cart Delivery Type Selected Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Type Change Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartDeliveryTypeChangeButtonText" value="{{ config('appSettings.cartDeliveryTypeChangeButtonText') }}" placeholder="Delivery Type Change Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Choose Delivery Type Popup Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartChooseDeliveryTypeTitle" value="{{ config('appSettings.cartChooseDeliveryTypeTitle') }}" placeholder="Choose Delivery Type Popup Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemTitle" value="{{ config('appSettings.cartReplaceItemTitle') }}" placeholder="Cart Replace Item Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Sub Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemSubTitle" value="{{ config('appSettings.cartReplaceItemSubTitle') }}" placeholder="Cart Replace Item Sub Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Action No</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemActionNo" value="{{ config('appSettings.cartReplaceItemActionNo') }}" placeholder="Cart Replace Item Action No">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cart Replace Item Action Yes</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cartReplaceItemActionYes" value="{{ config('appSettings.cartReplaceItemActionYes') }}" placeholder="Cart Replace Item Action Yes">
                    </div>
                </div>
                <!-- END Cart Screen Settings -->
                <!-- Checkout Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Checkout Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPageTitle"
                            value="{{ config('appSettings.checkoutPageTitle') }}" placeholder="Checkout Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Payment List Title Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaymentListTitle"
                            value="{{ config('appSettings.checkoutPaymentListTitle') }}" placeholder="Checkout Payment List Title Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Payment In Process Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaymentInProcess"
                            value="{{ config('appSettings.checkoutPaymentInProcess') }}" placeholder="Checkout Payment In Process Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Stripe Text Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeText"
                            value="{{ config('appSettings.checkoutStripeText') }}" placeholder="Stripe Text Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Stripe Sub Text Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeSubText"
                            value="{{ config('appSettings.checkoutStripeSubText') }}" placeholder="Stripe Sub Text Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash On Delivery Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCodText"
                            value="{{ config('appSettings.checkoutCodText') }}" placeholder="Cash On Delivery Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash On Delivery Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCodSubText"
                            value="{{ config('appSettings.checkoutCodSubText') }}" placeholder="Cash On Delivery Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>PayStack Payment Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="paystackPayText"
                            value="{{ config('appSettings.paystackPayText') }}" placeholder="PayStack Payment Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Paytm Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaytmText"
                            value="{{ config('appSettings.checkoutPaytmText') }}" placeholder="Paytm Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Paytm Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPaytmSubText"
                            value="{{ config('appSettings.checkoutPaytmSubText') }}" placeholder="Paytm Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Razorpay Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutRazorpayText"
                            value="{{ config('appSettings.checkoutRazorpayText') }}" placeholder="Razorpay Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Razorpay Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutRazorpaySubText"
                            value="{{ config('appSettings.checkoutRazorpaySubText') }}" placeholder="Razorpay Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>User Banned Message</strong></label>
                    <div class="col-lg-9">
                        <textarea class="summernote-editor" name="userInActiveMessage" placeholder="User Banned Message" rows="6">{{ config('appSettings.userInActiveMessage') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Too many requests message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="tooManyApiCallMessage"
                            value="{{ config('appSettings.tooManyApiCallMessage') }}" placeholder="Too many requests message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ideal Stripe Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeIdealText"
                            value="{{ config('appSettings.checkoutStripeIdealText') }}" placeholder="Ideal Stripe Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ideal Stripe Checkout Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeIdealSubText"
                            value="{{ config('appSettings.checkoutStripeIdealSubText') }}" placeholder="Ideal Stripe Checkout Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>FPX Stripe Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeFpxText"
                            value="{{ config('appSettings.checkoutStripeFpxText') }}" placeholder="FPX Stripe Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>FPX Stripe Checkout SubText</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutStripeFpxSubText"
                            value="{{ config('appSettings.checkoutStripeFpxSubText') }}" placeholder="FPX Stripe Checkout SubText">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>MercadoPago Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutMercadoPagoText"
                            value="{{ config('appSettings.checkoutMercadoPagoText') }}" placeholder="MercadoPago Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>MercadoPago Checkout Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutMercadoPagoSubText"
                            value="{{ config('appSettings.checkoutMercadoPagoSubText') }}" placeholder="MercadoPago Checkout Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>PayMongo Checkout Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPayMongoText"
                            value="{{ config('appSettings.checkoutPayMongoText') }}" placeholder="PayMongo Checkout Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>PayMongo Checkout Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPayMongoSubText"
                            value="{{ config('appSettings.checkoutPayMongoSubText') }}" placeholder="PayMongo Checkout Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Pay Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutPayText"
                            value="{{ config('appSettings.checkoutPayText') }}" placeholder="Checkout Pay Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Card Number Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardNumber"
                            value="{{ config('appSettings.checkoutCardNumber') }}" placeholder="Checkout Card Number Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Expiration Date Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardExpiration"
                            value="{{ config('appSettings.checkoutCardExpiration') }}" placeholder="Checkout Expiration Date Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout CVV Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardCvv"
                            value="{{ config('appSettings.checkoutCardCvv') }}" placeholder="Checkout CVV Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Postal Code Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardPostalCode"
                            value="{{ config('appSettings.checkoutCardPostalCode') }}" placeholder="Checkout Postal Code Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Full Name Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutCardFullname"
                            value="{{ config('appSettings.checkoutCardFullname') }}" placeholder="Checkout Full Name Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout Ideal Select Bank Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutIdealSelectBankText"
                            value="{{ config('appSettings.checkoutIdealSelectBankText') }}" placeholder="Checkout Ideal Select Bank Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Checkout FPX Select Bank Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutFpxSelectBankText"
                            value="{{ config('appSettings.checkoutFpxSelectBankText') }}" placeholder="Checkout FPX Select Bank Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Flutterwave Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutFlutterwaveText" value="{{ config('appSettings.checkoutFlutterwaveText') }}" placeholder="Flutterwave Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Flutterwave Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutFlutterwaveSubText" value="{{ config('appSettings.checkoutFlutterwaveSubText') }}" placeholder="Flutterwave Sub Text">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Khalti Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutKhaltiText"  value="{{ config('appSettings.checkoutKhaltiText') }}" placeholder="Khalti Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Khalti Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="checkoutKhaltiSubText" value="{{ config('appSettings.checkoutKhaltiSubText') }}" placeholder="Khalti Sub Text">
                    </div>
                </div>

                <!-- Cash Change Block -->
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Change Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeTitle" value="{{ config('appSettings.cashChangeTitle') }}" placeholder="Cash Change Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Amount Input Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeInputPlaceholder" value="{{ config('appSettings.cashChangeInputPlaceholder') }}" placeholder="Cash Amount Input Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Amount Confirm Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeConfirmButton" value="{{ config('appSettings.cashChangeConfirmButton') }}" placeholder="Cash Amount Confirm Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Cash Amount Footer Help Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cashChangeHelpText" value="{{ config('appSettings.cashChangeHelpText') }}" placeholder="Cash Amount Footer Help Text">
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
                            value="{{ config('appSettings.runningOrderPlacedTitle') }}" placeholder="Order Placed Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Placed Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderPlacedSub"
                            value="{{ config('appSettings.runningOrderPlacedSub') }}" placeholder="Order Placed Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Preparing Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderPreparingTitle"
                            value="{{ config('appSettings.runningOrderPreparingTitle') }}" placeholder="Order Preparing Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Preparing Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderPreparingSub"
                            value="{{ config('appSettings.runningOrderPreparingSub') }}" placeholder="Order Preparing Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>On Way Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderOnwayTitle"
                            value="{{ config('appSettings.runningOrderOnwayTitle') }}" placeholder="On Way Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>On Way Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderOnwaySub"
                            value="{{ config('appSettings.runningOrderOnwaySub') }}" placeholder="On Way Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Assigned Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveryAssignedTitle"
                            value="{{ config('appSettings.runningOrderDeliveryAssignedTitle') }}" placeholder="Delivery Assigned Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Assigned Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveryAssignedSub"
                            value="{{ config('appSettings.runningOrderDeliveryAssignedSub') }}" placeholder="Delivery Assigned Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Canceled Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderCanceledTitle"
                            value="{{ config('appSettings.runningOrderCanceledTitle') }}" placeholder="Order Canceled Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Canceled Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderCanceledSub"
                            value="{{ config('appSettings.runningOrderCanceledSub') }}" placeholder="Order Canceled Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Ready for Pickup Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderReadyForPickup"
                            value="{{ config('appSettings.runningOrderReadyForPickup') }}" placeholder="Order Ready for Pickup Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Ready for Pickup Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderReadyForPickupSub"
                            value="{{ config('appSettings.runningOrderReadyForPickupSub') }}" placeholder="Order Ready for Pickup Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Delivered Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDelivered"
                            value="{{config('appSettings.runningOrderDelivered') }}" placeholder="Order Delivered Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Delivered Sub Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveredSub"
                            value="{{ config('appSettings.runningOrderDeliveredSub') }}" placeholder="Order Delivered Sub Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Refresh Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderRefreshButton"
                            value="{{ config('appSettings.runningOrderRefreshButton') }}" placeholder="Refresh Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Text after Name</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyAfterName"
                            value="{{ config('appSettings.deliveryGuyAfterName') }}" placeholder="Delivery Guy Text after Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Vehicle Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="vehicleText"
                            value="{{ config('appSettings.vehicleText') }}" placeholder="Vehicle Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Call Now Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="callNowButton"
                            value="{{ config('appSettings.callNowButton') }}" placeholder="Call Now Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Allow Location Access Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="allowLocationAccessMessage"
                            value="{{ config('appSettings.allowLocationAccessMessage') }}" placeholder="Allow Location Access Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Track Order Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="trackOrderText"
                            value="{{ config('appSettings.trackOrderText') }}" placeholder="Track Order Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Placed Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPlacedStatusText"
                            value="{{ config('appSettings.orderPlacedStatusText') }}" placeholder="Order Placed Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Preparing Order Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="preparingOrderStatusText"
                            value="{{ config('appSettings.preparingOrderStatusText') }}" placeholder="Preparing Order Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Assigned Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyAssignedStatusText"
                            value="{{ config('appSettings.deliveryGuyAssignedStatusText') }}" placeholder="Delivery Guy Assigned Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Picked Up Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPickedUpStatusText"
                            value="{{ config('appSettings.orderPickedUpStatusText') }}" placeholder="Order Picked Up Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivered Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveredStatusText"
                            value="{{ config('appSettings.deliveredStatusText') }}" placeholder="Delivered Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Canceled Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="canceledStatusText"
                            value="{{ config('appSettings.canceledStatusText') }}" placeholder="Canceled Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ready For Pickup Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="readyForPickupStatusText"
                            value="{{ config('appSettings.readyForPickupStatusText') }}" placeholder="Ready for Pickup Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Awaiting Payment Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="awaitingPaymentStatusText"
                            value="{{ config('appSettings.awaitingPaymentStatusText') }}" placeholder="Awaiting Payment Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Payment Failed Status Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="paymentFailedStatusText"
                            value="{{ config('appSettings.paymentFailedStatusText') }}" placeholder="Payment Failed Status Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy New Order Notification Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyNewOrderNotificationMsg"
                            value="{{ config('appSettings.deliveryGuyNewOrderNotificationMsg') }}" placeholder="Delivery Guy New Order Notification Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy New Order Notification Message Sub</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGuyNewOrderNotificationMsgSub"
                            value="{{ config('appSettings.deliveryGuyNewOrderNotificationMsgSub') }}" placeholder="Delivery Guy New Order Notification Message Sub">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Pin Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="runningOrderDeliveryPin"
                            value="{{ config('appSettings.runningOrderDeliveryPin') }}" placeholder="Delivery Pin Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Awaiting Payment Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="awaitingPaymentTitle"
                            value="{{ config('appSettings.awaitingPaymentTitle') }}" placeholder="waiting Payment Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Awaiting Payment Sub Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="awaitingPaymentSubTitle"
                            value="{{ config('appSettings.awaitingPaymentSubTitle') }}" placeholder="Awaiting Payment Sub Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Payment Mode Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderDetailsPaymentMode"
                            value="{{ config('appSettings.orderDetailsPaymentMode') }}" placeholder="Order Payment Mode Text">
                    </div>
                </div>
                <!-- END Running Order Screen Settings -->
                <!-- Account Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Account Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Account Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyAccount"
                            value="{{ config('appSettings.accountMyAccount') }}" placeholder="My Account Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Manage Address Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountManageAddress"
                            value="{{ config('appSettings.accountManageAddress') }}" placeholder="Manage Address Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Does Not Deliver To Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="addressDoesnotDeliverToText"
                            value="{{ config('appSettings.addressDoesnotDeliverToText') }}" placeholder="Does Not Deliver To Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Orders Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyOrders"
                            value="{{ config('appSettings.accountMyOrders') }}" placeholder="My Orders Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Helo & FAQ Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountHelpFaq"
                            value="{{ config('appSettings.accountHelpFaq') }}" placeholder="Helo & FAQ Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Logout Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountLogout"
                            value="{{ config('appSettings.accountLogout') }}" placeholder="Logout Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyWallet"
                            value="{{ config('appSettings.accountMyWallet') }}" placeholder="My Wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Orders Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noOrdersText"
                            value="{{ config('appSettings.noOrdersText') }}" placeholder="No Orders Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Canceled Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderCancelledText"
                            value="{{ config('appSettings.orderCancelledText') }}" placeholder="Order Canceled Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Choose Avatar Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="chooseAvatarText"
                            value="{{ config('appSettings.chooseAvatarText') }}" placeholder="Choose Avatar Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>My Favourite Stores</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountMyFavouriteStores"
                            value="{{ config('appSettings.accountMyFavouriteStores') }}" placeholder="My Favourite Stores">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Favourite Stores Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="favouriteStoresPageTitle"
                            value="{{ config('appSettings.favouriteStoresPageTitle') }}" placeholder="Favourite Stores Page Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tax/Vat Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="accountTaxVatText"
                            value="{{ config('appSettings.accountTaxVatText') }}" placeholder="Tax/Vat Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Tax/Vat Save Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="customerVatSave"
                            value="{{ config('appSettings.customerVatSave') }}" placeholder="Tax/Vat Save Button Text">
                    </div>
                </div>
                <!-- END Account Screen Settings -->
                <!-- Search Location Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Search Location Screen Settings </button>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Search Location Placeholder Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="searchAreaPlaceholder"
                            value="{{ config('appSettings.searchAreaPlaceholder') }}" placeholder="Search Location Placeholder Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Search Popular Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="searchPopularPlaces"
                            value="{{ config('appSettings.searchPopularPlaces') }}" placeholder="Search Popular Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Use Current Location Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="useCurrentLocationText"
                            value="{{ config('appSettings.useCurrentLocationText') }}" placeholder="Use Current Location Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>GPS Access not Granted Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="gpsAccessNotGrantedMsg"
                            value="{{ config('appSettings.gpsAccessNotGrantedMsg') }}" placeholder="GPS Access not Granted Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Your Location Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="yourLocationText"
                            value="{{ config('appSettings.yourLocationText') }}" placeholder="Your Location Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Address Field Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="editAddressAddress"
                            value="{{ config('appSettings.editAddressAddress') }}" placeholder="Address Field Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Edit Address Tag</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="editAddressTag"
                            value="{{ config('appSettings.editAddressTag') }}" placeholder="Edit Address Tag">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Address Tag Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="addressTagPlaceholder"
                            value="{{ config('appSettings.addressTagPlaceholder') }}" placeholder="Address Tag Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Save Address Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="buttonSaveAddress"
                            value="{{ config('appSettings.buttonSaveAddress') }}" placeholder="Save Address Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Saved Addresses (Location page)</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="locationSavedAddresses"
                            value="{{ config('appSettings.locationSavedAddresses') }}" placeholder="Saved Addresses">
                    </div>
                </div>
                <!-- END Search Location Screen Settings -->
                <!--  Address Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Address Screen Settings </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delete Address Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deleteAddressText"
                            value="{{ config('appSettings.deleteAddressText') }}" placeholder="Delete Address Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Address Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="noAddressText"
                            value="{{ config('appSettings.noAddressText') }}" placeholder="No Address Text">
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
                            value="{{ config('appSettings.noWalletTransactionsText') }}" placeholder="No Wallet Transactions Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Deposit Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="walletDepositText"
                            value="{{ config('appSettings.walletDepositText') }}" placeholder="Wallet Deposit Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Withdraw Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="walletWithdrawText"
                            value="{{ config('appSettings.walletWithdrawText') }}" placeholder="Wallet Withdraw Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pay Partial with Wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="payPartialWithWalletText"
                            value="{{ config('appSettings.payPartialWithWalletText') }}" placeholder="Pay Partial with Wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet money Will be Deducted Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="willbeDeductedText"
                            value="{{ config('appSettings.willbeDeductedText') }}" placeholder="Wallet money Will be Deducted Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pay Full With Wallet Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="payFullWithWalletText"
                            value="{{ config('appSettings.payFullWithWalletText') }}" placeholder="Pay Full With Wallet Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Payment for Order Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPaymentWalletComment"
                            value="{{ config('appSettings.orderPaymentWalletComment') }}" placeholder="Wallet Comment - Payment for Order Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Partial Payment for Order Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPartialPaymentWalletComment"
                            value="{{ config('appSettings.orderPartialPaymentWalletComment') }}" placeholder="Wallet Comment - Partial Payment for Order Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Order Refund Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderRefundWalletComment"
                            value="{{ config('appSettings.orderRefundWalletComment') }}" placeholder="Wallet Comment - Order Refund Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Comment - Order Partial Refund Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderPartialRefundWalletComment"
                            value="{{ config('appSettings.orderPartialRefundWalletComment') }}" placeholder="Wallet Comment - Order Partial Refund Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Wallet Redeem Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="walletRedeemBtnText"
                            value="{{ config('appSettings.walletRedeemBtnText') }}" placeholder="Wallet Redeem Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Cancel Order Main Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cancelOrderMainButton"
                            value="{{ config('appSettings.cancelOrderMainButton') }}" placeholder="Order Cancel - Cancel Order Main Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Will Be Refunded Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="willBeRefundedText"
                            value="{{ config('appSettings.willBeRefundedText') }}" placeholder="Order Cancel - Will Be Refunded Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Will Not Be Refunded Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="willNotBeRefundedText"
                            value="{{ config('appSettings.willNotBeRefundedText') }}" placeholder="Order Cancel - Will Not Be Refunded Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Do you want to cancel text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderCancellationConfirmationText"
                            value="{{ config('appSettings.orderCancellationConfirmationText') }}" placeholder="Order Cancel - Do you want to cancel text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Yes Cancel Order Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="yesCancelOrderBtn"
                            value="{{ config('appSettings.yesCancelOrderBtn') }}" placeholder="Order Cancel - Yes Cancel Order Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Cancel - Go Back Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="cancelGoBackBtn"
                            value="{{ config('appSettings.cancelGoBackBtn') }}" placeholder="Order Cancel - Go Back Button">
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
                            value="{{ config('appSettings.deliveryWelcomeMessage') }}" placeholder="Delivery Welcome Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Accepted Orders Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryAcceptedOrdersTitle"
                            value="{{ config('appSettings.deliveryAcceptedOrdersTitle') }}" placeholder="Accepted Orders Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Accepted Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNoOrdersAccepted"
                            value="{{ config('appSettings.deliveryNoOrdersAccepted') }}" placeholder="No Accepted Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>New Orders Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNewOrdersTitle"
                            value="{{ config('appSettings.deliveryNewOrdersTitle') }}" placeholder="New Orders Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No New Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNoNewOrders"
                            value="{{ config('appSettings.deliveryNoNewOrders') }}" placeholder="No New Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Pickedup Orders Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryPickedupOrdersTitle"
                            value="{{ config('appSettings.deliveryPickedupOrdersTitle') }}" placeholder="Pickedup Orders Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>No Pickedup Orders Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryNoPickedupOrdersMsg"
                            value="{{ config('appSettings.deliveryNoPickedupOrdersMsg') }}" placeholder="No Pickedup Orders Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Items</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrderItems"
                            value="{{ config('appSettings.deliveryOrderItems') }}" placeholder="Order Items">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Store Address</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryRestaurantAddress"
                            value="{{ config('appSettings.deliveryRestaurantAddress') }}" placeholder="Store Address">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Address</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryDeliveryAddress"
                            value="{{ config('appSettings.deliveryDeliveryAddress') }}" placeholder="Delivery Address">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Get Direction Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryGetDirectionButton"
                            value="{{ config('appSettings.deliveryGetDirectionButton') }}" placeholder="Get Direction Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Online Payment</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOnlinePayment"
                            value="{{ config('appSettings.deliveryOnlinePayment') }}" placeholder="Online Payment">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Cash on Delivery Payment</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCashOnDelivery"
                            value="{{ config('appSettings.deliveryCashOnDelivery') }}" placeholder="Delivery Cash on Delivery Payment">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Pin Placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryDeliveryPinPlaceholder"
                            value="{{ config('appSettings.deliveryDeliveryPinPlaceholder') }}" placeholder="Delivery Pin Placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Accept to Deliver Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryAcceptOrderButton"
                            value="{{ config('appSettings.deliveryAcceptOrderButton') }}" placeholder="Accept to Deliver Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Picked Up Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryPickedUpButton"
                            value="{{ config('appSettings.deliveryPickedUpButton') }}" placeholder="Picked Up Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivered Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryDeliveredButton"
                            value="{{ config('appSettings.deliveryDeliveredButton') }}" placeholder="Delivered Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Completed Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrderCompletedButton"
                            value="{{ config('appSettings.deliveryOrderCompletedButton') }}" placeholder="Order Completed Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Already Accepted Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryAlreadyAccepted"
                            value="{{ config('appSettings.deliveryAlreadyAccepted') }}" placeholder="Delivery Already Accepted Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Invalid Delivery Pin Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryInvalidDeliveryPin"
                            value="{{ config('appSettings.deliveryInvalidDeliveryPin') }}" placeholder="Invalid Delivery Pin Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Logout Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryLogoutDelivery"
                            value="{{ config('appSettings.deliveryLogoutDelivery') }}" placeholder="Delivery Logout Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Logout Confirmation</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryLogoutConfirmation"
                            value="{{ config('appSettings.deliveryLogoutConfirmation') }}" placeholder="Delivery Logout Confirmation Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Orders Refresh Button</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrdersRefreshBtn"
                            value="{{ config('appSettings.deliveryOrdersRefreshBtn') }}" placeholder="Delivery Orders Refresh Button">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Order Placed Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOrderPlacedText"
                            value="{{ config('appSettings.deliveryOrderPlacedText') }}" placeholder="Order Placed Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer New Orders</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterNewTitle"
                            value="{{ config('appSettings.deliveryFooterNewTitle') }}" placeholder="Delivery Footer New Orders">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer Accepted</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterAcceptedTitle"
                            value="{{ config('appSettings.deliveryFooterAcceptedTitle') }}" placeholder="Delivery Footer Accepted">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer My Account</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterAccount"
                            value="{{ config('appSettings.deliveryFooterAccount') }}" placeholder="Delivery Footer My Account">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Footer Pickedup</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryFooterPickedup"
                            value="{{ config('appSettings.deliveryFooterPickedup') }}" placeholder="Delivery Footer Pickedup">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account Earnings Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningsText"
                            value="{{ config('appSettings.deliveryEarningsText') }}" placeholder="Delivery Account Earnings Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account COD Collection Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCollectionText"
                            value="{{ config('appSettings.deliveryCollectionText') }}" placeholder="Delivery Account COD Collection Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account On-Going Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryOnGoingText"
                            value="{{ config('appSettings.deliveryOnGoingText') }}" placeholder="Delivery Account On-Going Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Account Completed Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCompletedText"
                            value="{{ config('appSettings.deliveryCompletedText') }}" placeholder="Delivery Account Completed Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Commission Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryCommissionMessage"
                            value="{{ config('appSettings.deliveryCommissionMessage') }}" placeholder="Delivery Commission Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Updating System Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="updatingMessage"
                            value="{{ config('appSettings.updatingMessage') }}" placeholder="Updating System Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Categories Page Filters Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="categoriesFiltersText"
                            value="{{ config('appSettings.categoriesFiltersText') }}" placeholder="Categories Page Filters Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Categories Page No Store Found Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="categoriesNoRestaurantsFoundText"
                            value="{{ config('appSettings.categoriesNoRestaurantsFoundText') }}" placeholder="Categories Page No Store Found Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Total Earnings Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryTotalEarningsText"
                            value="{{ config('appSettings.deliveryTotalEarningsText') }}" placeholder="Delivery Guy Total Earnings Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Use Phone To Access Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryUsePhoneToAccessMsg"
                            value="{{ config('appSettings.deliveryUsePhoneToAccessMsg') }}" placeholder="Delivery Use Phone To Access Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Max Order Reached</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryMaxOrderReachedMsg"
                            value="{{ config('appSettings.deliveryMaxOrderReachedMsg') }}" placeholder="Delivery Max Order Reached">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Earnings Commission Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningCommissionText"
                            value="{{ config('appSettings.deliveryEarningCommissionText') }}" placeholder="Delivery Guy Earnings Commission Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Earnings Tip Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningTipText"
                            value="{{ config('appSettings.deliveryEarningTipText') }}" placeholder="Delivery Guy Earnings Tip Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Earnings Total Earning Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryEarningTotalEarningText"
                            value="{{ config('appSettings.deliveryEarningTotalEarningText') }}" placeholder="Delivery Guy Earnings Total Earning Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Guy Last 7 Days Earning Chart Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryLastSevenDaysEarningTitle"
                            value="{{ config('appSettings.deliveryLastSevenDaysEarningTitle') }}" placeholder="Delivery Guy Last 7 Days Earning Chart Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Delivery Toggle Light/Dark Mode Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="deliveryToggleLightDarkMode"
                            value="{{ config('appSettings.deliveryToggleLightDarkMode') }}" placeholder="Delivery Toggle Light/Dark Mode Button Text">
                    </div>
                </div>
                <!--  END Delivery Screen Settings -->
                <!-- InAppNotification Screen Setting -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>In App Notification Popup </button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Notification Close Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="inAppCloseButton"
                            value="{{ config('appSettings.inAppCloseButton') }}" placeholder="Notification Close Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Notification Open Link Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="inAppOpenLinkButton"
                            value="{{ config('appSettings.inAppOpenLinkButton') }}" placeholder="Notification Open Link Button Text">
                    </div>
                </div>
                <!-- END InAppNotification Screen Setting -->
                <!-- iOSPWAPrompt Screen Setting -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>iOS PWA Custom Popup</button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupTitle"
                            value="{{ config('appSettings.iOSPWAPopupTitle') }}" placeholder="Popup Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupBody"
                            value="{{ config('appSettings.iOSPWAPopupBody') }}" placeholder="Popup Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Share Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupShareButtonLabel"
                            value="{{ config('appSettings.iOSPWAPopupShareButtonLabel') }}" placeholder="Popup Share Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Add To HomeScreen Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupAddButtonLabel"
                            value="{{ config('appSettings.iOSPWAPopupAddButtonLabel') }}" placeholder="Popup Add To HomeScreen Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Cancel Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupCloseButtonLabel"
                            value="{{ config('appSettings.iOSPWAPopupCloseButtonLabel') }}" placeholder="Popup Cancel Button Text">
                    </div>
                </div>
                <!-- END iOSPWAPrompt Screen Setting -->
                <!-- OfflineMode Screen Setting -->
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Offline Title Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="offlineTitleMessage"
                            value="{{ config('appSettings.offlineTitleMessage') }}" placeholder="Offline Title Message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Offline Sub-Title Message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="offlineSubTitleMessage"
                            value="{{ config('appSettings.offlineSubTitleMessage') }}" placeholder="Offline Sub-Title Message">
                    </div>
                </div>
                <!-- END OfflineMode Screen Setting -->
                <!-- Rating and Reviews Screen Settings -->
                <button class="btn btn-primary translation-section-btn mt-4" type="button"> <i class="icon-mobile mr-1"></i>Ratings and Review</button> 
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Popup Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="iOSPWAPopupTitle"
                            value="{{ config('appSettings.iOSPWAPopupTitle') }}" placeholder="Popup Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Order Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="orderRateOrderButton"
                            value="{{ config('appSettings.orderRateOrderButton') }}" placeholder="Rate Order Button Text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Ratings Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="reviewsPageTitle"
                            value="{{ config('appSettings.reviewsPageTitle') }}" placeholder="Ratings Page Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate your order Page Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarModRatingPageTitle" value="{{ config('appSettings.rarModRatingPageTitle') }}" placeholder="Rate your order Page Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Delivery Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarModDeliveryRatingTitle"
                            value="{{ config('appSettings.rarModDeliveryRatingTitle') }}" placeholder="Rate Delivery Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Delivery Feedback Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarReviewBoxTitleDeliveryFeedback"
                            value="{{ config('appSettings.rarReviewBoxTitleDeliveryFeedback') }}" placeholder="Rate Delivery Feedback Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Store Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarModRestaurantRatingTitle"
                            value="{{ config('appSettings.rarModRestaurantRatingTitle') }}" placeholder="Rate Store Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rate Store Feedback Title</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarReviewBoxTitleStoreFeedback"
                            value="{{ config('appSettings.rarReviewBoxTitleStoreFeedback') }}" placeholder="Rate Store Feedback Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Feeback textbox placeholder</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarReviewBoxTextPlaceHolderText"
                            value="{{ config('appSettings.rarReviewBoxTextPlaceHolderText') }}" placeholder="Feeback textbox placeholder">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Rating reqired error message</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="ratingsRequiredMessage"
                            value="{{ config('appSettings.ratingsRequiredMessage') }}" placeholder="Rating reqired error message">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"><strong>Review Submit Button Text</strong></label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control form-control-lg" name="rarSubmitButtonText"
                            value="{{ config('appSettings.rarSubmitButtonText') }}" placeholder="Review Submit Button Text">
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
            </form>
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