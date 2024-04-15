<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Coupon;
use App\Helpers\TranslationHelper;
use App\Item;
use App\Order;
use App\Orderitem;
use App\OrderItemAddon;
use App\Orderstatus;
use App\PushNotify;
use App\Restaurant;
use App\Sms;
use App\User;
use DotenvEditor;
use Hashids;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Omnipay\Omnipay;
use OneSignal;

class OrderController extends Controller
{
    /**
     * @param Request $request
     */
    public function placeOrder(Request $request, TranslationHelper $translationHelper)
    {
        $user = auth()->user();

        if ($user) {
            $keys = ['orderPaymentWalletComment', 'orderPartialPaymentWalletComment'];
            $translationData = $translationHelper->getDefaultLanguageValuesForKeys($keys);

            $newOrder = new Order();

            $checkingIfEmpty = Order::count();

            $lastOrder = Order::orderBy('id', 'desc')->first();

            if ($lastOrder) {
                $lastOrderId = $lastOrder->id;
                $newId = $lastOrderId + 1;
                $uniqueId = Hashids::encode($newId);
            } else {
                //first order
                $newId = 1;
            }

            $uniqueId = Hashids::encode($newId);
            $unique_order_id = 'OD' . '-' . date('m-d') . '-' . strtoupper(str_random(4)) . '-' . strtoupper($uniqueId);
            $newOrder->unique_order_id = $unique_order_id;

            $restaurant_id = $request['order'][0]['restaurant_id'];
            $restaurant = Restaurant::where('id', $restaurant_id)->first();

            $newOrder->user_id = $user->id;

            if ($request['pending_payment'] || $request['method'] == 'MERCADOPAGO' || $request['method'] == 'PAYTM') {
                $newOrder->orderstatus_id = '8';
            } elseif ($restaurant->auto_acceptable) {
                $newOrder->orderstatus_id = '2';
                if ($request->delivery_type == 1) {
                    $this->smsToDelivery($restaurant_id);
                }
                if (config('appSettings.enablePushNotificationOrders') == 'true') {
                    //to user
                    $notify = new PushNotify();
                    $notify->sendPushNotification('2', $newOrder->user_id, $newOrder->unique_order_id);
                }
            } else {
                $newOrder->orderstatus_id = '1';
            }

            $newOrder->location = json_encode($request['location']);

            $full_address = $request['user']['data']['default_address']['house'] . ', ' . $request['user']['data']['default_address']['address'];
            $newOrder->address = $full_address;

            //get restaurant charges
            $newOrder->restaurant_charge = $restaurant->restaurant_charges;

            $newOrder->transaction_id = $request->payment_token;

            $orderTotal = 0;
            foreach ($request['order'] as $oI) {
                $originalItem = Item::where('id', $oI['id'])->first();
                $orderTotal += ($originalItem->price * $oI['quantity']);

                if (isset($oI['selectedaddons'])) {
                    foreach ($oI['selectedaddons'] as $selectedaddon) {
                        $addon = Addon::where('id', $selectedaddon['addon_id'])->first();
                        if ($addon) {
                            $orderTotal += $addon->price * $oI['quantity'];
                        }
                    }
                }
            }
            $newOrder->sub_total = $orderTotal;

            if ($request->coupon) {
                $coupon = Coupon::where('code', strtoupper($request['coupon']['code']))->first();
                if ($coupon) {
                    $newOrder->coupon_name = $request['coupon']['code'];
                    if ($coupon->discount_type == 'PERCENTAGE') {
                        $percentage_discount = (($coupon->discount / 100) * $orderTotal);
                        if ($coupon->max_discount) {
                            if ($percentage_discount >= $coupon->max_discount) {
                                $percentage_discount = $coupon->max_discount;
                            }
                        }
                        $newOrder->coupon_amount = $percentage_discount;
                        $orderTotal = $orderTotal - $percentage_discount;
                    }
                    if ($coupon->discount_type == 'AMOUNT') {
                        $newOrder->coupon_amount = $coupon->discount;
                        $orderTotal = $orderTotal - $coupon->discount;
                    }
                    $coupon->count = $coupon->count + 1;
                    $coupon->save();
                }
            }

            if ($request->delivery_type == 1) {
                if ($restaurant->delivery_charge_type == 'DYNAMIC') {
                    //get distance between user and restaurant,
                    if (config('appSettings.enGDMA') == 'true') {
                        $distance = (float) $request->dis;
                    } else {
                        $distance = $this->getDistance($request['user']['data']['default_address']['latitude'], $request['user']['data']['default_address']['longitude'], $restaurant->latitude, $restaurant->longitude);
                    }

                    if ($distance > $restaurant->base_delivery_distance) {
                        $extraDistance = $distance - $restaurant->base_delivery_distance;
                        $extraCharge = ($extraDistance / $restaurant->extra_delivery_distance) * $restaurant->extra_delivery_charge;
                        $dynamicDeliveryCharge = $restaurant->base_delivery_charge + $extraCharge;

                        if (config('appSettings.enDelChrRnd') == 'true') {
                            $dynamicDeliveryCharge = ceil($dynamicDeliveryCharge);
                        }

                        $newOrder->delivery_charge = $dynamicDeliveryCharge;
                        $orderTotal = $orderTotal + $dynamicDeliveryCharge;
                    } else {
                        $newOrder->delivery_charge = $restaurant->base_delivery_charge;
                        $orderTotal = $orderTotal + $restaurant->base_delivery_charge;
                    }

                } else {
                    $newOrder->delivery_charge = $restaurant->delivery_charges;
                    $orderTotal = $orderTotal + $restaurant->delivery_charges;
                }

            } else {
                $newOrder->delivery_charge = 0;
            }

            $orderTotal = $orderTotal + $restaurant->restaurant_charges;

            if (config('appSettings.taxApplicable') == 'true') {
                $newOrder->tax = config('appSettings.taxPercentage');

                $taxAmount = (float) (((float) config('appSettings.taxPercentage') / 100) * $orderTotal);
            } else {
                $taxAmount = 0;
            }

            $newOrder->tax_amount = $taxAmount;

            $orderTotal = $orderTotal + $taxAmount;

            if (isset($request['tipAmount']) && !empty($request['tipAmount'])) {
                $orderTotal = $orderTotal + $request['tipAmount'];
            }

            //this is the final order total

            if ($request['method'] == 'COD') {
                if ($request->partial_wallet == true) {
                    //deduct all user amount and add
                    $newOrder->payable = $orderTotal - $user->balanceFloat;
                }
                if ($request->partial_wallet == false) {
                    $newOrder->payable = $orderTotal;
                }
            }

            $newOrder->total = $orderTotal;

            $newOrder->order_comment = $request['order_comment'];

            $newOrder->payment_mode = $request['method'];

            $newOrder->restaurant_id = $request['order'][0]['restaurant_id'];

            $newOrder->tip_amount = $request['tipAmount'];

            if ($request->delivery_type == 1) {
                //delivery
                $newOrder->delivery_type = 1;
            } else {
                //selfpickup
                $newOrder->delivery_type = 2;
            }

            $newOrder->cash_change_amount = $request['cash_change_amount'] ? $request['cash_change_amount'] : null;

            $user->delivery_pin = substr(str_shuffle('123456789'), 0, 5);
            $user->save();
            //process paypal payment
            if ($request['method'] == 'PAYPAL' || $request['method'] == 'PAYSTACK' || $request['method'] == 'RAZORPAY' || $request['method'] == 'STRIPE' || $request['method'] == 'PAYMONGO' || $request['method'] == 'MERCADOPAGO' || $request['method'] == 'PAYTM' || $request['method'] == 'FLUTTERWAVE' || $request['method'] == 'KHALTI') {
                //successfuly received payment
                $newOrder->save();
                if ($request->partial_wallet == true) {

                    $userWalletBalance = $user->balanceFloat;
                    $newOrder->wallet_amount = $userWalletBalance;
                    $newOrder->save();
                    //deduct all user amount and add
                    $user->withdraw($userWalletBalance * 100, ['description' => $translationData->orderPartialPaymentWalletComment . $newOrder->unique_order_id]);
                }
                foreach ($request['order'] as $orderItem) {
                    $item = new Orderitem();
                    $item->order_id = $newOrder->id;
                    $item->item_id = $orderItem['id'];
                    $item->name = $orderItem['name'];
                    $item->quantity = $orderItem['quantity'];
                    $item->price = $orderItem['price'];
                    $item->save();
                    if (isset($orderItem['selectedaddons'])) {
                        foreach ($orderItem['selectedaddons'] as $selectedaddon) {
                            $addon = new OrderItemAddon();
                            $addon->orderitem_id = $item->id;
                            $addon->addon_category_name = $selectedaddon['addon_category_name'];
                            $addon->addon_name = $selectedaddon['addon_name'];
                            $addon->addon_price = $selectedaddon['price'];
                            $addon->save();
                        }
                    }
                }

                $response = [
                    'success' => true,
                    'data' => $newOrder,
                ];

                // Send SMS to restaurant owner only if not configured for auto acceptance, and order staus ID is 1 and sms notify is On by Admin
                if (!$restaurant->auto_acceptable && $newOrder->orderstatus_id == '1' && config('appSettings.smsRestaurantNotify') == 'true') {

                    $restaurant_id = $request['order'][0]['restaurant_id'];
                    $this->smsToRestaurant($restaurant_id, $orderTotal);
                }
                // END SMS

                if ($restaurant->auto_acceptable && config('appSettings.enablePushNotification') && config('appSettings.enablePushNotificationOrders') == 'true') {

                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $restaurant->id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            if ($pU->delivery_guy_detail->status) {
                                if ($newOrder->delivery_type == 1) {
                                    //send Notification to Delivery Guy
                                    $notify = new PushNotify();
                                    $notify->sendPushNotification('TO_DELIVERY', $pU->id, $newOrder->unique_order_id);
                                }
                            }
                        }
                    }

                }

                /* OneSignal Push Notification to Store Owner */
                if ($newOrder->orderstatus_id == '1' && config('appSettings.oneSignalAppId') != null && config('appSettings.oneSignalRestApiKey') != null) {
                    $this->sendPushNotificationStoreOwner($restaurant_id, $unique_order_id);
                }
                /* END OneSignal Push Notification to Store Owner */

                return response()->json($response);
            }
            //if new payment gateway is added, write elseif here
            else {
                $newOrder->save();
                if ($request['method'] == 'COD') {
                    if ($request->partial_wallet == true) {
                        $userWalletBalance = $user->balanceFloat;
                        $newOrder->wallet_amount = $userWalletBalance;
                        $newOrder->save();
                        //deduct all user amount and add
                        $user->withdraw($userWalletBalance * 100, ['description' => $translationData->orderPartialPaymentWalletComment . $newOrder->unique_order_id]);
                    }
                }

                //if method is WALLET, then deduct amount with appropriate description
                if ($request['method'] == 'WALLET') {
                    $userWalletBalance = $user->balanceFloat;
                    $newOrder->wallet_amount = $orderTotal;
                    $newOrder->save();
                    $user->withdraw($orderTotal * 100, ['description' => $translationData->orderPaymentWalletComment . $newOrder->unique_order_id]);
                }

                foreach ($request['order'] as $orderItem) {
                    $item = new Orderitem();
                    $item->order_id = $newOrder->id;
                    $item->item_id = $orderItem['id'];
                    $item->name = $orderItem['name'];
                    $item->quantity = $orderItem['quantity'];
                    $item->price = $orderItem['price'];
                    $item->save();
                    if (isset($orderItem['selectedaddons'])) {
                        foreach ($orderItem['selectedaddons'] as $selectedaddon) {
                            $addon = new OrderItemAddon();
                            $addon->orderitem_id = $item->id;
                            $addon->addon_category_name = $selectedaddon['addon_category_name'];
                            $addon->addon_name = $selectedaddon['addon_name'];
                            $addon->addon_price = $selectedaddon['price'];
                            $addon->save();
                        }
                    }
                }

                $response = [
                    'success' => true,
                    'data' => $newOrder,
                ];

                // Send SMS
                if (!$restaurant->auto_acceptable && $newOrder->orderstatus_id == '1' && config('appSettings.smsRestaurantNotify') == 'true') {

                    $restaurant_id = $request['order'][0]['restaurant_id'];
                    $this->smsToRestaurant($restaurant_id, $orderTotal);
                }
                // END SMS

                if ($restaurant->auto_acceptable && config('appSettings.enablePushNotification') && config('appSettings.enablePushNotificationOrders') == 'true') {
                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $restaurant->id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            if ($pU->delivery_guy_detail->status) {
                                if ($newOrder->delivery_type == 1) {
                                    //send Notification to Delivery Guy
                                    $notify = new PushNotify();
                                    $notify->sendPushNotification('TO_DELIVERY', $pU->id, $newOrder->unique_order_id);
                                }
                            }
                        }
                    }

                }

                /* OneSignal Push Notification to Store Owner */
                if ($newOrder->orderstatus_id == '1' && config('appSettings.oneSignalAppId') != null && config('appSettings.oneSignalRestApiKey') != null) {
                    $this->sendPushNotificationStoreOwner($restaurant_id, $unique_order_id);
                }
                /* END OneSignal Push Notification to Store Owner */

                return response()->json($response);
            }

        }
    }

    /**
     * @param Request $request
     */
    public function getOrders(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $orders = Order::where('user_id', $user->id)->with('orderitems', 'orderitems.order_item_addons', 'restaurant', 'rating')->orderBy('id', 'DESC')->paginate(10);

            foreach ($orders as $order) {
                $ratable = false;
                if ($order->orderstatus_id == 5 && !$order->rating) {
                    $ratable = true;
                }
                $order->is_ratable = $ratable;
                $order->makeHidden(['reviews']);
            }

            return response()->json($orders);
        }
        return response()->json(['success' => false], 401);
    }

    /**
     * @param Request $request
     */
    public function getOrderItems(Request $request)
    {
        $user = auth()->user();
        if ($user) {

            $items = Orderitem::where('order_id', $request->order_id)->get();
            return response()->json($items);
        }
        return response()->json(['success' => false], 401);

    }

    /**
     * @param Request $request
     */
    public function cancelOrder(Request $request, TranslationHelper $translationHelper)
    {

        $keys = ['orderRefundWalletComment', 'orderPartialRefundWalletComment'];

        $translationData = $translationHelper->getDefaultLanguageValuesForKeys($keys);

        $order = Order::where('id', $request->order_id)->first();

        $user = auth()->user();

        //check if user is cancelling their own order...
        if ($order->user_id == $user->id && $order->orderstatus_id == 1) {

            //if payment method is not COD, and order status is 1 (Order placed) then refund to wallet
            $refund = false;

            //if COD, then check if wallet is present
            if ($order->payment_mode == 'COD') {
                if ($order->wallet_amount != null) {
                    //refund wallet amount
                    $user->deposit($order->wallet_amount * 100, ['description' => $translationData->orderPartialRefundWalletComment . $order->unique_order_id]);
                    $refund = true;
                }
            } else {
                //if online payment, refund the total to wallet
                $user->deposit(($order->total) * 100, ['description' => $translationData->orderRefundWalletComment . $order->unique_order_id]);
                $refund = true;
            }

            //cancel order
            $order->orderstatus_id = 6; //6 means canceled..
            $order->save();

            //throw notification to user
            if (config('appSettings.enablePushNotificationOrders') == 'true') {
                $notify = new PushNotify();
                $notify->sendPushNotification('6', $order->user_id);
            }

            $response = [
                'success' => true,
                'refund' => $refund,
            ];

            return response()->json($response);

        } else {
            $response = [
                'success' => false,
                'refund' => false,
            ];
            return response()->json($response);
        }

    }

    /**
     * @param $latitudeFrom
     * @param $longitudeFrom
     * @param $latitudeTo
     * @param $longitudeTo
     * @return mixed
     */
    private function getDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * 6371;
    }

    /**
     * @param $restaurant_id
     * @param $orderTotal
     */
    private function smsToRestaurant($restaurant_id, $orderTotal)
    {
        //get restaurant
        $restaurant = Restaurant::where('id', $restaurant_id)->first();
        if ($restaurant) {
            if ($restaurant->is_notifiable) {
                //get all pivot users of restaurant (Store Ownerowners)
                $pivotUsers = $restaurant->users()
                    ->wherePivot('restaurant_id', $restaurant_id)
                    ->get();
                //filter only res owner and send notification.
                foreach ($pivotUsers as $pU) {
                    if ($pU->hasRole('Store Owner')) {
                        // Include Order orderTotal or not ?
                        switch (config('appSettings.smsRestOrderValue')) {
                            case 'true':
                                $message = config('appSettings.defaultSmsRestaurantMsg') . round($orderTotal);
                                break;
                            case 'false':
                                $message = config('appSettings.defaultSmsRestaurantMsg');
                                break;
                        }
                        // As its not an OTP based message Nulling OTP
                        $otp = null;
                        $smsnotify = new Sms();
                        $smsnotify->processSmsAction('OD_NOTIFY', $pU->phone, $otp, $message);
                    }
                }
            }
        }
    }

    /**
     * @param $restaurant_id
     */
    private function smsToDelivery($restaurant_id)
    {
        //get restaurant
        $restaurant = Restaurant::where('id', $restaurant_id)->first();
        if ($restaurant) {
            //get all pivot users of restaurant (Store Ownerowners)
            $pivotUsers = $restaurant->users()
                ->wherePivot('restaurant_id', $restaurant_id)
                ->get();
            //filter only res owner and send notification.
            foreach ($pivotUsers as $pU) {
                if ($pU->hasRole('Delivery Guy')) {
                    if ($pU->delivery_guy_detail->is_notifiable && $pU->delivery_guy_detail->status) {
                        $message = config('appSettings.defaultSmsDeliveryMsg');
                        // As its not an OTP based message Nulling OTP
                        $otp = null;
                        $smsForDelivery = true;
                        $smsnotify = new Sms();
                        $smsnotify->processSmsAction('OD_NOTIFY', $pU->phone, $otp, $message, $smsForDelivery);
                    }
                }
            }
        }
    }

    /**
     * @param $restaurant_id
     */
    private function sendPushNotificationStoreOwner($restaurant_id, $unique_order_id)
    {
        if (config('appSettings.oneSignalAppId') != null && config('appSettings.oneSignalRestApiKey') != null) {
            $restaurant = Restaurant::where('id', $restaurant_id)->first();
            if ($restaurant) {
                //get all pivot users of restaurant (Store Ownerowners)
                $pivotUsers = $restaurant->users()
                    ->wherePivot('restaurant_id', $restaurant_id)
                    ->get();

                //filter only res owner and send notification.
                foreach ($pivotUsers as $pU) {
                    if ($pU->hasRole('Store Owner')) {

                        $message = config('appSettings.restaurantNewOrderNotificationMsg');

                        $url = config('appSettings.storeUrl') . '/public/store-owner/order/' . $unique_order_id;

                        $userId = (string) $pU->id;

                        $contents = array(
                            'en' => $message,
                        );

                        $appId = DotenvEditor::getValue('ONESIGNAL_APP_ID');
                        $apiKey = DotenvEditor::getValue('ONESIGNAL_REST_API_KEY');

                        $fields = array(
                            'app_id' => $appId,
                            'include_external_user_ids' => array($userId),
                            'channel_for_external_user_ids' => 'push',
                            'contents' => $contents,
                            'url' => $url,
                        );

                        $fields = json_encode($fields);

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                            'Authorization: Basic ' . $apiKey));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HEADER, false);
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

                        $response = curl_exec($ch);
                        curl_close($ch);

                    }
                }
            }
        }
    }
};
