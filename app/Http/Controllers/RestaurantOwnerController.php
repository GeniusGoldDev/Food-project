<?php

namespace App\Http\Controllers;

use App\Addon;
use App\AddonCategory;
use App\Helpers\TranslationHelper;
use App\Item;
use App\ItemCategory;
use App\Order;
use App\PaymentGateway;
use App\PushNotify;
use App\Rating;
use App\Restaurant;
use App\RestaurantEarning;
use App\RestaurantPayout;
use App\Sms;
use App\StorePayoutDetail;
use App\User;
use Artisan;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Image;
use Modules\ThermalPrinter\Entities\PrinterSetting;
use Modules\ThermalPrinter\Entities\ThermalPrinter;
use Nwidart\Modules\Facades\Module;
use OneSignal;

class RestaurantOwnerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $restaurant = $user->restaurants;

        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('orderstatus_id', '1')
            ->orderBy('id', 'DESC')
            ->with('restaurant')
            ->get();

        $newOrdersIds = $newOrders->pluck('id')->toArray();

        $preparingOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->whereIn('orderstatus_id', ['2'])
            ->where('delivery_type', '<>', 2)
            ->orderBy('id', 'DESC')
            ->with('restaurant')
            ->get();

        $selfpickupOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->whereIn('orderstatus_id', ['2', '7'])
            ->where('delivery_type', 2)
            ->orderBy('orderstatus_id', 'DESC')
            ->with('restaurant')
            ->get();

        $ongoingOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->whereIn('orderstatus_id', ['3', '4'])
            ->orderBy('orderstatus_id', 'DESC')
            ->with('restaurant')
            ->get();

        $ordersCount = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('orderstatus_id', '5')->count();

        $allCompletedOrders = Order::whereIn('restaurant_id', $restaurantIds)
            ->with('orderitems')
            ->where('orderstatus_id', '5')
            ->get();

        $orderItemsCount = 0;
        foreach ($allCompletedOrders as $cO) {
            foreach ($cO->orderitems as $orderItem) {
                $orderItemsCount += $orderItem->quantity;
            }
        }

        $totalEarning = 0;
        settype($var, 'float');

        foreach ($allCompletedOrders as $completedOrder) {
            $totalEarning += $completedOrder->total - ($completedOrder->delivery_charge + $completedOrder->tip_amount);
        }

        $zenMode = \Session::get('zenMode');

        if (Module::find('ThermalPrinter') && Module::find('ThermalPrinter')->isEnabled()) {

            $printerSetting = PrinterSetting::where('user_id', Auth::user()->id)->first();
            if ($printerSetting) {
                $data = json_decode($printerSetting->data);

                if ($data->automatic_printing == 'OFF') {
                    $autoPrinting = false;
                } else {
                    $autoPrinting = true;
                }
            } else {
                $autoPrinting = false;
            }

        } else {
            $autoPrinting = false;
        }

        $arrayData = [
            'restaurantsCount' => count($user->restaurants),
            'ordersCount' => $ordersCount,
            'orderItemsCount' => $orderItemsCount,
            'totalEarning' => number_format((float) $totalEarning, 2, '.', ''),
            'newOrders' => $newOrders,
            'newOrdersIds' => $newOrdersIds,
            'preparingOrders' => $preparingOrders,
            'ongoingOrders' => $ongoingOrders,
            'selfpickupOrders' => $selfpickupOrders,
            'autoPrinting' => $autoPrinting,
        ];

        if ($zenMode == 'true') {
            return view('restaurantowner.dashboardv2', $arrayData);
        }

        return view('restaurantowner.dashboard', $arrayData);
    }

    /**
     * @param Request $request
     */
    public function getNewOrders(Request $request)
    {
        $user = Auth::user();

        $restaurant = $user->restaurants;

        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $listedOrderIds = $request->listed_order_ids;
        if ($listedOrderIds) {
            $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
                ->whereNotIn('id', $listedOrderIds)
                ->where('orderstatus_id', '1')
                ->orderBy('id', 'DESC')
                ->with('restaurant')
                ->get();
        } else {
            $newOrders = Order::whereIn('restaurant_id', $restaurantIds)
                ->where('orderstatus_id', '1')
                ->orderBy('id', 'DESC')
                ->with('restaurant')
                ->get();
        }

        return response()->json($newOrders);
    }

    /**
     * @param $id
     */
    public function acceptOrder($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        if ($order->orderstatus_id == '1') {
            $order->orderstatus_id = 2;
            $order->save();

            if (config('appSettings.enablePushNotificationOrders') == 'true') {
                //to user
                $notify = new PushNotify();
                $notify->sendPushNotification('2', $order->user_id, $order->unique_order_id);
            }

            // Send Push Notification to Delivery Guy
            if (config('appSettings.enablePushNotificationOrders') == 'true') {
                //get restaurant
                $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
                if ($restaurant) {
                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $order->restaurant_id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            //send Notification to Res Owner
                            $notify = new PushNotify();
                            $notify->sendPushNotification('TO_DELIVERY', $pU->id, $order->unique_order_id);
                        }
                    }
                }
            }
            // END Send Push Notification to Delivery Guy

            // Send SMS Notification to Delivery Guy
            if (config('appSettings.smsDeliveryNotify') == 'true') {
                //get restaurant
                $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
                if ($restaurant) {
                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $order->restaurant_id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            //send sms to Delivery Guy
                            if ($pU->delivery_guy_detail->is_notifiable) {
                                $message = config('appSettings.defaultSmsDeliveryMsg');
                                $otp = null;
                                $smsForDelivery = true;
                                $smsnotify = new Sms();
                                $smsnotify->processSmsAction('OD_NOTIFY', $pU->phone, $otp, $message, $smsForDelivery);
                            }
                        }
                    }
                }
            }
            // END Send SMS Notification to Delivery Guy

            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => true]);
            } else {
                return redirect()->back()->with(array('success' => __('storeDashboard.orderAcceptedNotification')));
            }
        } else {
            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => false], 406);
            } else {
                return redirect()->back()->with(array('message' => __('storeDashboard.orderSomethingWentWrongNotification')));
            }
        }
    }

    /**
     * @param $id
     */
    public function markOrderReady($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        if ($order->orderstatus_id == '2') {
            $order->orderstatus_id = 7;
            $order->save();

            if (config('appSettings.enablePushNotificationOrders') == 'true') {

                //to user
                $notify = new PushNotify();
                $notify->sendPushNotification('7', $order->user_id, $order->unique_order_id);
            }

            return redirect()->back()->with(array('success' => 'Order Marked as Ready'));
        } else {
            return redirect()->back()->with(array('message' => 'Something went wrong.'));
        }
    }

    /**
     * @param $id
     */
    public function markSelfPickupOrderAsCompleted($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        if ($order->orderstatus_id == '7') {
            $order->orderstatus_id = 5;
            $order->save();

            //if selfpickup add amount to restaurant earnings if not COD then add order total
            if ($order->payment_mode == 'STRIPE' || $order->payment_mode == 'PAYPAL' || $order->payment_mode == 'PAYSTACK' || $order->payment_mode == 'RAZORPAY' || $order->payment_mode == 'PAYMONGO' || $order->payment_mode == 'MERCADOPAGO' || $order->payment_mode == 'PAYTM' || $order->payment_mode == 'FLUTTERWAVE' || $order->payment_mode == 'KHALTI') {
                $restaurant_earning = RestaurantEarning::where('restaurant_id', $order->restaurant->id)
                    ->where('is_requested', 0)
                    ->first();
                if ($restaurant_earning) {
                    $restaurant_earning->amount += $order->total;
                    $restaurant_earning->save();
                } else {
                    $restaurant_earning = new RestaurantEarning();
                    $restaurant_earning->restaurant_id = $order->restaurant->id;
                    $restaurant_earning->amount = $order->total;
                    $restaurant_earning->save();
                }
            }
            //if COD, then take the $total minus $payable amount
            if ($order->payment_mode == 'COD') {
                $restaurant_earning = RestaurantEarning::where('restaurant_id', $order->restaurant->id)
                    ->where('is_requested', 0)
                    ->first();
                if ($restaurant_earning) {
                    $restaurant_earning->amount += $order->total;
                    $restaurant_earning->save();
                } else {
                    $restaurant_earning = new RestaurantEarning();
                    $restaurant_earning->restaurant_id = $order->restaurant->id;
                    $restaurant_earning->amount = $order->total;
                    $restaurant_earning->save();
                }
            }

            if (config('appSettings.enablePushNotificationOrders') == 'true') {

                //to user
                $notify = new PushNotify();
                $notify->sendPushNotification('5', $order->user_id, $order->unique_order_id);
            }

            return redirect()->back()->with(array('success' => 'Order Completed'));
        } else {
            return redirect()->back()->with(array('message' => 'Something went wrong.'));
        }
    }

    public function restaurants()
    {
        $user = Auth::user();
        $restaurants = $user->restaurants;

        return view('restaurantowner.restaurants', array(
            'restaurants' => $restaurants,
        ));
    }

    /**
     * @param $id
     */
    public function getEditRestaurant($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $restaurant = Restaurant::where('id', $id)->whereIn('id', $restaurantIds)->first();

        $adminPaymentGateways = PaymentGateway::where('is_active', '1')->get();

        $payoutData = StorePayoutDetail::where('restaurant_id', $id)->first();
        if ($payoutData) {
            $payoutData = json_decode($payoutData->data);
        } else {
            $payoutData = null;
        }

        if ($restaurant) {

            return view('restaurantowner.editRestaurant', array(
                'restaurant' => $restaurant,
                'schedule_data' => json_decode($restaurant->schedule_data),
                'adminPaymentGateways' => $adminPaymentGateways,
                'payoutData' => $payoutData,
            ));
        } else {
            return redirect()->route('restaurantowner.restaurants')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function disableRestaurant($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if ($restaurant) {
            $restaurant->is_schedulable = false;
            $restaurant->toggleActive();
            $restaurant->save();
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('restaurant.restaurants');
        }
    }

    /**
     * @param Request $request
     */
    public function saveNewRestaurant(Request $request)
    {
        $restaurant = new Restaurant();

        $restaurant->name = $request->name;
        $restaurant->description = $request->description;

        $image = $request->file('image');
        $rand_name = time() . str_random(10);
        $filename = $rand_name . '.jpg';
        Image::make($image)
            ->resize(160, 117)
            ->save(base_path('assets/img/restaurants/' . $filename), config('appSettings.uploadImageQuality '), 'jpg');
        $restaurant->image = '/assets/img/restaurants/' . $filename;

        $restaurant->delivery_time = $request->delivery_time;
        $restaurant->price_range = $request->price_range;

        if ($request->is_pureveg == 'true') {
            $restaurant->is_pureveg = true;
        } else {
            $restaurant->is_pureveg = false;
        }

        $restaurant->slug = str_slug($request->name) . '-' . str_random(15);
        $restaurant->certificate = $request->certificate;

        $restaurant->address = $request->address;
        $restaurant->pincode = $request->pincode;
        $restaurant->landmark = $request->landmark;
        $restaurant->latitude = $request->latitude;
        $restaurant->longitude = $request->longitude;

        $restaurant->restaurant_charges = $request->restaurant_charges;

        $restaurant->sku = time() . str_random(10);

        $restaurant->is_active = 0;

        $restaurant->min_order_price = $request->min_order_price;

        if ($request->has('delivery_type')) {
            $restaurant->delivery_type = $request->delivery_type;
        }

        try {

            $restaurant->save();
            $user = Auth::user();
            $user->restaurants()->attach($restaurant);
            return redirect()->back()->with(array('success' => 'Restaurant Saved'));
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    /**
     * @param Request $request
     */
    public function updateRestaurant(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->id)->first();

        if ($restaurant) {
            $restaurant->name = $request->name;
            $restaurant->description = $request->description;

            if ($request->image == null) {
                $restaurant->image = $request->old_image;
            } else {
                $image = $request->file('image');
                $rand_name = time() . str_random(10);
                $filename = $rand_name . '.jpg';
                Image::make($image)
                    ->resize(160, 117)
                    ->save(base_path('assets/img/restaurants/' . $filename), config('appSettings.uploadImageQuality '), 'jpg');
                $restaurant->image = '/assets/img/restaurants/' . $filename;
            }

            $restaurant->delivery_time = $request->delivery_time;
            $restaurant->price_range = $request->price_range;

            if ($request->is_pureveg == 'true') {
                $restaurant->is_pureveg = true;
            } else {
                $restaurant->is_pureveg = false;
            }

            $restaurant->certificate = $request->certificate;

            $restaurant->address = $request->address;
            $restaurant->pincode = $request->pincode;
            $restaurant->landmark = $request->landmark;
            $restaurant->latitude = $request->latitude;
            $restaurant->longitude = $request->longitude;

            $restaurant->restaurant_charges = $request->restaurant_charges;

            $restaurant->min_order_price = $request->min_order_price;

            if ($request->has('delivery_type')) {
                $restaurant->delivery_type = $request->delivery_type;
            }

            if ($request->is_schedulable == 'true') {
                $restaurant->is_schedulable = true;
            } else {
                $restaurant->is_schedulable = false;
            }

            try {

                if ($request->store_payment_gateways == null) {
                    $restaurant->payment_gateways()->sync($request->store_payment_gateways);
                }

                if (isset($request->store_payment_gateways)) {
                    $restaurant->payment_gateways()->sync($request->store_payment_gateways);
                }

                $restaurant->save();
                return redirect()->back()->with(array('success' => 'Restaurant Updated'));
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }

    public function itemcategories()
    {
        $itemCategories = ItemCategory::orderBy('id', 'DESC')
            ->where('user_id', Auth::user()->id)
            ->get();
        $itemCategories->loadCount('items');
        $count = count($itemCategories);

        return view('restaurantowner.itemcategories', array(
            'itemCategories' => $itemCategories,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function createItemCategory(Request $request)
    {
        $itemCategory = new ItemCategory();

        $itemCategory->name = $request->name;
        $itemCategory->user_id = Auth::user()->id;

        try {
            $itemCategory->save();
            return redirect()->back()->with(array('success' => 'Category Created'));
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    /**
     * @param $id
     */
    public function disableCategory($id)
    {
        $itemCategory = ItemCategory::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        if ($itemCategory) {
            $itemCategory->toggleEnable()->save();
            return redirect()->back()->with(array('success' => 'Operation Successful'));
        } else {
            return redirect()->route('restaurant.itemcategories');
        }
    }

    /**
     * @param Request $request
     */
    public function updateItemCategory(Request $request)
    {
        $itemCategory = ItemCategory::where('id', $request->id)->where('user_id', Auth::user()->id)->firstOrFail();
        $itemCategory->name = $request->name;
        $itemCategory->save();
        return redirect()->back()->with(['success' => 'Operation Successful']);
    }

    public function items()
    {
        $user = Auth::user();

        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $items = Item::whereIn('restaurant_id', $restaurantIds)
            ->orderBy('id', 'DESC')
            ->with('item_category', 'restaurant')
            ->paginate(20);

        $count = $items->total();

        $restaurants = $user->restaurants;

        $itemCategories = ItemCategory::where('is_enabled', '1')
            ->where('user_id', Auth::user()->id)
            ->get();
        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.items', array(
            'items' => $items,
            'count' => $count,
            'restaurants' => $restaurants,
            'itemCategories' => $itemCategories,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function searchItems(Request $request)
    {
        $user = Auth::user();

        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $query = $request['query'];

        $items = Item::whereIn('restaurant_id', $restaurantIds)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->with('item_category', 'restaurant')
            ->paginate(20);

        $count = $items->total();

        $restaurants = $user->restaurants;

        $itemCategories = ItemCategory::where('is_enabled', '1')
            ->where('user_id', Auth::user()->id)
            ->get();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.items', array(
            'items' => $items,
            'count' => $count,
            'restaurants' => $restaurants,
            'query' => $query,
            'itemCategories' => $itemCategories,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewItem(Request $request)
    {
        // dd($request->all());

        $item = new Item();

        $item->name = $request->name;
        $item->price = $request->price;
        $item->old_price = $request->old_price == null ? 0 : $request->old_price;
        $item->restaurant_id = $request->restaurant_id;
        $item->item_category_id = $request->item_category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $rand_name = time() . str_random(10);
            $filename = $rand_name . '.jpg';
            Image::make($image)
                ->resize(486, 355)
                ->save(base_path('assets/img/items/' . $filename), config('appSettings.uploadImageQuality '), 'jpg');

            $item->image = '/assets/img/items/' . $filename;
        }

        if ($request->is_recommended == 'true') {
            $item->is_recommended = true;
        } else {
            $item->is_recommended = false;
        }

        if ($request->is_popular == 'true') {
            $item->is_popular = true;
        } else {
            $item->is_popular = false;
        }

        if ($request->is_new == 'true') {
            $item->is_new = true;
        } else {
            $item->is_new = false;
        }

        if ($request->is_veg == 'veg') {
            $item->is_veg = true;
        } elseif ($request->is_veg == 'nonveg') {
            $item->is_veg = false;
        } else {
            $item->is_veg = null;
        }

        $item->desc = $request->desc;
        try {
            $item->save();
            if (isset($request->addon_category_item)) {
                $item->addon_categories()->sync($request->addon_category_item);
            }
            return redirect()->back()->with(['success' => 'Item Saved']);
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    /**
     * @param $id
     */
    public function getEditItem($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $item = Item::where('id', $id)
            ->whereIn('restaurant_id', $restaurantIds)
            ->first();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        if ($item) {
            $restaurants = $user->restaurants;
            $itemCategories = ItemCategory::where('is_enabled', '1')
                ->where('user_id', Auth::user()->id)
                ->get();

            return view('restaurantowner.editItem', array(
                'item' => $item,
                'restaurants' => $restaurants,
                'itemCategories' => $itemCategories,
                'addonCategories' => $addonCategories,
            ));
        } else {
            return redirect()->route('restaurant.items')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function disableItem($id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $item = Item::where('id', $id)
            ->whereIn('restaurant_id', $restaurantIds)
            ->first();
        if ($item) {
            $item->toggleActive()->save();
            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => true]);
            }
            return redirect()->back()->with(array('success' => 'Operation Successful'));
        } else {
            return redirect()->route('restaurant.items');
        }
    }

    /**
     * @param Request $request
     */
    public function updateItem(Request $request)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $item = Item::where('id', $request->id)
            ->whereIn('restaurant_id', $restaurantIds)
            ->first();

        if ($item) {
            $item->name = $request->name;
            $item->restaurant_id = $request->restaurant_id;
            $item->item_category_id = $request->item_category_id;

            if ($request->image == null) {
                $item->image = $request->old_image;
            } else {
                $image = $request->file('image');
                $rand_name = time() . str_random(10);
                $filename = $rand_name . '.jpg';
                Image::make($image)
                    ->resize(486, 355)
                    ->save(base_path('assets/img/items/' . $filename), config('appSettings.uploadImageQuality '), 'jpg');
                $item->image = '/assets/img/items/' . $filename;
            }

            $item->price = $request->price;
            $item->old_price = $request->old_price == null ? 0 : $request->old_price;

            if ($request->is_recommended == 'true') {
                $item->is_recommended = true;
            } else {
                $item->is_recommended = false;
            }

            if ($request->is_popular == 'true') {
                $item->is_popular = true;
            } else {
                $item->is_popular = false;
            }

            if ($request->is_new == 'true') {
                $item->is_new = true;
            } else {
                $item->is_new = false;
            }

            if ($request->is_veg == 'veg') {
                $item->is_veg = true;
            } elseif ($request->is_veg == 'nonveg') {
                $item->is_veg = false;
            } else {
                $item->is_veg = null;
            }

            $item->desc = $request->desc;
            try {
                $item->save();
                if (isset($request->addon_category_item)) {
                    $item->addon_categories()->sync($request->addon_category_item);
                }
                if ($request->addon_category_item == null) {
                    $item->addon_categories()->sync($request->addon_category_item);
                }

                if ($request->remove_all_addons == '1') {
                    $item->addon_categories()->sync($request->addon_category_item);
                }
                return redirect()->back()->with(array('success' => 'Item Saved'));
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }

    public function addonCategories()
    {

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)
            ->orderBy('id', 'DESC')
            ->paginate(20);
        $addonCategories->loadCount('addons');

        $count = $addonCategories->total();

        return view('restaurantowner.addonCategories', array(
            'addonCategories' => $addonCategories,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function searchAddonCategories(Request $request)
    {
        $query = $request['query'];

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->paginate(20);
        $addonCategories->loadCount('addons');

        $count = $addonCategories->total();

        return view('restaurantowner.addonCategories', array(
            'addonCategories' => $addonCategories,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewAddonCategory(Request $request)
    {
        $addonCategory = new AddonCategory();

        $addonCategory->name = $request->name;
        $addonCategory->type = $request->type;
        $addonCategory->description = $request->description;
        $addonCategory->user_id = Auth::user()->id;
        $addonCategory->addon_limit = $request->addon_limit ? $request->addon_limit : 0;

        try {
            $addonCategory->save();
            if ($request->has('addon_names')) {
                foreach ($request->addon_names as $key => $addon_name) {
                    $addon = new Addon();
                    $addon->name = $addon_name;
                    $addon->price = $request->addon_prices[$key];
                    $addon->addon_category_id = $addonCategory->id;
                    $addon->user_id = Auth::user()->id;
                    $addon->save();
                }
            }
            return redirect()->route('restaurant.editAddonCategory', $addonCategory->id)->with(['success' => 'Addon Category Saved']);
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }
    }

    public function newAddonCategory()
    {
        return view('restaurantowner.newAddonCategory');
    }

    /**
     * @param $id
     */
    public function getEditAddonCategory($id)
    {
        $addonCategory = AddonCategory::where('id', $id)->with('addons')->first();
        if ($addonCategory) {
            if ($addonCategory->user_id == Auth::user()->id) {
                return view('restaurantowner.editAddonCategory', array(
                    'addonCategory' => $addonCategory,
                    'addons' => $addonCategory->addons,
                ));
            } else {
                return redirect()
                    ->route('restaurant.addonCategories')
                    ->with(array('message' => 'Access Denied'));
            }
        } else {
            return redirect()
                ->route('restaurant.addonCategories')
                ->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param Request $request
     */
    public function updateAddonCategory(Request $request)
    {
        $addonCategory = AddonCategory::where('id', $request->id)->first();

        if ($addonCategory) {

            $addonCategory->name = $request->name;
            $addonCategory->type = $request->type;
            $addonCategory->description = $request->description;
            $addonCategory->addon_limit = $request->addon_limit ? $request->addon_limit : 0;

            try {
                $addonCategory->save();
                $addons_old = $request->input('addon_old');
                if ($request->has('addon_old')) {
                    foreach ($addons_old as $ad) {
                        $addon_old_update = Addon::find($ad['id']);
                        $addon_old_update->name = $ad['name'];
                        $addon_old_update->price = $ad['price'];
                        $addon_old_update->user_id = Auth::user()->id;
                        $addon_old_update->save();
                    }
                }

                if ($request->addon_names) {
                    foreach ($request->addon_names as $key => $addon_name) {
                        $addon = new Addon();
                        $addon->name = $addon_name;
                        $addon->price = $request->addon_prices[$key];
                        $addon->addon_category_id = $addonCategory->id;
                        $addon->user_id = Auth::user()->id;
                        $addon->save();
                    }
                }

                return redirect()->back()->with(['success' => 'Addon Category Updated']);
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }

    public function addons()
    {
        $addons = Addon::where('user_id', Auth::user()->id)->with('addon_category')->paginate();

        $count = $addons->total();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.addons', array(
            'addons' => $addons,
            'count' => $count,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function searchAddons(Request $request)
    {
        $query = $request['query'];

        $addons = Addon::where('user_id', Auth::user()->id)
            ->where('name', 'LIKE', '%' . $query . '%')
            ->with('addon_category')
            ->paginate(20);

        $count = $addons->total();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();

        return view('restaurantowner.addons', array(
            'addons' => $addons,
            'count' => $count,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewAddon(Request $request)
    {
        $addon = new Addon();

        $addon->name = $request->name;
        $addon->price = $request->price;
        $addon->user_id = Auth::user()->id;
        $addon->addon_category_id = $request->addon_category_id;

        try {
            $addon->save();
            return redirect()->back()->with(array('success' => 'Addon Saved'));
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
        } catch (Exception $e) {
            return redirect()->back()->with(array('message' => $e->getMessage()));
        } catch (\Throwable $th) {
            return redirect()->back()->with(array('message' => $th));
        }
    }

    /**
     * @param $id
     */
    public function getEditAddon($id)
    {
        $addon = Addon::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();

        $addonCategories = AddonCategory::where('user_id', Auth::user()->id)->get();
        if ($addon) {
            return view('restaurantowner.editAddon', array(
                'addon' => $addon,
                'addonCategories' => $addonCategories,
            ));
        } else {
            return redirect()->route('restaurant.addons')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param Request $request
     */
    public function updateAddon(Request $request)
    {
        $addon = Addon::where('id', $request->id)->first();

        if ($addon) {
            if ($addon->user_id == Auth::user()->id) {
                $addon->name = $request->name;
                $addon->price = $request->price;
                $addon->addon_category_id = $request->addon_category_id;

                try {
                    $addon->save();
                    return redirect()->back()->with(array('success' => 'Addon Updated'));
                } catch (\Illuminate\Database\QueryException $qe) {
                    return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
                } catch (Exception $e) {
                    return redirect()->back()->with(array('message' => $e->getMessage()));
                } catch (\Throwable $th) {
                    return redirect()->back()->with(array('message' => $th));
                }
            } else {
                return redirect()->route('restaurant.addons')->with(array('message' => 'Access Denied'));
            }
        } else {
            return redirect()->route('restaurant.addons')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function disableAddon($id)
    {
        $addon = Addon::where('id', $id)->firstOrFail();
        if ($addon) {
            $addon->toggleActive()->save();
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->back()->with(['message' => 'Something Went Wrong']);
        }
    }

    /**
     * @param $id
     */
    public function deleteAddon($id)
    {
        $addon = Addon::find($id);
        if ($addon->user_id == Auth::user()->id) {
            $addon->delete();

            return redirect()->back()->with(['success' => 'Addon Deleted']);
        } else {
            return redirect()->back()->with(['message' => 'Click on Update first, then try deleting again.']);
        }
    }

    public function orders()
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $orders = Order::orderBy('id', 'DESC')
            ->whereIn('orderstatus_id', ['1', '2', '3', '4', '5', '6', '7'])
            ->whereIn('restaurant_id', $restaurantIds)
            ->with('accept_delivery.user', 'restaurant')
            ->paginate('20');

        $count = $orders->total();
        // dd($orders);
        return view('restaurantowner.orders', array(
            'orders' => $orders,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function postSearchOrders(Request $request)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $query = $request['query'];

        $orders = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('unique_order_id', 'LIKE', '%' . $query . '%')
            ->with('accept_delivery.user', 'restaurant')
            ->paginate(20);

        $count = $orders->total();

        return view('restaurantowner.orders', array(
            'orders' => $orders,
            'count' => $count,
        ));
    }

    /**
     * @param $order_id
     */
    public function viewOrder($order_id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::whereIn('restaurant_id', $restaurantIds)
            ->where('unique_order_id', $order_id)
            ->with('orderitems.order_item_addons')
            ->first();

        if ($order) {
            return view('restaurantowner.viewOrder', array(
                'order' => $order,
            ));
        } else {
            return redirect()->route('restaurantowner.orders');
        }
    }

    /**
     * @param $restaurant_id
     */
    public function earnings($restaurant_id = null)
    {
        if ($restaurant_id) {
            $user = Auth::user();
            $restaurant = $user->restaurants;
            $restaurantIds = $user->restaurants->pluck('id')->toArray();

            $restaurant = Restaurant::where('id', $restaurant_id)->first();
            // check if restaurant exists
            if ($restaurant) {
                //check if restaurant belongs to the auth user
                // $contains = Arr::has($restaurantIds, $restaurant->id);
                $contains = in_array($restaurant->id, $restaurantIds);
                if ($contains) {
                    //true
                    $allCompletedOrders = Order::where('restaurant_id', $restaurant->id)
                        ->where('orderstatus_id', '5')
                        ->get();

                    $totalEarning = 0;
                    settype($var, 'float');

                    foreach ($allCompletedOrders as $completedOrder) {
                        // $totalEarning += $completedOrder->total - $completedOrder->delivery_charge;
                        $totalEarning += $completedOrder->total - ($completedOrder->delivery_charge + $completedOrder->tip_amount);
                    }

                    // Build an array of the dates we want to show, oldest first
                    $dates = collect();
                    foreach (range(-30, 0) as $i) {
                        $date = Carbon::now()->addDays($i)->format('Y-m-d');
                        $dates->put($date, 0);
                    }

                    // Get the post counts
                    $posts = Order::where('restaurant_id', $restaurant->id)
                        ->where('orderstatus_id', '5')
                        ->where('created_at', '>=', $dates->keys()->first())
                        ->groupBy('date')
                        ->orderBy('date')
                        ->get([
                            DB::raw('DATE( created_at ) as date'),
                            DB::raw('SUM( total ) as "total"'),
                        ])
                        ->pluck('total', 'date');

                    // Merge the two collections; any results in `$posts` will overwrite the zero-value in `$dates`
                    $dates = $dates->merge($posts);

                    // dd($dates);
                    $monthlyDate = '[';
                    $monthlyEarning = '[';
                    foreach ($dates as $date => $value) {
                        $monthlyDate .= "'" . $date . "' ,";
                        $monthlyEarning .= "'" . $value . "' ,";
                    }

                    $monthlyDate = rtrim($monthlyDate, ' ,');
                    $monthlyDate = $monthlyDate . ']';

                    $monthlyEarning = rtrim($monthlyEarning, ' ,');
                    $monthlyEarning = $monthlyEarning . ']';
                    /*=====  End of Monthly Post Analytics  ======*/

                    $balance = RestaurantEarning::where('restaurant_id', $restaurant->id)
                        ->where('is_requested', 0)
                        ->first();

                    if (!$balance) {
                        $balanceBeforeCommission = 0;
                        $balanceAfterCommission = 0;
                    } else {
                        $balanceBeforeCommission = $balance->amount;
                        $balanceAfterCommission = ($balance->amount - ($restaurant->commission_rate / 100) * $balance->amount);
                        $balanceAfterCommission = number_format((float) $balanceAfterCommission, 2, '.', '');
                    }

                    $payoutRequests = RestaurantPayout::where('restaurant_id', $restaurant_id)->orderBy('id', 'DESC')->get();

                    return view('restaurantowner.earnings', array(
                        'restaurant' => $restaurant,
                        'totalEarning' => $totalEarning,
                        'monthlyDate' => $monthlyDate,
                        'monthlyEarning' => $monthlyEarning,
                        'balanceBeforeCommission' => $balanceBeforeCommission,
                        'balanceAfterCommission' => $balanceAfterCommission,
                        'payoutRequests' => $payoutRequests,
                    ));
                } else {
                    return redirect()->route('restaurant.earnings')->with(array('message' => 'Access Denied'));
                }
            } else {
                return redirect()->route('restaurant.earnings')->with(array('message' => 'Access Denied'));
            }
        } else {
            $user = Auth::user();
            $restaurants = $user->restaurants;

            return view('restaurantowner.earnings', array(
                'restaurants' => $restaurants,
            ));
        }
    }

    /**
     * @param Request $request
     */
    public function sendPayoutRequest(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->restaurant_id)->first();
        $earning = RestaurantEarning::where('restaurant_id', $request->restaurant_id)
            ->where('is_requested', 0)
            ->first();

        $balanceBeforeCommission = $earning->amount;
        $balanceAfterCommission = ($earning->amount - ($restaurant->commission_rate / 100) * $earning->amount);
        $balanceAfterCommission = number_format((float) $balanceAfterCommission, 2, '.', '');

        if ($earning) {
            $payoutRequest = new RestaurantPayout;
            $payoutRequest->restaurant_id = $request->restaurant_id;
            $payoutRequest->restaurant_earning_id = $earning->id;
            $payoutRequest->amount = $balanceAfterCommission;
            $payoutRequest->status = 'PENDING';
            try {
                $payoutRequest->save();
                $earning->is_requested = 1;
                $earning->restaurant_payout_id = $payoutRequest->id;
                $earning->save();
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(array('message' => 'Something went wrong. Please check your form and try again.'));
            } catch (Exception $e) {
                return redirect()->back()->with(array('message' => $e->getMessage()));
            } catch (\Throwable $th) {
                return redirect()->back()->with(array('message' => $th));
            }

            return redirect()->back()->with(array('success' => 'Payout Request Sent'));
        } else {
            return redirect()->route('restaurant.earnings')->with(array('message' => 'Access Denied'));
        }
    }

    /**
     * @param $id
     */
    public function cancelOrder($id, TranslationHelper $translationHelper)
    {
        $keys = ['orderRefundWalletComment', 'orderPartialRefundWalletComment'];
        $translationData = $translationHelper->getDefaultLanguageValuesForKeys($keys);

        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $order = Order::where('id', $id)->whereIn('restaurant_id', $restaurantIds)->first();

        $customer = User::where('id', $order->user_id)->first();

        if ($order && $user) {
            if ($order->orderstatus_id == '1') {
                //change order status to 6 (Canceled)
                $order->orderstatus_id = 6;
                $order->save();
                //refund money if paid online
                // if (!$order->payment_mode == 'COD') {
                //     //paid online or paid fully with wallet (Give full refund)
                //     $customer = User::where('id', $order->user_id)->first();
                //     if ($customer) {
                //         $customer->deposit($order->total * 100, ['description' => $translationData->orderRefundWalletComment . $order->unique_order_id]);
                //     }
                // }

                //if COD, then check if wallet is present
                if ($order->payment_mode == 'COD') {
                    if ($order->wallet_amount != null) {
                        //refund wallet amount
                        $customer->deposit($order->wallet_amount * 100, ['description' => $translationData->orderPartialRefundWalletComment . $order->unique_order_id]);
                    }
                } else {
                    //if online payment, refund the total to wallet
                    $customer->deposit(($order->total) * 100, ['description' => $translationData->orderRefundWalletComment . $order->unique_order_id]);
                }

                //show notification to user
                if (config('appSettings.enablePushNotificationOrders') == 'true') {
                    //to user
                    $notify = new PushNotify();
                    $notify->sendPushNotification('6', $order->user_id, $order->unique_order_id);
                }

                if (\Illuminate\Support\Facades\Request::ajax()) {
                    return response()->json(['success' => true]);
                } else {
                    return redirect()->back()->with(array('success' => __('storeDashboard.orderCanceledNotification')));
                }
            }
        } else {
            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => false], 406);
            } else {
                return redirect()->back()->with(array('message' => __('storeDashboard.orderSomethingWentWrongNotification')));
            }
        }
    }

    /**
     * @param Request $request
     */
    public function updateRestaurantScheduleData(Request $request)
    {
        $data = $request->except(['_token', 'restaurant_id']);

        $i = 0;
        $str = '{';
        foreach ($data as $day => $times) {
            $str .= '"' . $day . '":[';
            if ($times) {
                foreach ($times as $key => $time) {

                    if ($key % 2 == 0) {
                        $t1 = $time;
                        $str .= '{"open" :' . '"' . $time . '"';
                    } else {
                        $t2 = $time;
                        $str .= '"close" :' . '"' . $time . '"}';
                    }

                    //check if last, if last then dont add comma,
                    if (count($times) != $key + 1) {
                        $str .= ',';
                    }
                }
                // dd($t1);
                if (Carbon::parse($t1) >= Carbon::parse($t2)) {

                    return redirect()->back()->with(['message' => 'Opening and Closing time is incorrect']);
                }
            } else {
                $str .= '}]';
            }

            if ($i != count($data) - 1) {
                $str .= '],';
            } else {
                $str .= ']';
            }
            $i++;
        }
        $str .= '}';

        // Fetches The Restaurant
        $restaurant = Restaurant::where('id', $request->restaurant_id)->first();
        // Enters The Data
        $restaurant->schedule_data = $str;
        // Saves the Data to Database
        $restaurant->save();

        return redirect()->back()->with(['success' => 'Scheduling data saved successfully']);
    }

    /**
     * @param Request $request
     */
    public function checkOrderStatusNewOrder(Request $request)
    {
        $order = Order::where('unique_order_id', $request->order_id)->firstOrFail();

        if ($order->orderstatus_id != 1) {
            $data = [
                'reloadPage' => true,
            ];
        } else {
            $data = [
                'reloadPage' => false,
            ];
        }
        return response()->json($data);
    }

    /**
     * @param Request $request
     */
    public function checkOrderStatusSelfPickupOrder(Request $request)
    {
        $order = Order::where('unique_order_id', $request->order_id)->firstOrFail();
        if ($request->processSelfPickup) {
            if ($order->orderstatus_id == 5) {
                $data = [
                    'reloadPage' => true,
                ];
            } else {
                $data = [
                    'reloadPage' => false,
                ];
            }
        } else {
            if ($order->orderstatus_id == 2) {
                $data = [
                    'reloadPage' => false,
                ];
            } else {
                $data = [
                    'reloadPage' => true,
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * @param $order_id
     * @param $printerSetting
     */
    private function printInvoice($order_id, $printerSetting = null)
    {
        if (Module::find('ThermalPrinter') && Module::find('ThermalPrinter')->isEnabled()) {
            try {
                $print = new ThermalPrinter();
                $print->printInvoice($order_id);
            } catch (Exception $e) {
                \Session::flash('message', 'Printing Failed. Connection could not be established.');
            }
        }
    }

    /**
     * @param Request $request
     */
    public function updateStorePayoutDetails(Request $request)
    {
        $storePayoutDetail = StorePayoutDetail::where('restaurant_id', $request->restaurant_id)->first();
        if ($storePayoutDetail) {
            $storePayoutDetail->data = json_encode($request->except(['restaurant_id', '_token']));
        } else {
            $storePayoutDetail = new StorePayoutDetail();
            $storePayoutDetail->restaurant_id = $request->restaurant_id;
            $storePayoutDetail->data = json_encode($request->except(['restaurant_id', '_token']));
        }
        try {
            $storePayoutDetail->save();
            return redirect()->back()->with(['success' => 'Payout Data Saved']);
        } catch (\Illuminate\Database\QueryException $qe) {
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }

    }

    /**
     * @param $restaurant_id
     * @return mixed
     */
    public function sortMenusAndItems($restaurant_id)
    {
        $user = Auth::user();
        $restaurantIds = $user->restaurants->pluck('id')->toArray();

        $restaurant = Restaurant::where('id', $restaurant_id)->whereIn('id', $restaurantIds)->firstOrFail();

        $items = Item::where('restaurant_id', $restaurant_id)
            ->join('item_categories', function ($join) {
                $join->on('items.item_category_id', '=', 'item_categories.id');
            })
            ->orderBy('item_categories.order_column', 'asc')
            ->with('addon_categories')
            ->ordered()
            ->get(array('items.*', 'item_categories.name as category_name'));

        $itemsArr = [];
        foreach ($items as $item) {
            $itemsArr[$item['category_name']][] = $item;
        }

        // dd($itemsArr);
        $itemCategories = ItemCategory::whereHas('items', function ($query) use ($restaurant_id) {
            return $query->where('restaurant_id', $restaurant_id);
        })->ordered()->get();

        $count = 0;

        return view('restaurantowner.sortMenusAndItemsForStore', array(
            'restaurant' => $restaurant,
            'items' => $itemsArr,
            'itemCategories' => $itemCategories,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function updateItemPositionForStore(Request $request)
    {
        Item::setNewOrder($request->newOrder);
        Artisan::call('cache:clear');
        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     */
    public function updateMenuCategoriesPositionForStore(Request $request)
    {
        ItemCategory::setNewOrder($request->newOrder);
        Artisan::call('cache:clear');
        return response()->json(['success' => true]);
    }

    /**
     * @param $restaurant_id
     */
    public function ratings($restaurant_id = null)
    {
        $user = Auth::user();
        if ($restaurant_id) {

            $restaurant = $user->restaurants;
            $restaurantIds = $user->restaurants->pluck('id')->toArray();

            $restaurant = Restaurant::where('id', $restaurant_id)->with('ratings')->firstOrFail();
            $averageRating = number_format((float) $restaurant->ratings->avg('rating_store'), 1, '.', '');

            return view('restaurantowner.ratings', array(
                'restaurant' => $restaurant,
                'reviews' => $restaurant->ratings,
                'averageRating' => $averageRating,
            ));

        } else {

            $restaurants = $user->restaurants;

            return view('restaurantowner.ratings', array(
                'restaurants' => $restaurants,
            ));
        }

    }
};
