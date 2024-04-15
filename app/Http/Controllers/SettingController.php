<?php

namespace App\Http\Controllers;

use App\PaymentGateway;
use App\Setting;
use App\SmsGateway;
use Artisan;
use Cache;
use DotenvEditor;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Image;
use Mail;
use Modules\SuperCache\SuperCache;
use Nwidart\Modules\Facades\Module;

class SettingController extends Controller
{
    /**
     * @param $name
     * @param $data
     */
    private function processSuperCache($name, $data = null)
    {
        if (Module::find('SuperCache') && Module::find('SuperCache')->isEnabled()) {
            $superCache = new SuperCache();
            $superCache->cacheResponse($name, $data);
        }
    }

    public function getSettings()
    {

        // Cache::forget('app-settings');

        if (Cache::has('app-settings')) {
            $settings = Cache::get('app-settings');
        } else {
            $settings = Setting::whereNotIn('key', ['categoriesFiltersText', 'categoriesNoRestaurantsFoundText', 'exlporeByRestaurantText', 'setNewPasswordButtonText', 'newPasswordLabelText', 'enterNewPasswordText', 'dontHaveResetOtpButtonText', 'verifyResetOtpButtonText', 'enterResetOtpMessageText', 'alreadyHaveResetOtpButtonText', 'sendOtpOnEmailButtonText', 'resetPasswordPageSubTitle', 'resetPasswordPageTitle', 'invalidOtpErrorMessage', 'userNotFoundErrorMessage', 'updatingMessage', 'exploreNoResults', 'stripeSecretKey', 'paystackPrivateKey', 'twilioSid', 'twilioAccessToken', 'twilioServiceId', 'twilioFromPhone', 'minPayout', 'otpMessage', 'smsRestaurantNotify', 'smsDeliveryNotify', 'defaultSmsRestaurantMsg', 'smsRestOrderValue', 'smsOrderNotify', 'defaultSmsDeliveryMsg', 'restaurantNotificationAudioTrack', 'restaurantNewOrderRefreshRate', 'firebaseSecret', 'razorpayKeySecret', 'deliveryAcceptTimeThreshold', 'restaurantAcceptTimeThreshold', 'enDevMode', 'deliveryGuyCommissionFrom', 'itemPercentageDiscountText', 'itemsMenuButtonText', 'itemSearchPlaceholder', 'itemSearchNoResultText', 'itemSearchText', 'deliveryCommissionMessage', 'deliveryCompletedText', 'deliveryOnGoingText', 'deliveryEarningsText', 'deliveryFooterAccount', 'deliveryFooterAcceptedTitle', 'deliveryFooterNewTitle', 'changeLanguageText', 'searchAtleastThreeCharsMsg', 'orderCancelledText', 'socialLoginOrText', 'deliveryCashOnDelivery', 'deliveryOrderPlacedText', 'cancelOrderMainButton', 'cancelGoBackBtn', 'yesCancelOrderBtn', 'orderCancellationConfirmationText', 'exploreItemsText', 'exploreRestautantsText', 'notAcceptingOrdersMsg', 'yourLocationText', 'gpsAccessNotGrantedMsg', 'useCurrentLocationText', 'addressDoesnotDeliverToText', 'cartRestaurantNotOperational', 'willNotBeRefundedText', 'willBeRefundedText', 'cartCouponOffText', 'deliveryGuyNewOrderNotificationMsgSub', 'deliveryGuyNewOrderNotificationMsg', 'restaurantNewOrderNotificationMsgSub', 'restaurantNewOrderNotificationMsg', 'walletRedeemBtnText', 'orderPartialRefundWalletComment', 'orderRefundWalletComment', 'orderPartialPaymentWalletComment', 'orderPaymentWalletComment', 'payFullWithWalletText', 'willbeDeductedText', 'payPartialWithWalletText', 'walletWithdrawText', 'walletDepositText', 'noWalletTransactionsText', 'accountMyWallet', 'showLessButtonText', 'showMoreButtonText', 'certificateCodeText', 'pureVegText', 'readyForPickupStatusText', 'canceledStatusText', 'deliveredStatusText', 'orderPickedUpStatusText', 'deliveryGuyAssignedStatusText', 'preparingOrderStatusText', 'orderPlacedStatusText', 'trackOrderText', 'ongoingOrderMsg', 'itemsRemovedMsg', 'taxText', 'deliveryOrdersRefreshBtn', 'allowLocationAccessMessage', 'checkoutRazorpaySubText', 'checkoutRazorpayText', 'callNowButton', 'deliveryGuyAfterName', 'vehicleText', 'selectedSelfPickupMessage', 'noRestaurantMessage', 'deliveryTypeSelfPickup', 'deliveryTypeDelivery', 'runningOrderReadyForPickupSub', 'runningOrderReadyForPickup', 'emailPassDonotMatch', 'socialWelcomeText', 'verifyOtpBtnText', 'resendOtpCountdownMsg', 'resendOtpMsg', 'otpSentMsg', 'invalidOtpMsg', 'enterPhoneToVerify', 'emailPhoneAlreadyRegistered', 'minimumLengthValidationMessage', 'phoneValidationMsg', 'emailValidationMsg', 'nameValidationMsg', 'fieldValidationMsg', 'paystackPayText', 'customizationDoneBtnText', 'customizableItemText', 'customizationHeading', 'deliveryLogoutConfirmation', 'deliveryLogoutDelivery', 'deliveryAlreadyAccepted', 'deliveryInvalidDeliveryPin', 'deliveryOrderCompletedButton', 'deliveryDeliveredButton', 'deliveryPickedUpButton', 'deliveryAcceptOrderButton', 'deliveryDeliveryPinPlaceholder', 'deliveryOnlinePayment', 'deliveryDeliveryAddress', 'deliveryGetDirectionButton', 'deliveryRestaurantAddress', 'deliveryOrderItems', 'deliveryWelcomeMessage', 'deliveryAcceptedOrdersTitle', 'deliveryNewOrdersTitle', 'restaurantFeaturedText', 'gdprConfirmButton', 'gdprMessage', 'runningOrderDeliveredSub', 'runningOrderDelivered', 'deliveryNoNewOrders', 'deliveryNoOrdersAccepted', 'runningOrderDeliveryPin', 'desktopFooterAddress', 'desktopFooterSocialHeader', 'desktopAchievementFourSub', 'desktopAchievementFourTitle', 'desktopAchievementThreeSub', 'desktopAchievementThreeTitle', 'desktopAchievementTwoSub', 'desktopAchievementTwoTitle', 'desktopAchievementOneSub', 'desktopAchievementOneTitle', 'desktopUseAppButton', 'desktopSubHeading', 'desktopHeading', 'accountMyAccount', 'regsiterAlreadyHaveAccount', 'loginDontHaveAccount', 'firstScreenRegisterBtn', 'registerRegisterSubTitle', 'registerRegisterTitle', 'registerErrorMessage', 'loginLoginNameLabel', 'loginLoginPhoneLabel', 'checkoutCodSubText', 'checkoutCodText', 'checkoutStripeSubText', 'checkoutStripeText', 'checkoutPaymentInProcess', 'cartSetYourAddress', 'cartToPayText', 'cartCouponText', 'cartDeliveryCharges', 'cartRestaurantCharges', 'cartItemTotalText', 'cartBillDetailsText', 'cartItemsInCartText', 'floatCartViewCartText', 'floatCartItemsText', 'itemsPageRecommendedText', 'homePageForTwoText', 'homePageMinsText', 'loginLoginPasswordLabel', 'loginLoginEmailLabel', 'loginLoginSubTitle', 'loginLoginTitle', 'pleaseWaitText', 'loginErrorMessage', 'firstScreenLoginBtn', 'firstScreenWelcomeMessage', 'runningOrderCanceledSub', 'runningOrderCanceledTitle', 'runningOrderDeliveryAssignedSub', 'runningOrderDeliveryAssignedTitle', 'checkoutSelectPayment', 'checkoutPaymentListTitle', 'orderTextTotal', 'noOrdersText', 'runningOrderRefreshButton', 'runningOrderOnwaySub', 'runningOrderOnwayTitle', 'runningOrderPreparingSub', 'runningOrderPreparingTitle', 'runningOrderPlacedSub', 'runningOrderPlacedTitle', 'checkoutPlaceOrder', 'checkoutPageTitle', 'cartPageTitle', 'cartSetAddressText', 'noAddressText', 'deleteAddressText', 'editAddressText', 'cartSuggestionPlaceholder', 'cartInvalidCoupon', 'cartApplyCoupon', 'addressTagPlaceholder', 'editAddressTag', 'editAddressLandmark', 'editAddressHouse', 'editAddressAddress', 'buttonSaveAddress', 'buttonNewAddress', 'cartChangeLocation', 'cartDeliverTo', 'cartLoginButtonText', 'cartLoginSubHeader', 'cartLoginHeader', 'cartMakePayment', 'accountLogout', 'accountHelpFaq', 'accountMyOrders', 'accountManageAddress', 'restaurantSearchPlaceholder', 'cartEmptyText', 'newBadgeText', 'popularBadgeText', 'recommendedBadgeText', 'searchPopularPlaces', 'searchAreaPlaceholder', 'restaurantCountText', 'footerAccount', 'footerCart', 'footerExplore', 'footerNearme', 'firstScreenLoginText', 'firstScreenSetupLocation', 'firstScreenSubHeading', 'firstScreenHeading', 'registrationPolicyMessage', 'locationSavedAddresses', 'restaurantMinOrderMessage', 'footerAlerts', 'markAllAlertReadText', 'noNewAlertsText', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'sendgrid_api_key', 'mail_driver', 'cartItemNotAvailable', 'cartRemoveItemButton', 'deliveryTotalEarningsText', 'deliveryUsePhoneToAccessMsg', 'restaurantNotActiveMsg', 'uploadImageQuality', 'msg91SenderId', 'msg91AuthKey', 'sendEmailFromEmailName', 'sendEmailFromEmailAddress', 'mapApiKey', 'firebaseSDKSnippet', 'deliveryMaxOrderReachedMsg', 'chooseAvatarText', 'customCartMessage', 'customHomeMessage', 'inAppCloseButton', 'inAppOpenLinkButton', 'iOSPWAPopupTitle', 'iOSPWAPopupBody', 'iOSPWAPopupShareButtonLabel', 'iOSPWAPopupAddButtonLabel', 'iOSPWAPopupCloseButtonLabel', 'offlineTitleMessage', 'offlineSubTitleMessage', 'userInActiveMessage', 'googleApiKeyNoRestriction', 'mockSearchPlaceholder', 'tooManyApiCallMessage', 'paymongoSK', 'awaitingPaymentStatusText', 'paymentFailedStatusText', 'awaitingPaymentTitle', 'awaitingPaymentSubTitle', 'checkoutStripeIdealText', 'checkoutStripeIdealSubText', 'checkoutStripeFpxText', 'checkoutStripeFpxSubText', 'checkoutMercadoPagoText', 'checkoutMercadoPagoSubText', 'checkoutPayMongoText', 'checkoutPayMongoSubText', 'checkoutPayText', 'checkoutCardNumber', 'checkoutCardExpiration', 'checkoutCardCvv', 'checkoutCardPostalCode', 'checkoutCardFullname', 'checkoutIdealSelectBankText', 'checkoutFpxSelectBankText', 'mercadopagoAccessToken', 'couponNotLoggedin', 'paytm_environment', 'paytm_merchant_id', 'paytm_merchant_key', 'paytm_merchant_website', 'paytm_channel', 'paytm_industry_type', 'checkoutPaytmText', 'checkoutPaytmSubText', 'deliveryCollectionText', 'allowPaymentGatewaySelection', 'orderDetailsPaymentMode', 'oneSignalAppId', 'oneSignalRestApiKey', 'sortSelfpickupStoresByDistance', 'deliveryEarningCommissionText', 'applyCouponButtonText', 'tipText', 'tipsForDeliveryText', 'tipsThanksText', 'tipsOtherText', 'deliveryTipTransactionMessage', 'deliveryEarningTipText', 'deliveryEarningTotalEarningText', 'deliveryLastSevenDaysEarningTitle', 'cartRemoveTipText', 'cartTipAmountPlaceholderText', 'cartTipPercentagePlaceholderText', 'deliveryPickedupOrdersTitle', 'deliveryNoPickedupOrdersMsg', 'deliveryFooterPickedup', 'desktopTryItOnPhoneTitle', 'desktopTryItOnPhoneSubTitle', 'orderAmountPaidWithWallet', 'orderAmountRemainingToPay', 'deliveryToggleLightDarkMode', 'checkoutFlutterwaveText', 'checkoutFlutterwaveSubText', 'cartDeliveryTypeChangeButtonText', 'cartChooseDeliveryTypeTitle', 'accountMyFavouriteStores', 'favouriteStoresPageTitle', 'cartReplaceItemTitle', 'cartReplaceItemSubTitle', 'cartReplaceItemActionNo', 'cartReplaceItemActionYes', 'cartDeliveryTypeOptionAvailableText', 'cartDeliveryTypeSelectedText', 'accountTaxVatText', 'customerVatSave', 'pwaInstallFooterMessage', 'pwaInstallFooterInstallText', 'msg91OtpDltTemplateId', 'msg91NewOrderDltTemplateId', 'msg91NewOrderDeliveryDltTemplateId', 'reviewsPageTitle', 'rarModDeliveryRatingTitle', 'rarReviewBoxTitleDeliveryFeedback', 'rarModRestaurantRatingTitle', 'rarReviewBoxTitleStoreFeedback', 'rarReviewBoxTextPlaceHolderText', 'orderRateOrderButton', 'ratingsRequiredMessage', 'rarSubmitButtonText', 'rarModRatingPageTitle', 'checkoutKhaltiText', 'checkoutKhaltiSubText', 'cashChangeTitle', 'cashChangeInputPlaceholder', 'cashChangeConfirmButton', 'cashChangeHelpText', 'khaltiSecretKey'])->get(['key', 'value']);
            $this->processSuperCache('app-settings', $settings);
        }

        return response()->json($settings);
    }

