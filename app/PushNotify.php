<?php

namespace App;

use App\Alert;
use App\Orderstatus;
use App\PushToken;
use App\Translation;
use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;

class PushNotify
{
    /**
     * @param $orderstatus_id
     * @param $user_id
     */
    public function sendPushNotification($orderstatus_id, $user_id, $unique_order_id = null)
    {

        //check if admin has set a default translation?
        $translation = Translation::where('is_default', 1)->first();
        if ($translation) {
            //if yes, then take the default translation and use instread of translations from config
            $translation = json_decode($translation->data);

            $runningOrderPreparingTitle = $translation->runningOrderPreparingTitle;
            $runningOrderPreparingSub = $translation->runningOrderPreparingSub;
            $runningOrderDeliveryAssignedTitle = $translation->runningOrderDeliveryAssignedTitle;
            $runningOrderDeliveryAssignedSub = $translation->runningOrderDeliveryAssignedSub;
            $runningOrderOnwayTitle = $translation->runningOrderOnwayTitle;
            $runningOrderOnwaySub = $translation->runningOrderOnwaySub;
            $runningOrderDelivered = !empty($translation->runningOrderDelivered) ? $translation->runningOrderDelivered : config('appSettings.runningOrderDelivered');
            $runningOrderDeliveredSub = !empty($translation->runningOrderDeliveredSub) ? $translation->runningOrderDeliveredSub : config('appSettings.runningOrderDeliveredSub');
            $runningOrderCanceledTitle = $translation->runningOrderCanceledTitle;
            $runningOrderCanceledSub = $translation->runningOrderCanceledSub;
            $runningOrderReadyForPickup = $translation->runningOrderReadyForPickup;
            $runningOrderReadyForPickupSub = $translation->runningOrderReadyForPickupSub;
            $deliveryGuyNewOrderNotificationMsg = $translation->deliveryGuyNewOrderNotificationMsg;
            $deliveryGuyNewOrderNotificationMsgSub = $translation->deliveryGuyNewOrderNotificationMsgSub;

        } else {
            //else use from config
            $runningOrderPreparingTitle = config('appSettings.runningOrderPreparingTitle');
            $runningOrderPreparingSub = config('appSettings.runningOrderPreparingSub');
            $runningOrderDeliveryAssignedTitle = config('appSettings.runningOrderDeliveryAssignedTitle');
            $runningOrderDeliveryAssignedSub = config('appSettings.runningOrderDeliveryAssignedSub');
            $runningOrderOnwayTitle = config('appSettings.runningOrderOnwayTitle');
            $runningOrderOnwaySub = config('appSettings.runningOrderOnwaySub');
            $runningOrderDelivered = config('appSettings.runningOrderDelivered');
            $runningOrderDeliveredSub = config('appSettings.runningOrderDeliveredSub');
            $runningOrderCanceledTitle = config('appSettings.runningOrderCanceledTitle');
            $runningOrderCanceledSub = config('appSettings.runningOrderCanceledSub');
            $runningOrderReadyForPickup = config('appSettings.runningOrderReadyForPickup');
            $runningOrderReadyForPickupSub = config('appSettings.runningOrderReadyForPickupSub');
            $deliveryGuyNewOrderNotificationMsg = config('appSettings.deliveryGuyNewOrderNotificationMsg');
            $deliveryGuyNewOrderNotificationMsgSub = config('appSettings.deliveryGuyNewOrderNotificationMsgSub');
        }

        $secretKey = 'key=' . config('appSettings.firebaseSecret');

        $token = PushToken::where('user_id', $user_id)->first();

        if ($token) {
            if ($orderstatus_id == '2') {
                $msgTitle = $runningOrderPreparingTitle;
                $msgMessage = $runningOrderPreparingSub;
                $click_action = config('appSettings.storeUrl') . '/running-order/' . $unique_order_id;
            }
            if ($orderstatus_id == '3') {
                $msgTitle = $runningOrderDeliveryAssignedTitle;
                $msgMessage = $runningOrderDeliveryAssignedSub;
                $click_action = config('appSettings.storeUrl') . '/running-order/' . $unique_order_id;
            }
            if ($orderstatus_id == '4') {
                $msgTitle = $runningOrderOnwayTitle;
                $msgMessage = $runningOrderOnwaySub;
                $click_action = config('appSettings.storeUrl') . '/running-order/' . $unique_order_id;
            }
            if ($orderstatus_id == '5') {
                $msgTitle = $runningOrderDelivered;
                $msgMessage = $runningOrderDeliveredSub;
                $click_action = config('appSettings.storeUrl') . '/my-orders/';
            }
            if ($orderstatus_id == '6') {
                $msgTitle = $runningOrderCanceledTitle;
                $msgMessage = $runningOrderCanceledSub;
                $click_action = config('appSettings.storeUrl') . '/my-orders/';
            }
            if ($orderstatus_id == '7') {
                $msgTitle = $runningOrderReadyForPickup;
                $msgMessage = $runningOrderReadyForPickupSub;
                $click_action = config('appSettings.storeUrl') . '/running-order/' . $unique_order_id;
            }
            if ($orderstatus_id == 'TO_RESTAURANT') {
                $msgTitle = $restaurantNewOrderNotificationMsg;
                $msgMessage = $restaurantNewOrderNotificationMsgSub;
                $click_action = config('appSettings.storeUrl') . '/public/restaurant-owner/dashboard';
            }
            if ($orderstatus_id == 'TO_DELIVERY') {
                $msgTitle = $deliveryGuyNewOrderNotificationMsg;
                $msgMessage = $deliveryGuyNewOrderNotificationMsgSub;
                $click_action = config('appSettings.storeUrl') . '/delivery/orders/' . $unique_order_id;
            }
            $msg = array(
                'title' => $msgTitle,
                'message' => $msgMessage,
                'badge' => '/assets/img/favicons/favicon-96x96.png',
                'icon' => '/assets/img/favicons/favicon-512x512.png',
                'click_action' => $click_action,
                'unique_order_id' => $unique_order_id,
            );

            $alert = new Alert();
            $alert->data = json_encode($msg);
            $alert->user_id = $user_id;
            $alert->is_read = 0;
            $alert->save();

            $fullData = array(
                'to' => $token->token,
                'data' => $msg,
            );

            $response = Curl::to('https://fcm.googleapis.com/fcm/send')
                ->withHeader('Content-Type: application/json')
                ->withHeader("Authorization: $secretKey")
                ->withData(json_encode($fullData))
                ->post();
        }
    }

    /**
     * @param $user_id
     * @param $amount
     * @param $message
     * @param $type
     */
    public function sendWalletAlert($user_id, $amount, $message, $type)
    {

        $amountWithCurrency = config('appSettings.currencySymbolAlign') == 'left' ? config('appSettings.currencyFormat') . $amount : $amount . config('appSettings.currencyFormat');

        $msg = array(
            'title' => config('appSettings.walletName'),
            'message' => $amountWithCurrency . ' ' . $message,
            'is_wallet_alert' => true,
            'transaction_type' => $type,
        );

        $alert = new Alert();
        $alert->data = json_encode($msg);
        $alert->user_id = $user_id;
        $alert->is_read = 0;
        $alert->save();

    }

}
