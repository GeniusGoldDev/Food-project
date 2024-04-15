<?php

namespace App\Http\Controllers;

use App\AcceptDelivery;
use App\DeliveryCollection;
use App\Helpers\TranslationHelper;
use App\Order;
use App\Orderitem;
use App\PushNotify;
use App\Rating;
use App\RestaurantEarning;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use JWTAuth;
use JWTAuthException;

class DeliveryController extends Controller
{
    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    private function getToken($email, $password)
    {
        $token = null;
        try {
            if (!$token = JWTAuth::attempt(['email' => $email, 'password' => $password])) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'Password or email is invalid..',
                    'token' => $token,
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'Token creation failed',
            ]);
        }
        return $token;
    }

    /**
     * @param Request $request
     */
    public function login(Request $request)
    {
        $user = \App\User::where('email', $request->email)->get()->first();
        if ($user && \Hash::check($request->password, $user->password)) {

            if ($user->hasRole('Delivery Guy')) {
                $token = self::getToken($request->email, $request->password);
                $user->auth_token = $token;
                $user->save();

                $onGoingDeliveriesCount = AcceptDelivery::whereHas('order', function ($query) {
                    $query->whereIn('orderstatus_id', ['3', '4']);
                })->where('user_id', $user->id)->where('is_complete', 0)->count();

                $completedDeliveriesCount = AcceptDelivery::whereHas('order', function ($query) {
                    $query->whereIn('orderstatus_id', ['5']);
                })->where('user_id', $user->id)->where('is_complete', 1)->count();

                $status = $user->delivery_guy_detail->status;

                $response = [
                    'success' => true,
                    'data' => [
                        'id' => $user->id,
                        'auth_token' => $user->auth_token,
                        'name' => $user->name,
                        'email' => $user->email,
                        'wallet_balance' => $user->balanceFloat,
                        'onGoingCount' => $onGoingDeliveriesCount,
                        'completedCount' => $completedDeliveriesCount,
                        'status' => $status,
                    ],
                ];
            } else {
                $response = ['success' => false, 'data' => 'Record doesnt exists'];
            }
        } else {
            $response = ['success' => false, 'data' => 'Record doesnt exists...'];
        }
        return response()->json($response, 201);
    }

    /**
     * @param Request $request
     */
    public function updateDeliveryUserInfo(Request $request)
    {
        $deliveryUser = auth()->user();

        if ($deliveryUser && $deliveryUser->hasRole('Delivery Guy')) {

            $onGoingDeliveriesCount = AcceptDelivery::whereHas('order', function ($query) {
                $query->whereIn('orderstatus_id', ['3', '4']);
            })->where('user_id', $deliveryUser->id)->where('is_complete', 0)->count();

            $completedDeliveriesCount = AcceptDelivery::whereHas('order', function ($query) {
                $query->whereIn('orderstatus_id', ['5']);
            })->where('user_id', $deliveryUser->id)->where('is_complete', 1)->count();

            $orders = AcceptDelivery::whereHas('order', function ($query) {
                $query->whereIn('orderstatus_id', ['3', '4', '5']);
            })->where('user_id', $deliveryUser->id)
                ->with(array('order' => function ($q) {
                    $q->select('id', 'orderstatus_id', 'unique_order_id', 'address', 'payment_mode', 'payable');
                }))->orderBy('created_at', 'DESC')->get();

            $earnings = $deliveryUser->transactions()->orderBy('id', 'DESC')->get();
            $totalEarnings = 0;
            foreach ($deliveryUser->transactions->reverse() as $transaction) {
                if ($transaction->type === 'deposit') {
                    $totalEarnings += $transaction->amount / 100;
                }
            }

            $deliveryCollection = DeliveryCollection::where('user_id', $deliveryUser->id)->first();
            if (!$deliveryCollection) {
                $deliveryCollectionAmount = 0;
            } else {
                $deliveryCollectionAmount = $deliveryCollection->amount;
            }

            $dateRange = Carbon::today()->subDays(7);
            $earningData = DB::table('transactions')
                ->where('payable_id', $deliveryUser->id)
                ->where('created_at', '>=', $dateRange)
                ->where('type', 'deposit')
                ->select(DB::raw('sum(amount) as total'), DB::raw('date(created_at) as dates'))
                ->groupBy('dates')
                ->orderBy('dates', 'desc')
                ->get();

            for ($i = 0; $i <= 6; $i++) {
                if (!isset($earningData[$i])) {
                    $amount[] = 0;
                } else {
                    $amount[] = $earningData[$i]->total / 100;
                }
            }

            for ($i = 0; $i <= 6; $i++) {
                $days[] = Carbon::now()->subDays($i)->format('D');
            }

            foreach ($amount as $amt) {
                $amtArr[] = [
                    'y' => $amt,
                ];
            }
            $amtArr = array_reverse($amtArr);
            foreach ($days as $key => $day) {
                $dayArr[] = [
                    'x' => $day,
                ];
            }
            $dayArr = array_reverse($dayArr);
            $chartData = [];
            for ($i = 0; $i <= 6; $i++) {
                array_push($chartData, ($amtArr[$i] + $dayArr[$i]));
            }

            $ratings = Rating::where('delivery_id', $deliveryUser->id)->select(['rating_delivery', 'review_delivery'])->get();
            $averageRating = number_format((float) $ratings->avg('rating_delivery'), 1, '.', '');

            //if toggle_tatus is present, that means delivery guy is asking to switch the status
            if ($request->has('toggle_status')) {
                $status = $deliveryUser->delivery_guy_detail->status;

                //if force_offline present, always make delivery offline (triggred on logout)
                if ($request->has('force_offline') && $request->force_offline == 'true') {
                    $deliveryUser->delivery_guy_detail->status = false;
                } else {
                    $deliveryUser->delivery_guy_detail->status = !$status;
                }

                $deliveryUser->delivery_guy_detail->save();

            }
            $status = $deliveryUser->delivery_guy_detail->status;

            $response = [
                'success' => true,
                'data' => [
                    'id' => $deliveryUser->id,
                    'auth_token' => $deliveryUser->auth_token,
                    'name' => $deliveryUser->name,
                    'email' => $deliveryUser->email,
                    'wallet_balance' => $deliveryUser->balanceFloat,
                    'onGoingCount' => $onGoingDeliveriesCount,
                    'completedCount' => $completedDeliveriesCount,
                    'orders' => $orders,
                    'earnings' => $earnings,
                    'totalEarnings' => $totalEarnings,
                    'deliveryCollection' => $deliveryCollectionAmount,
                    'averageRating' => $averageRating,
                    'ratings' => $ratings,
                    'status' => $status,
                ],
                'chart' => [
                    'chartData' => $chartData,
                ],
            ];
            return response()->json($response, 201);

        }

        $response = ['success' => false, 'data' => 'Record doesnt exists'];
    }

    /**
     * @param Request $request
     */
    public function getDeliveryOrders(Request $request)
    {

        $deliveryUser = Auth::user();
        $userRestaurants = $deliveryUser->restaurants;

        $deliveryGuyCommissionRate = $deliveryUser->delivery_guy_detail->commission_rate;

        $orders = Order::where('orderstatus_id', '2')
            ->where('delivery_type', '1')
            ->with('restaurant')
            ->orderBy('id', 'DESC')
            ->get();

        $deliveryGuyNewOrders = collect();
        foreach ($orders as $order) {

            $commission = 0;
            if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                $commission = $deliveryGuyCommissionRate / 100 * $order->total;
            }
            if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                $commission = $deliveryGuyCommissionRate / 100 * $order->delivery_charge;
            }
            if ($deliveryUser->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->delivery_guy_detail->tip_commission_rate)) {
                $tip_amount = $deliveryUser->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                $tip_amount = number_format((float) $tip_amount, 2, '.', '');
            } else {
                $tip_amount = null;
            }

            $order->commission = number_format((float) $commission, 2, '.', '');

            $order->tip_amount = $tip_amount;

            foreach ($userRestaurants as $ur) {
                //checking if delivery guy is assigned to that restaurant
                if ($order->restaurant->id == $ur->id) {
                    $deliveryGuyNewOrders->push($order);
                }
            }
        }

        $alreadyAcceptedDeliveries = collect();
        $acceptDeliveries = AcceptDelivery::where('user_id', Auth::user()->id)
            ->where('is_complete', 0)
            ->whereHas('order', function ($q) {
                $q->where('orderstatus_id', '3');
            })
            ->with('order.restaurant')
            ->get();
        foreach ($acceptDeliveries as $ad) {
            // $order = Order::where('id', $ad->order_id)->whereIn('orderstatus_id', ['3'])->with('restaurant')->first();
            $order = $ad->order;
            if ($order) {
                $commission = 0;
                if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->total;
                }
                if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->delivery_charge;
                }
                if ($deliveryUser->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->delivery_guy_detail->tip_commission_rate)) {
                    $tip_amount = $deliveryUser->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                    $tip_amount = number_format((float) $tip_amount, 2, '.', '');
                } else {
                    $tip_amount = null;
                }

                $order->commission = number_format((float) $commission, 2, '.', '');
                $order->tip_amount = $tip_amount;

                $alreadyAcceptedDeliveries->push($order);
            }
        }

        $pickedupOrders = collect();
        $acceptDeliveries = AcceptDelivery::where('user_id', Auth::user()->id)
            ->where('is_complete', 0)
            ->whereHas('order', function ($q) {
                $q->where('orderstatus_id', '4');
            })
            ->with('order.restaurant')
            ->get();
        foreach ($acceptDeliveries as $ad) {
            // $order = Order::where('id', $ad->order_id)->whereIn('orderstatus_id', ['4'])->with('restaurant')->first();
            $order = $ad->order;
            if ($order) {
                $commission = 0;
                if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->total;
                }
                if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->delivery_charge;
                }
                if ($deliveryUser->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->delivery_guy_detail->tip_commission_rate)) {
                    $tip_amount = $deliveryUser->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                    $tip_amount = number_format((float) $tip_amount, 2, '.', '');
                } else {
                    $tip_amount = null;
                }

                $order->commission = number_format((float) $commission, 2, '.', '');
                $order->tip_amount = $tip_amount;

                $pickedupOrders->push($order);
            }
        }

        $response = [
            'new_orders' => $deliveryGuyNewOrders,
            'accepted_orders' => $alreadyAcceptedDeliveries,
            'pickedup_orders' => $pickedupOrders,
        ];

        return response()->json($response);
    }

    /**
     * @param Request $request
     */
    public function getSingleDeliveryOrder(Request $request)
    {
        //find the order
        $singleOrder = Order::where('unique_order_id', $request->unique_order_id)->first();

        //get order id and delivery boy id
        $singleOrderId = $singleOrder->id;
        $deliveryUser = Auth::user();

        $checkOrder = AcceptDelivery::where('order_id', $singleOrderId)
            ->where('user_id', $deliveryUser->id)
            ->first();

        $deliveryGuyCommissionRate = $deliveryUser->delivery_guy_detail->commission_rate;

        $commission = 0;
        if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
            $commission = $deliveryGuyCommissionRate / 100 * $singleOrder->total;
        }
        if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
            $commission = $deliveryGuyCommissionRate / 100 * $singleOrder->delivery_charge;
        }

        if ($deliveryUser->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->delivery_guy_detail->tip_commission_rate)) {
            $tip_amount = $deliveryUser->delivery_guy_detail->tip_commission_rate / 100 * $singleOrder->tip_amount;
            $tip_amount = number_format((float) $tip_amount, 2, '.', '');
        } else {
            $tip_amount = null;
        }

        //check if the loggedin delivery boy has accepted the order
        if ($checkOrder) {
            //this order was already accepted by this delivery boy
            //so send the order to him
            $singleOrder = Order::where('unique_order_id', $request->unique_order_id)
                ->with('restaurant')
                ->with('orderitems.order_item_addons')
                ->with(array('user' => function ($query) {
                    $query->select('id', 'name', 'phone');
                }))
                ->first();

            $singleOrder->commission = number_format((float) $commission, 2, '.', '');

            $singleOrder->tip_amount = $tip_amount;

            // sleep(3);
            return response()->json($singleOrder);
        }

        //else other can view the order
        $singleOrder = Order::where('unique_order_id', $request->unique_order_id)
            ->where('orderstatus_id', 2)
            ->with('restaurant')
            ->with('orderitems.order_item_addons')
            ->with(array('user' => function ($query) {
                $query->select('id', 'name', 'phone');
            }))
            ->first();
        $singleOrder->commission = number_format((float) $commission, 2, '.', '');
        $singleOrder->tip_amount = $tip_amount;
        // sleep(3);
        return response()->json($singleOrder);
    }

    /**
     * @param Request $request
     */
    public function setDeliveryGuyGpsLocation(Request $request)
    {

        $deliveryUser = auth()->user();

        if ($deliveryUser->hasRole('Delivery Guy')) {

            //update the lat, lng and heading of delivery guy
            $deliveryUser->delivery_guy_detail->delivery_lat = $request->delivery_lat;
            $deliveryUser->delivery_guy_detail->delivery_long = $request->delivery_long;
            $deliveryUser->delivery_guy_detail->heading = $request->heading;
            $deliveryUser->delivery_guy_detail->save();

            $success = true;
            return response()->json($success);
        }

    }

    /**
     * @param Request $request
     */
    public function getDeliveryGuyGpsLocation(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();

        if ($order) {
            $deliveryUserId = $order->accept_delivery->user->id;
            $deliveryUser = User::where('id', $deliveryUserId)->first();
            $deliveryUserDetails = $deliveryUser->delivery_guy_detail;
        }

        if ($deliveryUserDetails) {
            return response()->json($deliveryUserDetails);
        }
    }

    /**
     * @param Request $request
     */
    public function acceptToDeliver(Request $request)
    {
        $deliveryUser = auth()->user();

        if ($deliveryUser && $deliveryUser->hasRole('Delivery Guy')) {

            $max_accept_delivery_limit = $deliveryUser->delivery_guy_detail->max_accept_delivery_limit;

            $order = Order::where('id', $request->order_id)
                ->with('restaurant')
                ->with('orderitems.order_item_addons')
                ->with(array('user' => function ($query) {
                    $query->select('id', 'name', 'phone');
                }))
                ->first();

            if ($order) {

                $deliveryGuyCommissionRate = $deliveryUser->delivery_guy_detail->commission_rate;
                $commission = 0;
                if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->total;
                }
                if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->delivery_charge;
                }
                if ($deliveryUser->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->delivery_guy_detail->tip_commission_rate)) {
                    $tip_amount = $deliveryUser->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                    $tip_amount = number_format((float) $tip_amount, 2, '.', '');
                } else {
                    $tip_amount = null;
                }

                $checkOrder = AcceptDelivery::where('order_id', $order->id)->first();

                if (!$checkOrder) {
                    //check the max_accept_delivery_limit
                    $nonCompleteOrders = AcceptDelivery::where('user_id', $deliveryUser->id)->where('is_complete', 0)->with('order')->get();
                    // dd($nonCompleteOrders->count());

                    $countNonCompleteOrders = 0;
                    if ($nonCompleteOrders) {
                        foreach ($nonCompleteOrders as $nonCompleteOrder) {
                            if ($nonCompleteOrder->order && $nonCompleteOrder->order->orderstatus_id != 6) {
                                $countNonCompleteOrders++;
                            }
                        }
                    }

                    if ($countNonCompleteOrders < $max_accept_delivery_limit) {

                        try {
                            $order->orderstatus_id = '3'; //Accepted by delivery boy (Deliery Boy Assigned)
                            $order->save();

                            $acceptDelivery = new AcceptDelivery();
                            $acceptDelivery->order_id = $order->id;
                            $acceptDelivery->user_id = $deliveryUser->id;
                            $acceptDelivery->customer_id = $order->user->id;
                            $acceptDelivery->save();

                            $singleOrder = $order;
                            // sleep(3);
                            if (config('appSettings.enablePushNotificationOrders') == 'true') {
                                $notify = new PushNotify();
                                $notify->sendPushNotification('3', $order->user_id, $order->unique_order_id);
                            }

                        } catch (Illuminate\Database\QueryException $e) {
                            $errorCode = $e->errorInfo[1];
                            if ($errorCode == 1062) {
                                $singleOrder->already_accepted = true;
                            }
                        }
                        $singleOrder->commission = number_format((float) $commission, 2, '.', '');
                        $singleOrder->tip_amount = $tip_amount;
                        return response()->json($singleOrder);
                    } else {
                        $singleOrder = $order;
                        $singleOrder->max_order = true;
                        $singleOrder->commission = number_format((float) $commission, 2, '.', '');
                        $singleOrder->tip_amount = $tip_amount;
                        return response()->json($singleOrder);
                    }
                } else {
                    $singleOrder = $order;
                    $singleOrder->already_accepted = true;
                    $singleOrder->commission = number_format((float) $commission, 2, '.', '');
                    $singleOrder->tip_amount = $tip_amount;
                    return response()->json($singleOrder);
                }
            }
        }

    }

    /**
     * @param Request $request
     */
    public function pickedupOrder(Request $request)
    {

        $deliveryUser = auth()->user();

        if ($deliveryUser->hasRole('Delivery Guy')) {

            $order = Order::where('id', $request->order_id)
                ->with('restaurant')
                ->with('orderitems.order_item_addons')
                ->with(array('user' => function ($query) {
                    $query->select('id', 'name', 'phone');
                }))
                ->first();

            if ($order) {

                $deliveryGuyCommissionRate = $deliveryUser->delivery_guy_detail->commission_rate;
                $commission = 0;
                if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->total;
                }
                if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->delivery_charge;
                }

                if ($deliveryUser->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->delivery_guy_detail->tip_commission_rate)) {
                    $tip_amount = $deliveryUser->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                    $tip_amount = number_format((float) $tip_amount, 2, '.', '');
                } else {
                    $tip_amount = null;
                }

                $order->orderstatus_id = '4'; //Accepted by delivery boy (Deliery Boy Assigned)
                $order->save();

                $singleOrder = $order;

                if (config('appSettings.enablePushNotificationOrders') == 'true') {
                    $notify = new PushNotify();
                    $notify->sendPushNotification('4', $order->user_id, $order->unique_order_id);
                }

                $singleOrder->commission = number_format((float) $commission, 2, '.', '');
                $singleOrder->tip_amount = $tip_amount;

                return response()->json($singleOrder);
            }
        }
    }

    /**
     * @param Request $request
     */
    public function deliverOrder(Request $request, TranslationHelper $translationHelper)
    {

        $keys = ['deliveryCommissionMessage', 'deliveryTipTransactionMessage'];

        $translationData = $translationHelper->getDefaultLanguageValuesForKeys($keys);

        $deliveryUser = auth()->user();

        if ($deliveryUser->hasRole('Delivery Guy')) {

            $order = Order::where('id', $request->order_id)
                ->with('restaurant')
                ->with('orderitems.order_item_addons')
                ->with(array('user' => function ($query) {
                    $query->select('id', 'name', 'phone', 'email', 'delivery_pin');
                }))
                ->first();
            $user = $order->user;

            if ($order) {

                $deliveryGuyCommissionRate = $deliveryUser->delivery_guy_detail->commission_rate;
                $commission = 0;
                if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->total;
                }
                if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                    $commission = $deliveryGuyCommissionRate / 100 * $order->delivery_charge;
                }

                if ($deliveryUser->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->delivery_guy_detail->tip_commission_rate)) {
                    $tip_amount = $deliveryUser->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                    $tip_amount = number_format((float) $tip_amount, 2, '.', '');
                } else {
                    $tip_amount = null;
                }

                if (config('appSettings.enableDeliveryPin') == 'true') {
                    if ($user->delivery_pin == strtoupper($request->delivery_pin)) {
                        $order->orderstatus_id = '5'; //Accepted by delivery boy (Deliery Boy Assigned)
                        $order->save();

                        $completeDelivery = AcceptDelivery::where('order_id', $order->id)->first();
                        $completeDelivery->is_complete = true;
                        $completeDelivery->save();

                        $singleOrder = $order;

                        if (config('appSettings.enablePushNotificationOrders') == 'true') {
                            $notify = new PushNotify();
                            $notify->sendPushNotification('5', $order->user_id, $order->unique_order_id);
                        }

                        //Update restautant earnings...
                        $restaurant_earning = RestaurantEarning::where('restaurant_id', $order->restaurant->id)
                            ->where('is_requested', 0)
                            ->first();
                        if ($restaurant_earning) {
                            // $restaurant_earning->amount += $order->total - $order->delivery_charge;
                            $restaurant_earning->amount += $order->total - ($order->delivery_charge + $order->tip_amount);
                            $restaurant_earning->save();
                        } else {
                            $restaurant_earning = new RestaurantEarning();
                            $restaurant_earning->restaurant_id = $order->restaurant->id;
                            // $restaurant_earning->amount = $order->total - $order->delivery_charge;
                            $restaurant_earning->amount = $order->total - ($order->delivery_charge + $order->tip_amount);
                            $restaurant_earning->save();
                        }

                        //Update delivery guy collection
                        if ($order->payment_mode == 'COD') {
                            $delivery_collection = DeliveryCollection::where('user_id', $completeDelivery->user_id)->first();
                            if ($delivery_collection) {
                                $delivery_collection->amount += $order->payable;
                                $delivery_collection->save();
                            } else {
                                $delivery_collection = new DeliveryCollection();
                                $delivery_collection->user_id = $completeDelivery->user_id;
                                $delivery_collection->amount = $order->payable;
                                $delivery_collection->save();
                            }
                        }

                        //Update delivery guy's earnings...
                        if (config('appSettings.enableDeliveryGuyEarning') == 'true') {
                            //if enabled, then check based on which value the commision will be calculated
                            $deliveryUser = AcceptDelivery::where('order_id', $order->id)->first();
                            if ($deliveryUser->user) {
                                if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                                    //get order total and delivery guy's commission rate and transfer to wallet
                                    // $commission = $deliveryUser->user->delivery_guy_detail->commission_rate / 100 * $order->total;
                                    $commission = $deliveryUser->user->delivery_guy_detail->commission_rate / 100 * ($order->total - $order->tip_amount);
                                    $deliveryUser->user->deposit($commission * 100, ['description' => $translationData->deliveryCommissionMessage . $order->unique_order_id]);
                                }
                                if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                                    //get order delivery charge and delivery guy's commission rate and transfer to wallet
                                    $commission = $deliveryUser->user->delivery_guy_detail->commission_rate / 100 * $order->delivery_charge;
                                    $deliveryUser->user->deposit($commission * 100, ['description' => $translationData->deliveryCommissionMessage . $order->unique_order_id]);
                                }
                            }
                        }
                        $singleOrder->commission = number_format((float) $commission, 2, '.', '');
                        // update tip amount charges
                        if ($deliveryUser->user) {
                            if ($deliveryUser->user->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->user->delivery_guy_detail->tip_commission_rate)) {
                                $commission = $deliveryUser->user->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                                $deliveryUser->user->deposit($commission * 100, ['description' => $translationData->deliveryTipTransactionMessage . ' : ' . $order->unique_order_id]);
                            }
                        }
                        return response()->json($singleOrder);

                    } else {
                        $singleOrder = $order;

                        $singleOrder->delivery_pin_error = true;
                        $singleOrder->commission = number_format((float) $commission, 2, '.', '');
                        $singleOrder->tip_amount = $tip_amount;
                        // sleep(3);
                        return response()->json($singleOrder);
                    }
                } else {
                    $order->orderstatus_id = '5'; //Accepted by delivery boy (Deliery Boy Assigned)
                    $order->save();

                    $completeDelivery = AcceptDelivery::where('order_id', $order->id)->first();
                    $completeDelivery->is_complete = true;
                    $completeDelivery->save();

                    $singleOrder = $order;

                    if (config('appSettings.enablePushNotificationOrders') == 'true') {
                        $notify = new PushNotify();
                        $notify->sendPushNotification('5', $order->user_id, $order->unique_order_id);
                    }

                    $restaurant_earning = RestaurantEarning::where('restaurant_id', $order->restaurant->id)
                        ->where('is_requested', 0)
                        ->first();
                    if ($restaurant_earning) {
                        // $restaurant_earning->amount += $order->total - $order->delivery_charge;
                        $restaurant_earning->amount += $order->total - ($order->delivery_charge + $order->tip_amount);
                        $restaurant_earning->save();
                    } else {
                        $restaurant_earning = new RestaurantEarning();
                        $restaurant_earning->restaurant_id = $order->restaurant->id;
                        // $restaurant_earning->amount = $order->total - $order->delivery_charge;
                        $restaurant_earning->amount = $order->total - ($order->delivery_charge + $order->tip_amount);
                        $restaurant_earning->save();
                    }

                    //Update delivery guy collection
                    if ($order->payment_mode == 'COD') {
                        $delivery_collection = DeliveryCollection::where('user_id', $completeDelivery->user_id)->first();
                        if ($delivery_collection) {
                            $delivery_collection->amount += $order->payable;
                            $delivery_collection->save();
                        } else {
                            $delivery_collection = new DeliveryCollection();
                            $delivery_collection->user_id = $completeDelivery->user_id;
                            $delivery_collection->amount = $order->payable;
                            $delivery_collection->save();
                        }
                    }

                    //Update delivery guy's earnings...
                    if (config('appSettings.enableDeliveryGuyEarning') == 'true') {
                        //if enabled, then check based on which value the commision will be calculated
                        $deliveryUser = AcceptDelivery::where('order_id', $order->id)->first();
                        if ($deliveryUser->user) {
                            if (config('appSettings.deliveryGuyCommissionFrom') == 'FULLORDER') {
                                //get order total and delivery guy's commission rate and transfer to wallet
                                // $commission = $deliveryUser->user->delivery_guy_detail->commission_rate / 100 * $order->total;
                                $commission = $deliveryUser->user->delivery_guy_detail->commission_rate / 100 * ($order->total - $order->tip_amount);
                                $deliveryUser->user->deposit($commission * 100, ['description' => $translationData->deliveryCommissionMessage . $order->unique_order_id]);
                            }
                            if (config('appSettings.deliveryGuyCommissionFrom') == 'DELIVERYCHARGE') {
                                //get order delivery charge and delivery guy's commission rate and transfer to wallet
                                $commission = $deliveryUser->user->delivery_guy_detail->commission_rate / 100 * $order->delivery_charge;
                                $deliveryUser->user->deposit($commission * 100, ['description' => $translationData->deliveryCommissionMessage . $order->unique_order_id]);
                            }
                        }
                    }
                    // update tip amount charges
                    if ($deliveryUser->user) {
                        if ($deliveryUser->user->delivery_guy_detail->tip_commission_rate && !is_null($deliveryUser->user->delivery_guy_detail->tip_commission_rate)) {
                            $commission = $deliveryUser->user->delivery_guy_detail->tip_commission_rate / 100 * $order->tip_amount;
                            $deliveryUser->user->deposit($commission * 100, ['description' => $translationData->deliveryTipTransactionMessage . ' : ' . $order->unique_order_id]);
                        }
                    }
                    return response()->json($singleOrder);
                }
            }
        }
    }

}