    /**
     * @param Request $request
     */
    public function settings(Request $request)
    {
        $paymentGateways = PaymentGateway::all();
        $activePaymentGateways = PaymentGateway::where('is_active', '1')->get();

        /*Version Info */
        $versionFile = File::get(base_path('version.txt'));
        if ($versionFile) {
            $versionMsg = 'v' . $versionFile;
        } else {
            $versionMsg = null;
        }

        $versionJson = File::get(base_path('version.json'));
        if ($versionJson) {
            $versionJson = json_decode($versionJson);
        } else {
            $versionJson = null;
        }

        $notificationAudioFiles = \File::files(base_path('/assets/backend/tones'));
        $notificationAudioFileNames = [];
        foreach ($notificationAudioFiles as $path) {
            $file = pathinfo($path);
            array_push($notificationAudioFileNames, $file['filename']);
        }

        if (Schema::hasTable('sms_gateways')) {
            $sms_gateways = SmsGateway::all();
        } else {
            $sms_gateways = [];
        }

        $tips = Setting::where('key', 'tips')->first();
        $tips_percentage = Setting::where('key', 'tips_percentage')->first();

        return view('admin.settings', array(
            'paymentGateways' => $paymentGateways,
            'activePaymentGateways' => $activePaymentGateways,
            'versionMsg' => $versionMsg,
            'versionJson' => $versionJson,
            'notificationAudioFileNames' => $notificationAudioFileNames,
            'sms_gateways' => $sms_gateways,
            'tips' => !is_null($tips) ? explode(',', $tips->value) : [],
            'tips_percentage' => !is_null($tips_percentage) ? explode(',', $tips_percentage->value) : []
        ));
    }

    /**
     * @param Request $request
     * @param Factory $cache
     */
    public function saveSettings(Request $request, Factory $cache)
    {
        // dd($request->all());
        $allSettings = $request->except(['logo', 'favicon', 'splashLogo', 'seoOgImage', 'seoTwitterImage', 'firstScreenHeroImage', 'showPromoSlider', 'showMap', 'enablePushNotification', 'enablePushNotificationOrders', 'showGdpr', 'enableGoogleAnalytics', 'taxApplicable', 'enSOV', 'enSPU', 'enableFacebookLogin', 'enableGoogleLogin', 'enableDeliveryPin', 'timezone', 'enDevMode', 'hidePriceWhenZero', 'enableDeliveryGuyEarning', 'enPassResetEmail', 'showPercentageDiscount', 'showVegNonVegBadge', 'showFromNowDate', 'enDelChrRnd', 'expandAllItemMenu', 'smsRestaurantNotify', 'smsRestOrderValue', 'smsDeliveryNotify', 'smsOrderNotify', 'showOrderAddonsDelivery', 'showDeliveryFullAddressOnList', 'showUserInfoBeforePickup', 'recommendedLayoutV2', 'flatApartmentAddressRequired', 'showInActiveItemsToo', 'enGDMA', 'showPriceAndOrderCommentsDelivery', 'useSimpleSpinner', 'randomizeStores', 'showCouponDescriptionOnSuccess', 'stripeAcceptAliPay', 'stripeAcceptBitCoin', 'enIOSPWAPopup', 'mockSearchOnHomepage', 'stripeInlineCardCheckout', 'stripeAcceptIdealPayment', 'stripeAcceptFpxPayment', 'stripeCheckoutPostalCode', 'googleFullAddress', 'showDeliveryCollection', 'allowPaymentGatewaySelection', 'sortSelfpickupStoresByDistance', 'countQuantityAsTotalItemsOnCart', 'tips', 'tips_percentage', 'showTipsAmount', 'showTipsPercentage', 'showTryItOnPhone', 'showAddonPricesOnCart', 'showCustomerVatNumber', 'showPwaInstallPromptFooter', 'showCashChange', 'sortDeliveryStoresByDistance']);
        // dd($allSettings);
        foreach ($allSettings as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting != null) {
                $setting->value = $value;
                $setting->save();
            }
        }

        if ($request->has('tips')) {
            $setting = Setting::where('key', 'tips')->first();
            if (is_null($setting)) {
                $setting = new Setting();
                $setting->key = 'tips';
                $setting->value = implode(',', $request->tips);
                $setting->save();
            } else {
                $setting->value = implode(',', $request->tips);
                $setting->save();
            }
        }
        if ($request->has('tips_percentage')) {
            $setting = Setting::where('key', 'tips_percentage')->first();
            if (is_null($setting)) {
                $setting = new Setting();
                $setting->key = 'tips_percentage';
                $setting->value = implode(',', $request->tips_percentage);
                $setting->save();
            } else {
                $setting->value = implode(',', $request->tips_percentage);
                $setting->save();
            }
        }

        if ($request->hasFile('favicon')) {
            $setting = Setting::where('key', 'favicon-16x16')->first();
            $image = $request->file('favicon');
            $filename = 'favicon-16x16.png';
            Image::make($image)->resize(16, 16)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();

            $setting = Setting::where('key', 'favicon-32x32')->first();
            $image = $request->file('favicon');
            $filename = 'favicon-32x32.png';
            Image::make($image)->resize(32, 32)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();

            $setting = Setting::where('key', 'favicon-96x96')->first();
            $image = $request->file('favicon');
            $filename = 'favicon-96x96.png';
            Image::make($image)->resize(96, 96)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();

            $setting = Setting::where('key', 'favicon-128x128')->first();
            $image = $request->file('favicon');
            $filename = 'favicon-128x128.png';
            Image::make($image)->resize(128, 128)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();

            /* For PWA Manifest*/
            $image = $request->file('favicon');
            $filename = 'favicon-36x36.png';
            Image::make($image)->resize(36, 36)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');

            $image = $request->file('favicon');
            $filename = 'favicon-48x48.png';
            Image::make($image)->resize(48, 48)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');

            $image = $request->file('favicon');
            $filename = 'favicon-144x144.png';
            Image::make($image)->resize(144, 144)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');

            $image = $request->file('favicon');
            $filename = 'favicon-192x192.png';
            Image::make($image)->resize(192, 192)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');

            $image = $request->file('favicon');
            $filename = 'favicon-512x512.png';
            Image::make($image)->resize(512, 512)->save(base_path('/assets/img/favicons/' . $filename), 100, 'png');
        }

        if ($request->hasFile('logo')) {
            $setting = Setting::where('key', 'storeLogo')->first();
            $image = $request->file('logo');
            $filename = 'logo' . '.png';
            $smallFile = 'logo-sm' . '.png';
            Image::make($image)->resize(320, 108)->save(base_path('/assets/img/logos/' . $filename), 100, 'png');
            Image::make($image)->resize(120, 41)->save(base_path('/assets/img/logos/' . $smallFile), 100, 'png');
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();
        }

        if ($request->hasFile('splashLogo')) {
            $setting = Setting::where('key', 'splashLogo')->first();
            $image = $request->file('splashLogo');
            $filename = 'splash.jpg';
            Image::make($image)->resize(480, 853)->encode('jpg', 65)->save(base_path('/assets/img/splash/' . $filename));
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();
        }

        if ($request->hasFile('seoOgImage')) {
            $setting = Setting::where('key', 'seoOgImage')->first();
            $image = $request->file('seoOgImage');
            $filename = 'ogimage.png';
            Image::make($image)->resize(1200, 630)->encode('png', 65)->save(base_path('/assets/img/social/' . $filename));
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();
        }

        if ($request->hasFile('seoTwitterImage')) {
            $setting = Setting::where('key', 'seoTwitterImage')->first();
            $image = $request->file('seoTwitterImage');
            $filename = 'twitterimage.png';
            Image::make($image)->resize(600, 335)->encode('png', 65)->save(base_path('/assets/img/social/' . $filename));
            $setting->value = $filename . '?v=' . time() . str_random(5);
            $setting->save();
        }

        if ($request->hasFile('firstScreenHeroImage')) {
            $setting = Setting::where('key', 'firstScreenHeroImage')->first();
            $image = $request->file('firstScreenHeroImage');
            $random = str_random(10);
            $filename = time() . $random . '.' . strtolower($image->getClientOriginalExtension());
            $filenameSm = time() . $random . '-sm.' . strtolower($image->getClientOriginalExtension());
            Image::make($image)->resize(592, 640)->save(base_path('/assets/img/various/' . $filename));
            Image::make($image)->resize(75, 81)->save(base_path('/assets/img/various/' . $filenameSm));
            $setting->value = 'assets/img/various/' . $filename . '?v=' . time() . str_random(5);
            $setting->save();
            $setting = Setting::where('key', 'firstScreenHeroImageSm')->first();
            $setting->value = 'assets/img/various/' . $filenameSm . '?v=' . time() . str_random(5);
            $setting->save();
        }

        //checkboxes settings (true/false)
        $checkboxesSettings = ['showPromoSlider', 'showMap', 'enablePushNotification', 'enablePushNotificationOrders', 'showGdpr', 'enableGoogleAnalytics', 'taxApplicable', 'enSOV', 'enSPU', 'enableFacebookLogin', 'enableGoogleLogin', 'enableDeliveryPin', 'hidePriceWhenZero', 'enableDeliveryGuyEarning', 'enPassResetEmail', 'showPercentageDiscount', 'showVegNonVegBadge', 'showFromNowDate', 'enDelChrRnd', 'expandAllItemMenu', 'smsRestaurantNotify', 'smsRestOrderValue', 'smsDeliveryNotify', 'smsOrderNotify', 'showOrderAddonsDelivery', 'showDeliveryFullAddressOnList', 'showUserInfoBeforePickup', 'recommendedLayoutV2', 'flatApartmentAddressRequired', 'showInActiveItemsToo', 'enGDMA', 'showPriceAndOrderCommentsDelivery', 'useSimpleSpinner', 'randomizeStores', 'showCouponDescriptionOnSuccess', 'stripeAcceptAliPay', 'stripeAcceptBitCoin', 'enIOSPWAPopup', 'mockSearchOnHomepage', 'stripeInlineCardCheckout', 'stripeAcceptIdealPayment', 'stripeAcceptFpxPayment', 'stripeCheckoutPostalCode', 'googleFullAddress', 'showDeliveryCollection', 'allowPaymentGatewaySelection', 'sortSelfpickupStoresByDistance', 'countQuantityAsTotalItemsOnCart', 'allowPaymentGatewaySelection', 'showTipsPercentage', 'showTipsAmount', 'showTryItOnPhone', 'showAddonPricesOnCart', 'showCustomerVatNumber', 'showPwaInstallPromptFooter', 'showCashChange', 'sortDeliveryStoresByDistance'];

        foreach ($checkboxesSettings as $checkboxSetting) {
            $setting = Setting::where('key', $checkboxSetting)->first();
            if ($request->$checkboxSetting == 'true') {
                $setting->value = 'true';
                $setting->save();
            } else {
                $setting->value = 'false';
                $setting->save();
            }
        }

        if ($request->enDevMode == 'true') {
            $env = DotenvEditor::load();
            $env->setKey('APP_ENV', 'local');
            $env->setKey('APP_DEBUG', 'true');
            $env->save();
            $setting = Setting::where('key', 'enDevMode')->first();
            $setting->value = 'true';
            $setting->save();
        } else {
            $env = DotenvEditor::load();
            $env->setKey('APP_ENV', 'production');
            $env->setKey('APP_DEBUG', 'false');
            $env->save();
            $setting = Setting::where('key', 'enDevMode')->first();
            $setting->value = 'false';
            $setting->save();
        }

        $env = DotenvEditor::load();
        $env->setKey('APP_TIMEZONE', $request->timezone);
        $env->setKey('GOOGLE_MAPS_GEOCODING_API_KEY', $request->googleApiKeyIP);
        $env->setKey('SENDGRID_API_KEY', $request->sendgrid_api_key);

        $env->setKey('MAIL_DRIVER', $request->defaultEmailGateway);
        $env->setKey('MAIL_HOST', $request->mail_host);
        $env->setKey('MAIL_PORT', $request->mail_port);
        $env->setKey('MAIL_USERNAME', $request->mail_username);
        $env->setKey('MAIL_PASSWORD', $request->mail_password);
        $env->setKey('MAIL_ENCRYPTION', $request->mail_encryption);

        $env->setKey('PAYTM_ENVIRONMENT', $request->paytm_environment);
        $env->setKey('PAYTM_MERCHANT_ID', $request->paytm_merchant_id);
        $env->setKey('PAYTM_MERCHANT_KEY', $request->paytm_merchant_key);
        $env->setKey('PAYTM_MERCHANT_WEBSITE', $request->paytm_merchant_website);
        $env->setKey('PAYTM_CHANNEL', $request->paytm_channel);
        $env->setKey('PAYTM_INDUSTRY_TYPE', $request->paytm_industry_type);

        $env->setKey('ONESIGNAL_APP_ID', $request->oneSignalAppId);
        $env->setKey('ONESIGNAL_REST_API_KEY', $request->oneSignalRestApiKey);

        $env->save();

        $cache->forget('settings'); //reset cache

        //reset setting cache for frontend
        $versionJson = File::get(base_path('version.json'));
        $versionJson = json_decode($versionJson);
        $fileData = [
            'forceNewSettingsVersion' => strtolower(str_random(30)),
            'forceCacheClearVersion' => $versionJson->forceCacheClearVersion,
        ];
        File::put(base_path('version.json'), json_encode($fileData));

        // $manifestFile = File::exists(base_path('manifest.json'));
        // if ($manifestFile) {
        //     $manifestFileContents = File::get(base_path('manifest.json'));
        //     $manifestFileContents = json_decode($manifestFileContents, true);
        //     $manifestFileContents['short_name'] = $request->storeName;
        //     $manifestFileContents['name'] = $request->storeName;
        //     $json_object = json_encode($manifestFileContents, JSON_UNESCAPED_SLASHES);
        //     File::put(base_path('manifest.json'), json_encode($json_object));
        // }

        Artisan::call('cache:clear');
        Artisan::call('view:clear');

        return redirect(route('admin.settings') . $request->window_redirect_hash)->with(['success' => 'Settings saved successfully.']);
    }

    /**
     * @param Key
     * Get setting by key name
     */
    public function getSettingByKey($key)
    {
        return Setting::where('key', $key)->first();
    }

    /**
     * @param Request $request
     */
    public function forceClear(Request $request)
    {
        Artisan::call('cache:clear');

        $versionJson = File::get(base_path('version.json'));
        $versionJson = json_decode($versionJson);

        switch ($request->type) {

            case 'CACHE':
                $fileData = [
                    'forceNewSettingsVersion' => $versionJson->forceNewSettingsVersion,
                    'forceCacheClearVersion' => strtolower(str_random(30)),
                ];

                File::put(base_path('version.json'), json_encode($fileData));

                $response = [
                    'success' => true,
                    'newVersion' => json_decode($versionJson = File::get(base_path('version.json'))),
                ];
                return response()->json($response);
                break;

            case 'SETTINGS':
                $fileData = [
                    'forceNewSettingsVersion' => strtolower(str_random(30)),
                    'forceCacheClearVersion' => $versionJson->forceCacheClearVersion,
                ];

                File::put(base_path('version.json'), json_encode($fileData));

                $response = [
                    'success' => true,
                    'newVersion' => json_decode($versionJson = File::get(base_path('version.json'))),
                ];
                return response()->json($response);
            default:
                $response = [
                    'success' => false,
                ];
                return response()->json($response, 400);
                break;
        }
    }

    /**
     * @param Request $request
     */
    public function sendTestmail(Request $request)
    {
        // sleep(5);
        try {
            $data = [
                'email' => $request->email,
            ];
            Mail::send('emails.testEmail', $data, function ($message) use ($data) {
                $message->subject('Test Email from Foodomaa');
                $message->from(config('appSettings.sendEmailFromEmailAddress'));
                $message->to($data['email']);
            });

            $response = [
                'success' => true,
            ];
            return response()->json($response);
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
            return response()->json($response, 401);
        }
    }

    /**
     * @param Request $request
     */
    public function cleanEverything(Request $request)
    {
        //clear all db

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('users')->where('id', '<>', '1')->delete();
            DB::update('ALTER TABLE users AUTO_INCREMENT = 2;');

            DB::table('transactions')->truncate();

            DB::table('sms_otps')->truncate();
            DB::table('slides')->truncate();
            DB::table('restaurant_user')->truncate();
            DB::table('restaurant_payouts')->truncate();
            DB::table('restaurant_earnings')->truncate();
            DB::table('restaurant_category_sliders')->truncate();
            DB::table('restaurant_category_restaurant')->truncate();
            DB::table('restaurant_categories')->truncate();
            DB::table('restaurants')->truncate();
            DB::table('ratings')->truncate();
            DB::table('push_tokens')->truncate();
            DB::table('promo_sliders')->truncate();
            DB::table('password_reset_otps')->truncate();
            DB::table('order_item_addons')->truncate();
            DB::table('orders')->truncate();
            DB::table('orderitems')->truncate();

            DB::table('model_has_roles')->where('model_id', '<>', '1')->delete();
            DB::update('ALTER TABLE model_has_roles AUTO_INCREMENT = 2;');

            DB::table('locations')->truncate();
            DB::table('item_categories')->truncate();
            DB::table('items')->truncate();
            DB::table('delivery_guy_details')->truncate();
            DB::table('delivery_collection_logs')->truncate();
            DB::table('delivery_collections')->truncate();
            DB::table('alerts')->truncate();
            DB::table('addresses')->truncate();
            DB::table('addon_category_item')->truncate();
            DB::table('addon_categories')->truncate();
            DB::table('addons')->truncate();
            DB::table('accept_deliveries')->truncate();
            DB::table('wallets')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json(['success' => true], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 401);
        }

    }
}
