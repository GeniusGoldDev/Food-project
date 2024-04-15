<?php

namespace App\Http\Controllers;

use App\AcceptDelivery;
use App\Addon;
use App\AddonCategory;
use App\DeliveryGuyDetail;
use App\Helpers\TranslationHelper;
use App\Http\Middleware\SCLC;
use App\Http\Middleware\SCLCC;
use App\Http\Middleware\SelfHelpM;
use App\Item;
use App\ItemCategory;
use App\Order;
use App\Orderstatus;
use App\Page;
use App\PaymentGateway;
use App\PopularGeoPlace;
use App\PromoSlider;
use App\PushNotify;
use App\Rating;
use App\Restaurant;
use App\RestaurantCategory;
use App\RestaurantPayout;
use App\Setting;
use App\Slide;
use App\Sms;
use App\SmsGateway;
use App\StorePayoutDetail;
use App\Translation;
use App\User;
use Artisan;
use Auth;
use Bavix\Wallet\Models\Transaction;
use Carbon\Carbon;
use DotenvEditor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Image;
use Ixudra\Curl\Facades\Curl;
use Omnipay\Omnipay;
use OneSignal;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    /**
     * @return mixed
     */
    public function dashboard(Request $request)
    {
        $displayUsers = User::count();

        $displayRestaurants = Restaurant::count();

        $displaySales = Order::where('orderstatus_id', 5)->get();
        $displayEarnings = $displaySales;

        $displaySales = count($displaySales);

        $total = 0;
        foreach ($displayEarnings as $de) {
            $total += $de->total;
        }
        $displayEarnings = $total;

        $orders = Order::orderBy('id', 'DESC')->with('orderstatus', 'restaurant')->take(10)->get();

        $users = User::orderBy('id', 'DESC')->with('roles')->take(9)->get();

        $todaysDate = Carbon::now()->format('Y-m-d');

        $orderStatusesName = '[';

        $orderStatuses = Orderstatus::get(['name'])
            ->pluck('name')
            ->toArray();
        foreach ($orderStatuses as $key => $value) {
            $orderStatusesName .= "'" . $value . "', ";
        }
        $orderStatusesName = rtrim($orderStatusesName, ' ,');
        $orderStatusesName = $orderStatusesName . ']';

        $ifAnyOrders = Order::count();
        if ($ifAnyOrders == 0) {
            $ifAnyOrders = false;
        } else {
            $ifAnyOrders = true;
        }

        $orderStatusOrders = Order::select('orderstatus_id', DB::raw('count(*) as total'))
            ->groupBy('orderstatus_id')
            ->pluck('total', 'orderstatus_id')->all();

        $orderStatusesData = '[';
        foreach ($orderStatusOrders as $key => $value) {
            if ($key == 1) {
                $orderStatusesData .= '{value:' . $value . ", name:'Order Placed'}, ";
            }
            if ($key == 2) {
                $orderStatusesData .= '{value:' . $value . ", name:'Preparing Order'}, ";
            }
            if ($key == 3) {
                $orderStatusesData .= '{value:' . $value . ", name:'Delivery Guy Assigned'}, ";
            }
            if ($key == 4) {
                $orderStatusesData .= '{value:' . $value . ", name:'Order Picked Up'}, ";
            }
            if ($key == 5) {
                $orderStatusesData .= '{value:' . $value . ", name:'Delivered'}, ";
            }
            if ($key == 6) {
                $orderStatusesData .= '{value:' . $value . ", name:'Canceled'}, ";
            }
            if ($key == 7) {
                $orderStatusesData .= '{value:' . $value . ", name:'Ready For Pick Up'}, ";
            }
            if ($key == 8) {
                $orderStatusesData .= '{value:' . $value . ", name:'Awaiting Payment'}, ";
            }
            if ($key == 9) {
                $orderStatusesData .= '{value:' . $value . ", name:'Payment Failed'}, ";
            }
        }
        $orderStatusesData = rtrim($orderStatusesData, ',');
        $orderStatusesData .= ']';

        return view('admin.dashboard', array(
            'displayUsers' => $displayUsers,
            'displayRestaurants' => $displayRestaurants,
            'displaySales' => $displaySales,
            'displayEarnings' => number_format((float) $displayEarnings, 2, '.', ''),
            'orders' => $orders,
            'users' => $users,
            'todaysDate' => $todaysDate,
            'orderStatusesName' => $orderStatusesName,
            'orderStatusesData' => $orderStatusesData,
            'ifAnyOrders' => $ifAnyOrders,
        ));
    }

    public function manager()
    {
        return view('admin.manager');
    }

    public function users()
    {
        $roles = Role::all()->except(1);
        return view('admin.users', array(
            'roles' => $roles,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewUser(Request $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'delivery_pin' => strtoupper(str_random(5)),
                'password' => \Hash::make($request->password),
            ]);

            if ($request->has('role')) {
                $user->assignRole($request->role);
            }

            if ($user->hasRole('Delivery Guy')) {

                $deliveryGuyDetails = new DeliveryGuyDetail();
                $deliveryGuyDetails->name = $request->delivery_name;
                $deliveryGuyDetails->age = $request->delivery_age;
                if ($request->hasFile('delivery_photo')) {
                    $photo = $request->file('delivery_photo');
                    $filename = time() . str_random(10) . '.' . strtolower($photo->getClientOriginalExtension());
                    Image::make($photo)->resize(250, 250)->save(base_path('/assets/img/delivery/' . $filename));
                    $deliveryGuyDetails->photo = $filename;
                }
                $deliveryGuyDetails->description = $request->delivery_description;
                $deliveryGuyDetails->vehicle_number = $request->delivery_vehicle_number;
                if ($request->delivery_commission_rate != null) {
                    $deliveryGuyDetails->commission_rate = $request->delivery_commission_rate;
                }
                if ($request->tip_commission_rate != null) {
                    $deliveryGuyDetails->tip_commission_rate = $request->tip_commission_rate;
                }
                $deliveryGuyDetails->save();
                $user->delivery_guy_detail_id = $deliveryGuyDetails->id;
                $user->save();

            }

            return redirect()->back()->with(['success' => 'User Created']);
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
    public function getEditUser($id)
    {
        $user = User::where('id', $id)->with('orders')->first();
        $roles = Role::all()->except(1);

        $ratings = Rating::where('delivery_id', $user->id)->get();

        return view('admin.editUser', array(
            'orders' => $user->orders,
            'user' => $user,
            'roles' => $roles,
            'rating' => deliveryAvgRating($ratings),
        ));
    }

    /**
     * @param Request $request
     */
    public function updateUser(Request $request)
    {
        // dd($request->all());
        $user = User::where('id', $request->id)->first();
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->has('password') && $request->password != null) {
                $user->password = \Hash::make($request->password);
            }
            if ($request->roles != null) {
                $user->syncRoles($request->roles);
            }
            $user->save();

            if ($user->hasRole('Delivery Guy')) {

                if ($user->delivery_guy_detail == null) {

                    $deliveryGuyDetails = new DeliveryGuyDetail();
                    $deliveryGuyDetails->name = $request->delivery_name;
                    $deliveryGuyDetails->age = $request->delivery_age;
                    if ($request->hasFile('delivery_photo')) {
                        $photo = $request->file('delivery_photo');
                        $filename = time() . str_random(10) . '.' . strtolower($photo->getClientOriginalExtension());
                        Image::make($photo)->resize(250, 250)->save(base_path('/assets/img/delivery/' . $filename));
                        $deliveryGuyDetails->photo = $filename;
                    }
                    $deliveryGuyDetails->description = $request->delivery_description;
                    $deliveryGuyDetails->vehicle_number = $request->delivery_vehicle_number;

                    if ($request->delivery_commission_rate != null) {
                        $deliveryGuyDetails->commission_rate = $request->delivery_commission_rate;
                    }

                    if ($request->tip_commission_rate != null) {
                        $deliveryGuyDetails->tip_commission_rate = $request->tip_commission_rate;
                    }

                    if ($request->is_notifiable == 'true') {
                        $deliveryGuyDetails->is_notifiable = true;
                    } else {
                        $deliveryGuyDetails->is_notifiable = false;
                    }

                    if ($request->max_accept_delivery_limit != null) {
                        $deliveryGuyDetails->max_accept_delivery_limit = $request->max_accept_delivery_limit;
                    }

                    $deliveryGuyDetails->save();
                    $user->delivery_guy_detail_id = $deliveryGuyDetails->id;
                    $user->save();
                } else {
                    $user->delivery_guy_detail->name = $request->delivery_name;
                    $user->delivery_guy_detail->age = $request->delivery_age;
                    if ($request->hasFile('delivery_photo')) {
                        $photo = $request->file('delivery_photo');
                        $filename = time() . str_random(10) . '.' . strtolower($photo->getClientOriginalExtension());
                        Image::make($photo)->resize(250, 250)->save(base_path('/assets/img/delivery/' . $filename));
                        $user->delivery_guy_detail->photo = $filename;
                    }
                    $user->delivery_guy_detail->description = $request->delivery_description;
                    $user->delivery_guy_detail->vehicle_number = $request->delivery_vehicle_number;
                    if ($request->delivery_commission_rate != null) {
                        $user->delivery_guy_detail->commission_rate = $request->delivery_commission_rate;
                    }
                    if ($request->tip_commission_rate != null) {
                        $user->delivery_guy_detail->tip_commission_rate = $request->tip_commission_rate;
                    }
                    if ($request->is_notifiable == 'true') {
                        $user->delivery_guy_detail->is_notifiable = true;
                    } else {
                        $user->delivery_guy_detail->is_notifiable = false;
                    }

                    if ($request->max_accept_delivery_limit != null) {
                        $user->delivery_guy_detail->max_accept_delivery_limit = $request->max_accept_delivery_limit;
                    }

                    $user->delivery_guy_detail->save();
                }
            }

            return redirect(route('admin.get.editUser', $user->id) . $request->window_redirect_hash)->with(['success' => 'User Updated']);
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
    public function banUser($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->toggleActive()->save();
        return redirect()->back()->with(['success' => 'Operation Successful']);
    }

    /**
    * @param $id
    */
   public function deleteUser($id)
   {
       $user = User::find($id);

       if ($user) {
           $user->delete();
           return response()->json(['success' => true]);
       } else {
           return redirect()->route('admin.user');
       }
   }


    public function manageDeliveryGuys()
    {
        return view('admin.manageDeliveryGuys');
    }

    /**
     * @param $id
     */
    public function getManageDeliveryGuysRestaurants($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->hasRole('Delivery Guy')) {
            $userRestaurants = $user->restaurants;
            $userRestaurantsIds = $user->restaurants->pluck('id')->toArray();

            $allRestaurants = Restaurant::get();

            return view('admin.manageDeliveryGuysRestaurants', array(
                'user' => $user,
                'userRestaurants' => $userRestaurants,
                'allRestaurants' => $allRestaurants,
                'userRestaurantsIds' => $userRestaurantsIds,
            ));
        }
    }

    /**
     * @param Request $request
     */
    public function updateDeliveryGuysRestaurants(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->restaurants()->sync($request->user_restaurants);
        $user->save();
        return redirect()->back()->with(['success' => 'Delivery Guy Updated']);
    }

    public function manageRestaurantOwners()
    {
        $users = User::role('Store Owner')->orderBy('id', 'DESC')->with('roles')->paginate(20);
        $count = $users->total();

        return view('admin.manageRestaurantOwners', array(
            'users' => $users,
            'count' => $count,
        ));
    }

    /**
     * @param $id
     */
    public function getManageRestaurantOwnersRestaurants($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->hasRole('Store Owner')) {
            $userRestaurants = $user->restaurants;
            $userRestaurantsIds = $user->restaurants->pluck('id')->toArray();
            $allRestaurants = Restaurant::get();

            return view('admin.manageRestaurantOwnersRestaurants', array(
                'user' => $user,
                'userRestaurants' => $userRestaurants,
                'allRestaurants' => $allRestaurants,
                'userRestaurantsIds' => $userRestaurantsIds,
            ));
        }
    }

    /**
     * @param Request $request
     */
    public function updateManageRestaurantOwnersRestaurants(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->restaurants()->sync($request->user_restaurants);
        $user->save();
        return redirect()->back()->with(['success' => 'Store Owner Updated']);
    }

    public function orders()
    {
        return view('admin.orders');
    }

    /**
     * @param $order_id
     */
    public function viewOrder($order_id)
    {
        $order = Order::where('unique_order_id', $order_id)->with('orderitems.order_item_addons', 'rating')->first();
        $users = User::role('Delivery Guy')->get();
        if ($order) {
            return view('admin.viewOrder', array(
                'order' => $order,
                'users' => $users,
            ));
        } else {
            return redirect()->route('admin.orders');
        }
    }
    /**
     * @param $order_id
     */
    public function printThermalBill($order_id)
    {
        $order = Order::where('unique_order_id', $order_id)->with('orderitems.order_item_addons')->first();
        $users = User::role('Delivery Guy')->get();
        if ($order) {
            return view('admin.printOrder', array(
                'order' => $order,
                'users' => $users,
            ));
        } else {
            return redirect()->route('admin.orders');
        }
    }

    public function sliders()
    {
        $sliders = PromoSlider::orderBy('id', 'DESC')->with('slides')->get();
        $count = count($sliders);
        return view('admin.sliders', array(
            'sliders' => $sliders,
            'count' => $count,
        ));
    }

    /**
     * @param $id
     */
    public function getEditSlider($id)
    {
        $restaurants = Restaurant::with('items')->get();
        $slider = PromoSlider::where('id', $id)->with('slides')->firstOrFail();
        $slides = $slider->slides;
        foreach ($slides as $slide) {
            if ($slide->model == null) {
                $link = 'Not Linked';
            }
            if ($slide->model == 1) {
                $slideRestaurant = $slide->restaurant;
                if ($slideRestaurant) {
                    $link = 'Linked to: ' . $slideRestaurant->name;
                } else {
                    $link = 'Not Linked';
                }
            }

            if ($slide->model == 2) {
                $slideItem = $slide->item;
                if ($slideItem) {
                    $link = 'Linked to item: ' . $slideItem->name . ' from Store: ' . $slideItem->restaurant->name;
                } else {
                    $link = 'Not Linked';
                }
            }

            if ($slide->model == 3) {
                if ($slide->url != null) {
                    $link = 'Linked to: ' . $slide->url;
                } else {
                    $link = 'Not Linked';
                }
            }

            $slide->link = $link;
        }
        if ($slider) {
            return view('admin.editSlider', array(
                'restaurants' => $restaurants,
                'slider' => $slider,
                'slides' => $slides,
            ));
        } else {
            return redirect()->route('admin.sliders');
        }
    }

    /**
     * @param Request $request
     */
    public function updateSlider(Request $request)
    {
        $slider = PromoSlider::where('id', $request->id)->first();
        $slider->name = $request->name;
        $slider->position_id = $request->position_id;
        $slider->size = $request->size;

        $slider->save();

        return redirect()->back()->with(['success' => 'Slider Updated']);

    }

    /**
     * @param Request $request
     */
    public function createSlider(Request $request)
    {
        $sliderCount = PromoSlider::where('is_active', 1)->count();

        if ($sliderCount >= 2) {
            return redirect()->back()->with(['message' => 'Only two sliders can be created. Disbale or delete some Sliders to create more.']);
        }

        $slider = new PromoSlider();
        $slider->name = $request->name;
        $slider->location_id = '0';
        $slider->position_id = $request->position_id;
        $slider->size = $request->size;
        $slider->save();
        return redirect()->back()->with(['success' => 'New Slider Created']);
    }

    /**
     * @param $id
     */
    public function disableSlider($id)
    {
        $slider = PromoSlider::where('id', $id)->first();
        if ($slider) {
            $slider->toggleActive()->save();
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('admin.sliders');
        }
    }

    /**
     * @param $id
     */
    public function deleteSlider($id)
    {
        $slider = PromoSlider::where('id', $id)->first();
        if ($slider) {
            $slides = $slider->slides;
            foreach ($slides as $slide) {
                $slide->delete();
            }
            $slider->delete();
            return redirect()->route('admin.sliders')->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('admin.sliders');
        }
    }

    /**
     * @param Request $request
     */
    public function saveSlide(Request $request)
    {
        $url = url('/');
        $url = substr($url, 0, strrpos($url, '/')); //this will give url without " / "

        $slide = new Slide();
        $slide->promo_slider_id = $request->promo_slider_id;
        $slide->name = $request->name;
        $slide->url = $request->url;

        $image = $request->file('image');
        $rand_name = time() . str_random(10);
        $filename = $rand_name . '.' . $image->getClientOriginalExtension();

        Image::make($image)
            ->resize(384, 384)
            ->save(base_path('assets/img/slider/' . $filename));
        $slide->image = '/assets/img/slider/' . $filename;

        $slide->model = $request->model;
        $slide->restaurant_id = $request->restaurant_id;
        $slide->item_id = $request->item_id;
        $slide->url = $request->customUrl;

        if ($request->customUrl != null) {
            if ($request->is_locationset == 'true') {
                $slide->is_locationset = true;
            } else {
                $slide->is_locationset = false;
            }

            $slide->latitude = $request->latitude;
            $slide->longitude = $request->longitude;
            $slide->radius = $request->radius;

        }

        $slide->save();

        return redirect()->back()->with(['success' => 'New Slide Created']);
    }

    /**
     * @param $id
     */
    public function editSlide($id)
    {
        $slide = Slide::where('id', $id)->with('promo_slider')->first();

        if ($slide) {
            if ($slide->model == null) {
                $link = null;
            }
            if ($slide->model == 1) {
                $slideRestaurant = $slide->restaurant;
                if ($slideRestaurant) {
                    $link = '<b>Store - </b>' . $slideRestaurant->name;
                } else {
                    $link = null;
                }
            }

            if ($slide->model == 2) {
                $slideItem = $slide->item;
                if ($slideItem) {
                    $link = '<b>Item - </b>' . $slideItem->name . '<br><b> From Store - </b>' . $slideItem->restaurant->name;
                } else {
                    $link = null;
                }
            }

            if ($slide->model == 3) {
                if ($slide->url != null) {
                    $link = '<b>Custom URL - </b>' . $slide->url;
                } else {
                    $link = null;
                }
            }

            $restaurants = Restaurant::with('items')->get();
            return view('admin.editSlide', array(
                'slide' => $slide,
                'restaurants' => $restaurants,
                'link' => $link,
            ));
        } else {
            return redirect()->route('admin.sliders')->with(['message' => 'Slide Not Found']);
        }
    }

    /**
     * @param Request $request
     */
    public function updateSlide(Request $request)
    {
        // dd($request->all());
        $slide = Slide::where('id', $request->id)->first();
        if ($slide) {
            $slide->name = $request->name;

            if ($request->hasFile('image')) {

                $image = $request->file('image');
                $rand_name = time() . str_random(10);
                $filename = $rand_name . '.' . $image->getClientOriginalExtension();
                Image::make($image)
                    ->resize(384, 384)
                    ->save(base_path('assets/img/slider/' . $filename));
                $slide->image = '/assets/img/slider/' . $filename;
            }

            if ($request->model != null) {
                $slide->model = $request->model;
                $slide->restaurant_id = $request->restaurant_id;
                $slide->item_id = $request->item_id;
                $slide->url = $request->customUrl;

                if ($request->customUrl != null) {
                    if ($request->is_locationset == 'true') {
                        $slide->is_locationset = true;
                    } else {
                        $slide->is_locationset = false;
                    }

                    $slide->latitude = $request->latitude;
                    $slide->longitude = $request->longitude;
                    $slide->radius = $request->radius;

                }
            }

            $slide->save();
            return redirect()->back()->with(['success' => 'Slide Updated']);
        } else {
            return redirect()->route('admin.sliders')->with(['message' => 'Slide Not Found']);
        }
    }

    /**
     * @param Request $request
     */
    public function updateSlidePosition(Request $request)
    {
        Slide::setNewOrder($request->newOrder);
        Artisan::call('cache:clear');
        return response()->json(['success' => true]);
    }

    /**
     * @param $id
     */
    public function deleteSlide($id)
    {
        $slide = Slide::where('id', $id)->first();
        if ($slide) {
            $slide->delete();
            return redirect()->back()->with(['success' => 'Deleted']);
        } else {
            return redirect()->route('admin.sliders');
        }
    }

    /**
     * @param $id
     */
    public function disableSlide($id)
    {
        $slide = Slide::where('id', $id)->first();
        if ($slide) {
            $slide->toggleActive()->save();
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('admin.sliders');
        }
    }

    public function restaurants()
    {

        $dapCheck = false;
        if (\Module::find('DeliveryAreaPro') && \Module::find('DeliveryAreaPro')->isEnabled()) {
            $restaurants = Restaurant::where('is_accepted', '1')->with('users.roles', 'delivery_areas')->ordered()->paginate(20);
            $count = $restaurants->total();
            $dapCheck = true;
        } else {
            $restaurants = Restaurant::where('is_accepted', '1')->with('users.roles')->ordered()->paginate(20);
            $count = $restaurants->total();
        }

        return view('admin.restaurants', array(
            'restaurants' => $restaurants,
            'count' => $count,
            'dapCheck' => $dapCheck,
        ));
    }

    public function sortStores()
    {
        $restaurants = Restaurant::where('is_accepted', '1')->with('users.roles')->ordered()->get();
        $count = $restaurants->count();

        $dapCheck = false;
        if (\Module::find('DeliveryAreaPro') && \Module::find('DeliveryAreaPro')->isEnabled()) {
            $dapCheck = true;
        }

        return view('admin.sortStores', array(
            'restaurants' => $restaurants,
            'count' => $count,
            'dapCheck' => $dapCheck,
        ));
    }

    /**
     * @param Request $request
     */
    public function updateStorePosition(Request $request)
    {
        Restaurant::setNewOrder($request->newOrder);
        Artisan::call('cache:clear');
        return response()->json(['success' => true]);
    }

    /**
     * @param $restaurant_id
     */
    public function sortMenusAndItems($restaurant_id)
    {

        $restaurant = Restaurant::where('id', $restaurant_id)->firstOrFail();

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

        return view('admin.sortMenusAndItemsForStore', array(
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

    public function pendingAcceptance()
    {
        $count = Restaurant::count();
        $restaurants = Restaurant::orderBy('id', 'DESC')->where('is_accepted', '0')->with('users.roles')->paginate(10000);
        $count = count($restaurants);

        $dapCheck = false;
        if (\Module::find('DeliveryAreaPro') && \Module::find('DeliveryAreaPro')->isEnabled()) {
            $dapCheck = true;
        }

        return view('admin.restaurants', array(
            'restaurants' => $restaurants,
            'count' => $count,
            'dapCheck' => $dapCheck,
        ));
    }

    /**
     * @param $id
     */
    public function acceptRestaurant($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if ($restaurant) {
            $restaurant->toggleAcceptance()->save();
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('admin.restaurants');
        }
    }

    /**
     * @param Request $request
     */
    public function searchRestaurants(Request $request)
    {
        $query = $request['query'];

        $restaurants = Restaurant::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('sku', 'LIKE', '%' . $query . '%')->with('users.roles')->paginate(20);

        $count = $restaurants->total();

        $dapCheck = false;
        if (\Module::find('DeliveryAreaPro') && \Module::find('DeliveryAreaPro')->isEnabled()) {
            $dapCheck = true;
        }

        return view('admin.restaurants', array(
            'restaurants' => $restaurants,
            'query' => $query,
            'count' => $count,
            'dapCheck' => $dapCheck,
        ));
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
            return redirect()->route('admin.restaurants');
        }
    }

    /**
     * @param $id
     */
    public function deleteRestaurant($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if ($restaurant) {
            $items = $restaurant->items;
            foreach ($items as $item) {
                $item->delete();
            }
            $restaurant->delete();
            return redirect()->route('admin.restaurants');
        } else {
            return redirect()->route('admin.restaurants');
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

        $restaurant->rating = $request->rating;
        $restaurant->delivery_time = $request->delivery_time;
        $restaurant->price_range = $request->price_range;

        if ($request->is_pureveg == 'true') {
            $restaurant->is_pureveg = true;
        } else {
            $restaurant->is_pureveg = false;
        }

        if ($request->is_featured == 'true') {
            $restaurant->is_featured = true;
        } else {
            $restaurant->is_featured = false;
        }

        $restaurant->slug = str_slug($request->name) . '-' . str_random(15);
        $restaurant->certificate = $request->certificate;

        $restaurant->address = $request->address;
        $restaurant->pincode = $request->pincode;
        $restaurant->landmark = $request->landmark;
        $restaurant->latitude = $request->latitude;
        $restaurant->longitude = $request->longitude;

        $restaurant->restaurant_charges = $request->restaurant_charges;
        $restaurant->delivery_charges = $request->delivery_charges;
        $restaurant->commission_rate = $request->commission_rate;

        if ($request->has('delivery_type')) {
            $restaurant->delivery_type = $request->delivery_type;
        }

        if ($request->delivery_charge_type == 'FIXED') {
            $restaurant->delivery_charge_type = 'FIXED';
            $restaurant->delivery_charges = $request->delivery_charges;
        }
        if ($request->delivery_charge_type == 'DYNAMIC') {
            $restaurant->delivery_charge_type = 'DYNAMIC';
            $restaurant->base_delivery_charge = $request->base_delivery_charge;
            $restaurant->base_delivery_distance = $request->base_delivery_distance;
            $restaurant->extra_delivery_charge = $request->extra_delivery_charge;
            $restaurant->extra_delivery_distance = $request->extra_delivery_distance;
        }
        if ($request->delivery_radius != null) {
            $restaurant->delivery_radius = $request->delivery_radius;
        }

        $restaurant->sku = time() . str_random(10);
        $restaurant->is_active = 0;
        $restaurant->is_accepted = 1;

        $restaurant->min_order_price = $request->min_order_price;

        try {
            $restaurant->save();
            return redirect()->back()->with(['success' => 'Restaurant Saved']);
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
    public function getRestaurantItems($id)
    {
        $items = Item::where('restaurant_id', $id)->orderBy('id', 'DESC')->with('item_category', 'restaurant')->paginate(20);
        $count = $items->total();

        $restaurants = Restaurant::all();
        $itemCategories = ItemCategory::where('is_enabled', '1')->get();
        $addonCategories = AddonCategory::all();

        return view('admin.items', array(
            'items' => $items,
            'count' => $count,
            'restaurants' => $restaurants,
            'itemCategories' => $itemCategories,
            'addonCategories' => $addonCategories,
            'restaurant_id' => $id,
        ));

    }

    /**
     * @param $id
     */
    public function getEditRestaurant($id)
    {
        $restaurant = Restaurant::where('id', $id)->with('users.roles', 'delivery_areas')->ordered()->first();

        $restaurantCategories = RestaurantCategory::where('is_active', '1')->get();

        $dapCheck = false;
        if (\Module::find('DeliveryAreaPro') && \Module::find('DeliveryAreaPro')->isEnabled()) {
            $dapCheck = true;
        }

        $adminPaymentGateways = PaymentGateway::where('is_active', '1')->get();

        $payoutData = StorePayoutDetail::where('restaurant_id', $id)->first();
        if ($payoutData) {
            $payoutData = json_decode($payoutData->data);
        } else {
            $payoutData = null;
        }

        return view('admin.editRestaurant', array(
            'restaurant' => $restaurant,
            'restaurantCategories' => $restaurantCategories,
            'schedule_data' => json_decode($restaurant->schedule_data),
            'dapCheck' => $dapCheck,
            'adminPaymentGateways' => $adminPaymentGateways,
            'payoutData' => $payoutData,
            'rating' => storeAvgRating($restaurant->ratings),
        ));
    }

    /**
     * @param Request $request
     */
    public function updateRestaurant(Request $request)
    {
        // dd($request->all());
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

            $restaurant->rating = $request->rating;
            $restaurant->delivery_time = $request->delivery_time;
            $restaurant->price_range = $request->price_range;

            if ($request->is_pureveg == 'true') {
                $restaurant->is_pureveg = true;
            } else {
                $restaurant->is_pureveg = false;
            }

            if ($request->is_featured == 'true') {
                $restaurant->is_featured = true;
            } else {
                $restaurant->is_featured = false;
            }

            $restaurant->certificate = $request->certificate;

            $restaurant->address = $request->address;
            $restaurant->pincode = $request->pincode;
            $restaurant->landmark = $request->landmark;
            $restaurant->latitude = $request->latitude;
            $restaurant->longitude = $request->longitude;

            $restaurant->restaurant_charges = $request->restaurant_charges;
            $restaurant->delivery_charges = $request->delivery_charges;
            $restaurant->commission_rate = $request->commission_rate;

            if ($request->has('delivery_type')) {
                $restaurant->delivery_type = $request->delivery_type;
            }

            if ($request->delivery_charge_type == 'FIXED') {
                $restaurant->delivery_charge_type = 'FIXED';
                $restaurant->delivery_charges = $request->delivery_charges;
            }
            if ($request->delivery_charge_type == 'DYNAMIC') {
                $restaurant->delivery_charge_type = 'DYNAMIC';
                $restaurant->base_delivery_charge = $request->base_delivery_charge;
                $restaurant->base_delivery_distance = $request->base_delivery_distance;
                $restaurant->extra_delivery_charge = $request->extra_delivery_charge;
                $restaurant->extra_delivery_distance = $request->extra_delivery_distance;
            }
            if ($request->delivery_radius != null) {
                $restaurant->delivery_radius = $request->delivery_radius;
            }

            $restaurant->min_order_price = $request->min_order_price;

            if ($request->is_schedulable == 'true') {
                $restaurant->is_schedulable = true;
            } else {
                $restaurant->is_schedulable = false;
            }

            if ($request->is_notifiable == 'true') {
                $restaurant->is_notifiable = true;
            } else {
                $restaurant->is_notifiable = false;
            }

            if ($request->auto_acceptable == 'true') {
                $restaurant->auto_acceptable = true;
            } else {
                $restaurant->auto_acceptable = false;
            }

            $restaurant->custom_message = $request->custom_message;

            try {
                if (isset($request->restaurant_category_restaurant)) {
                    $restaurant->restaurant_categories()->sync($request->restaurant_category_restaurant);
                }

                if ($request->store_payment_gateways == null) {
                    $restaurant->payment_gateways()->sync($request->store_payment_gateways);
                }

                if (isset($request->store_payment_gateways)) {
                    $restaurant->payment_gateways()->sync($request->store_payment_gateways);
                }

                $restaurant->save();

                try {

                    $restaurant->slug = Str::slug($request->store_url);
                    $restaurant->save();

                } catch (\Illuminate\Database\QueryException $qe) {
                    $errorCode = $qe->errorInfo[1];
                    if ($errorCode == 1062) {
                        return redirect()->back()->with(['message' => 'URL should be unique, it should not match with other store URLs']);
                    }
                    return redirect()->back()->with(['message' => $qe->getMessage()]);
                }
                // dd('here');
                // return redirect()->back()->with(['success' => 'Store Updated']);
                return redirect(route('admin.get.editRestaurant', $restaurant->id) . $request->window_redirect_hash)->with(['success' => 'Store Updated']);
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }

    /**
     * @param Request $request
     */
    public function updateSlug(Request $request)
    {
        $restaurant = Restaurant::where('id', $request->id)->firstOrFail();

        try {

            $restaurant->slug = Str::slug($request->store_url);
            $restaurant->save();
            return redirect()->back()->with(['success' => 'URL Updated']);

        } catch (\Illuminate\Database\QueryException $qe) {
            $errorCode = $qe->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with(['message' => 'URL should be unique, it should not match with other store URLs']);
            }
            return redirect()->back()->with(['message' => $qe->getMessage()]);
        } catch (Exception $e) {
            return redirect()->back()->with(['message' => $e->getMessage()]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message' => $th]);
        }

    }

    public function items()
    {
        $items = Item::orderBy('id', 'DESC')->with('item_category', 'restaurant')->paginate(20);
        $count = $items->total();

        $restaurants = Restaurant::all();
        $itemCategories = ItemCategory::where('is_enabled', '1')->get();
        $addonCategories = AddonCategory::all();

        return view('admin.items', array(
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
        $query = $request['query'];

        if ($request->has('restaurant_id')) {
            $items = Item::where('restaurant_id', $request->restaurant_id)
                ->where('name', 'LIKE', '%' . $query . '%')
                ->with('item_category', 'restaurant')
                ->paginate(20);
        } else {
            $items = Item::where('name', 'LIKE', '%' . $query . '%')
                ->with('item_category', 'restaurant')
                ->paginate(20);
        }

        $count = $items->total();

        $restaurants = Restaurant::get();
        $itemCategories = ItemCategory::where('is_enabled', '1')->get();
        $addonCategories = AddonCategory::all();

        return view('admin.items', array(
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
        $item = Item::where('id', $id)->first();
        $restaurants = Restaurant::get();
        $itemCategories = ItemCategory::where('is_enabled', '1')->get();
        $addonCategories = AddonCategory::all();

        return view('admin.editItem', array(
            'item' => $item,
            'restaurants' => $restaurants,
            'itemCategories' => $itemCategories,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param $id
     */
    public function disableItem($id)
    {
        $item = Item::where('id', $id)->first();
        if ($item) {
            $item->toggleActive()->save();
            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => true]);
            }
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('admin.items');
        }
    }

        /**
     * @param $id
     */
    public function deleteItem($id)
    {
        $item = Item::find($id);

        if ($item) {
            $item->delete();
            return response()->json(['success' => true]);
        } else {
            return redirect()->route('admin.items');
        }
    }

    /**
     * @param Request $request
     */
    public function updateItem(Request $request)
    {
        // dd($request->all());
        $item = Item::where('id', $request->id)->first();

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

                if ($request->addon_category_item == null) {
                    $item->addon_categories()->sync($request->addon_category_item);
                }

                if (isset($request->addon_category_item)) {
                    $item->addon_categories()->sync($request->addon_category_item);
                }

                return redirect()->back()->with(['success' => 'Item Updated']);

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
        $addonCategories = AddonCategory::orderBy('id', 'DESC')->paginate(20);
        $addonCategories->loadCount('addons');

        $count = $addonCategories->total();

        return view('admin.addonCategories', array(
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

        $addonCategories = AddonCategory::where('name', 'LIKE', '%' . $query . '%')->paginate(20);
        $addonCategories->loadCount('addons');

        $count = $addonCategories->total();

        return view('admin.addonCategories', array(
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
                    $addon->user_id = Auth::user()->id;
                    $addon->addon_category_id = $addonCategory->id;
                    $addon->save();
                }
            }
            return redirect()->route('admin.editAddonCategory', $addonCategory->id)->with(['success' => 'Addon Category Saved']);
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
        return view('admin.newAddonCategory');
    }

    /**
     * @param $id
     */
    public function deleteAddon($id)
    {
        $addon = Addon::find($id);
        $addon->delete();

        return redirect()->back()->with(['success' => 'Addon Deleted']);
    }

    /**
     * @param $id
     */
    public function getEditAddonCategory($id)
    {
        $addonCategory = AddonCategory::where('id', $id)->with('addons')->first();

        return view('admin.editAddonCategory', array(
            'addonCategory' => $addonCategory,
            'addons' => $addonCategory->addons,
        ));

    }

    /**
     * @param Request $request
     */
    public function updateAddonCategory(Request $request)
    {
        // dd($request->all());
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

        $addons = Addon::orderBy('id', 'DESC')->with('addon_category')->paginate(20);
        $count = $addons->total();

        $addonCategories = AddonCategory::all();

        return view('admin.addons', array(
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

        $addons = Addon::where('name', 'LIKE', '%' . $query . '%')->with('addon_category')->paginate(20);

        $count = $addons->total();

        $addonCategories = AddonCategory::all();

        return view('admin.addons', array(
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
        // dd($request->all());
        $addon = new Addon();

        $addon->name = $request->name;
        $addon->price = $request->price;
        $addon->user_id = Auth::user()->id;
        $addon->addon_category_id = $request->addon_category_id;

        try {
            $addon->save();
            return redirect()->back()->with(['success' => 'Addon Saved']);
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
    public function getEditAddon($id)
    {
        $addon = Addon::where('id', $id)->first();
        $addonCategories = AddonCategory::all();
        return view('admin.editAddon', array(
            'addon' => $addon,
            'addonCategories' => $addonCategories,
        ));
    }

    /**
     * @param Request $request
     */
    public function updateAddon(Request $request)
    {
        $addon = Addon::where('id', $request->id)->first();

        if ($addon) {

            $addon->name = $request->name;
            $addon->price = $request->price;
            $addon->addon_category_id = $request->addon_category_id;

            try {
                $addon->save();
                return redirect()->back()->with(['success' => 'Addon Updated']);
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
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
    public function addonsOfAddonCategory($id)
    {
        $addons = Addon::orderBy('id', 'DESC')->where('addon_category_id', $id)->with('addon_category')->paginate(20);
        $count = $addons->total();
        $addonCategories = AddonCategory::all();

        return view('admin.addons', array(
            'addons' => $addons,
            'count' => $count,
            'addonCategories' => $addonCategories,
        ));
    }

    public function itemcategories()
    {
        $itemCategories = ItemCategory::orderBy('id', 'DESC')->with('user')->get();
        $itemCategories->loadCount('items');

        $count = count($itemCategories);

        return view('admin.itemcategories', array(
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
            return redirect()->back()->with(['success' => 'Category Created']);
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
        $itemCategory = ItemCategory::where('id', $id)->first();
        if ($itemCategory) {
            $itemCategory->toggleEnable()->save();
            if (\Illuminate\Support\Facades\Request::ajax()) {
                return response()->json(['success' => true]);
            }
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('admin.itemcategories');
        }
    }

    /**
     * @param Request $request
     */
    public function updateItemCategory(Request $request)
    {
        $itemCategory = ItemCategory::where('id', $request->id)->firstOrFail();
        $itemCategory->name = $request->name;
        $itemCategory->save();
        return redirect()->back()->with(['success' => 'Operation Successful']);
    }

    public function pages()
    {
        $pages = Page::all();
        return view('admin.pages', array(
            'pages' => $pages,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewPage(Request $request)
    {
        $page = new Page();
        $page->name = $request->name;
        $page->slug = Str::slug($request->slug, '-');
        $page->body = $request->body;

        try {
            $page->save();
            return redirect()->back()->with(['success' => 'New Page Created']);
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
    public function getEditPage($id)
    {
        $page = Page::where('id', $id)->first();

        if ($page) {
            return view('admin.editPage', array(
                'page' => $page,
            ));
        } else {
            return redirect()->route('admin.pages');
        }
    }

    /**
     * @param Request $request
     */
    public function updatePage(Request $request)
    {
        $page = Page::where('id', $request->id)->first();

        if ($page) {
            $page->name = $request->name;
            $page->slug = Str::slug($request->slug, '-');
            $page->body = $request->body;
            try {
                $page->save();
                return redirect()->back()->with(['success' => 'Page Updated']);
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        } else {
            return redirect()->route('admin.pages');
        }
    }

    /**
     * @param $id
     */
    public function deletePage($id)
    {
        $page = Page::where('id', $id)->first();
        if ($page) {
            $page->delete();
            return redirect()->back()->with(['success' => 'Deleted']);
        } else {
            return redirect()->route('admin.pages');
        }
    }

    public function restaurantpayouts()
    {
        $count = RestaurantPayout::count();

        $restaurantPayouts = RestaurantPayout::orderBy('id', 'DESC')->paginate(20);

        return view('admin.restaurantPayouts', array(
            'restaurantPayouts' => $restaurantPayouts,
            'count' => $count,
        ));
    }

    /**
     * @param $id
     */
    public function viewRestaurantPayout($id)
    {
        $restaurantPayout = RestaurantPayout::where('id', $id)->first();

        if ($restaurantPayout) {

            $payoutData = StorePayoutDetail::where('restaurant_id', $restaurantPayout->restaurant->id)->first();
            if ($payoutData) {
                $payoutData = json_decode($payoutData->data);
            } else {
                $payoutData = null;
            }

            return view('admin.viewRestaurantPayout', array(
                'restaurantPayout' => $restaurantPayout,
                'payoutData' => $payoutData,
            ));
        }
    }

    /**
     * @param Request $request
     */
    public function updateRestaurantPayout(Request $request)
    {
        $restaurantPayout = RestaurantPayout::where('id', $request->id)->first();

        if ($restaurantPayout) {
            $restaurantPayout->status = $request->status;
            $restaurantPayout->transaction_mode = $request->transaction_mode;
            $restaurantPayout->transaction_id = $request->transaction_id;
            $restaurantPayout->message = $request->message;
            try {
                $restaurantPayout->save();
                return redirect()->back()->with(['success' => 'Restaurant Payout Updated']);
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }

        }
    }

    public function fixUpdateIssues()
    {
        try {

            $duplicates = AcceptDelivery::whereIn('order_id', function ($query) {
                $query->select('order_id')->from('accept_deliveries')->groupBy('order_id')->havingRaw('count(*) > 1');
            })->get();

            foreach ($duplicates as $duplicate) {

                if ($duplicate->is_completed == 0 && ($duplicate->order->orderstatus_id == 5 || $duplicate->order->orderstatus_id == 6)) {
                    //just delete
                    $duplicate->delete(); //delete the duplicate entry in db
                }

                if ($duplicate->is_completed == 0 && $duplicate->order->orderstatus_id == 3) {
                    //delete and change orderstatus to 2
                    $duplicate->order->orderstatus_id = 2; //change order status to not delivery assigned
                    $duplicate->order->save(); //save the order
                    $duplicate->delete(); //delete the duplicate entry in db
                }

            }

            // ** MIGRATE ** //
            //first migrate the db if any new db are avaliable...
            Artisan::call('migrate', [
                '--force' => true,
            ]);
            // ** MIGRATE END ** //

            // ** SETTINGS ** //
            $data = file_get_contents(storage_path('data/data.json'));
            $data = json_decode($data);
            $dbSet = [];
            foreach ($data as $s) {
                //check if the setting key already exists, if exists, do nothing..
                $settingAlreadyExists = Setting::where('key', $s->key)->first();
                //else create an array of settings which doesnt exists...
                if (!$settingAlreadyExists) {
                    $dbSet[] = [
                        'key' => $s->key,
                        'value' => $s->value,
                    ];
                }
            }
            //insert new settings keys into settings table.
            DB::table('settings')->insert($dbSet);
            // ** SETTINGS END ** //

            // ** PAYMENTGATEWAYS ** //
            // check if paystack is installed
            $hasPayStack = PaymentGateway::where('name', 'PayStack')->first();
            if (!$hasPayStack) {
                //if not, then install new payment gateway "PayStack"
                $payStackPaymentGateway = new PaymentGateway();
                $payStackPaymentGateway->name = 'PayStack';
                $payStackPaymentGateway->description = 'PayStack Payment Gateway';
                $payStackPaymentGateway->is_active = 0;
                $payStackPaymentGateway->save();
            }
            // check if razorpay is installed
            $hasRazorPay = PaymentGateway::where('name', 'Razorpay')->first();
            if (!$hasRazorPay) {
                //if not, then install new payment gateway "Razorpay"
                $razorPayPaymentGateway = new PaymentGateway();
                $razorPayPaymentGateway->name = 'Razorpay';
                $razorPayPaymentGateway->description = 'Razorpay Payment Gateway';
                $razorPayPaymentGateway->is_active = 0;
                $razorPayPaymentGateway->save();
            }
            // ** END PAYMENTGATEWAYS ** //

            $hasPayMongo = PaymentGateway::where('name', 'PayMongo')->first();
            if (!$hasPayMongo) {
                //if not, then install new payment gateway "PayMongo"
                $payMongoPaymentGateway = new PaymentGateway();
                $payMongoPaymentGateway->name = 'PayMongo';
                $payMongoPaymentGateway->description = 'PayMongo Payment Gateway';
                $payMongoPaymentGateway->is_active = 0;
                $payMongoPaymentGateway->save();
            }

            $hasMercadoPago = PaymentGateway::where('name', 'MercadoPago')->first();
            if (!$hasMercadoPago) {
                //if not, then install new payment gateway "MercadoPago"
                $mercadoPagoPaymentGateway = new PaymentGateway();
                $mercadoPagoPaymentGateway->name = 'MercadoPago';
                $mercadoPagoPaymentGateway->description = 'MercadoPago Payment Gateway';
                $mercadoPagoPaymentGateway->is_active = 0;
                $mercadoPagoPaymentGateway->save();
            }

            $hasPaytm = PaymentGateway::where('name', 'Paytm')->first();
            if (!$hasPaytm) {
                //if not, then install new payment gateway "MercadoPago"
                $paytmPaymentGateway = new PaymentGateway();
                $paytmPaymentGateway->name = 'Paytm';
                $paytmPaymentGateway->description = 'Paytm Payment Gateway';
                $paytmPaymentGateway->is_active = 0;
                $paytmPaymentGateway->save();
            }

            $hasFlutterwave = PaymentGateway::where('name', 'Flutterwave')->first();
            if (!$hasFlutterwave) {
                $flutterwavePaymentGateway = new PaymentGateway();
                $flutterwavePaymentGateway->name = 'Flutterwave';
                $flutterwavePaymentGateway->description = 'Flutterwave Payment Gateway';
                $flutterwavePaymentGateway->is_active = 0;
                $flutterwavePaymentGateway->save();
            }

            $hasKhalti = PaymentGateway::where('name', 'Khalti')->first();
            if (!$hasKhalti) {
                $khaltiPaymentGateway = new PaymentGateway();
                $khaltiPaymentGateway->name = 'Khalti';
                $khaltiPaymentGateway->description = 'Khalti Payment Gateway';
                $khaltiPaymentGateway->is_active = 0;
                $khaltiPaymentGateway->save();
            }

            $hasMsg91 = SmsGateway::where('gateway_name', 'MSG91')->first();
            if (!$hasMsg91) {
                //if not, then install new sms gateway gateway "MSG91"
                $msg91Gateway = new SmsGateway();
                $msg91Gateway->gateway_name = 'MSG91';
                $msg91Gateway->save();
            }

            $hasTwilio = SmsGateway::where('gateway_name', 'TWILIO')->first();
            if (!$hasTwilio) {
                //if not, then install new sms gateway gateway "TWILIO"
                $twilioGateway = new SmsGateway();
                $twilioGateway->gateway_name = 'TWILIO';
                $twilioGateway->save();
            }

            // ** ORDERSTATUS ** //
            DB::table('orderstatuses')->truncate();
            DB::statement("INSERT INTO `orderstatuses` (`id`, `name`) VALUES (1, 'Order Placed'), (2, 'Preparing Order'), (3, 'Delivery Guy Assigned'), (4, 'Order Picked Up'), (5, 'Delivered'), (6, 'Canceled'), (7, 'Ready For Pick Up'), (8, 'Awaiting Payment'), (9, 'Payment Failed')");

            /* Save new keys for translations languages */
            $langData = file_get_contents(storage_path('language/english.json'));
            $a1 = json_decode($langData, true);

            $translations = Translation::all();

            foreach ($translations as $translation) {
                //get the existing data of a translated language
                $a2 = json_decode($translation->data, true);

                //get the difference between the master file and the existing translation, and get the non-existing key
                $diff = array_diff_key($a1, $a2);

                //merge the non existing keys with the existing translation
                $merged = array_merge($a2, $diff);

                //save the translation
                $translation->data = json_encode($merged);
                $translation->save();
            }

            /* Create Permissions */
            Schema::disableForeignKeyConstraints();
            DB::table('permissions')->truncate();
            Schema::enableForeignKeyConstraints();

            app(PermissionRegistrar::class)->forgetCachedPermissions();

            Permission::create(['name' => 'dashboard_view', 'readable_name' => 'View Admin Dashboard']);

            Permission::create(['name' => 'stores_view', 'readable_name' => 'View Stores']);
            Permission::create(['name' => 'stores_edit', 'readable_name' => 'Edit Stores']);
            Permission::create(['name' => 'stores_sort', 'readable_name' => 'Sort Stores']);
            Permission::create(['name' => 'approve_stores', 'readable_name' => 'Approve Pending Stores']);
            Permission::create(['name' => 'stores_add', 'readable_name' => 'Add Store']);
            Permission::create(['name' => 'login_as_store_owner', 'readable_name' => 'Login as Store Owner']);

            Permission::create(['name' => 'addon_categories_view', 'readable_name' => 'View Addon Categories']);
            Permission::create(['name' => 'addon_categories_edit', 'readable_name' => 'Edit Addon Categories']);
            Permission::create(['name' => 'addon_categories_add', 'readable_name' => 'Add Addon Category']);

            Permission::create(['name' => 'addons_view', 'readable_name' => 'View Addons']);
            Permission::create(['name' => 'addons_edit', 'readable_name' => 'Edit Addons']);
            Permission::create(['name' => 'addons_add', 'readable_name' => 'Add Addon']);
            Permission::create(['name' => 'addons_actions', 'readable_name' => 'Addon Actions']);

            Permission::create(['name' => 'menu_categories_view', 'readable_name' => 'View Menu Categories']);
            Permission::create(['name' => 'menu_categories_edit', 'readable_name' => 'Edit Menu Categories']);
            Permission::create(['name' => 'menu_categories_add', 'readable_name' => 'Add Menu Category']);
            Permission::create(['name' => 'menu_categories_actions', 'readable_name' => 'Menu Category Actions']);

            Permission::create(['name' => 'items_view', 'readable_name' => 'View Items']);
            Permission::create(['name' => 'items_edit', 'readable_name' => 'Edit Items']);
            Permission::create(['name' => 'items_add', 'readable_name' => 'Add Item']);
            Permission::create(['name' => 'items_actions', 'readable_name' => 'Item Actions']);

            Permission::create(['name' => 'all_users_view', 'readable_name' => 'View All Users']);
            Permission::create(['name' => 'all_users_edit', 'readable_name' => 'Edit All Users']);
            Permission::create(['name' => 'all_users_wallet', 'readable_name' => 'Users Wallet Transactions']);

            Permission::create(['name' => 'delivery_guys_view', 'readable_name' => 'View Delivery Guy Users']);
            Permission::create(['name' => 'delivery_guys_manage_stores', 'readable_name' => 'Manage Delivery Guy Stores']);

            Permission::create(['name' => 'store_owners_view', 'readable_name' => 'View Store Owner Users']);
            Permission::create(['name' => 'store_owners_manage_stores', 'readable_name' => 'Manage Store Owner Stores']);

            Permission::create(['name' => 'order_view', 'readable_name' => 'View Orders']);
            Permission::create(['name' => 'order_actions', 'readable_name' => 'Order Actions']);

            Permission::create(['name' => 'promo_sliders_manage', 'readable_name' => 'Manage Promo Sliders']);
            Permission::create(['name' => 'store_category_sliders_manage', 'readable_name' => 'Manage Category Sliders']);
            Permission::create(['name' => 'coupons_manage', 'readable_name' => 'Manage Coupons']);
            Permission::create(['name' => 'pages_manage', 'readable_name' => 'Manage Pages']);
            Permission::create(['name' => 'popular_location_manage', 'readable_name' => 'Manage Popular Geo Locations']);
            Permission::create(['name' => 'send_notification_manage', 'readable_name' => 'Send Notifications']);
            Permission::create(['name' => 'store_payouts_manage', 'readable_name' => 'Manage Store Payouts']);
            Permission::create(['name' => 'translations_manage', 'readable_name' => 'Manage Translations']);
            Permission::create(['name' => 'delivery_collection_manage', 'readable_name' => 'Manage Delivery Collection']);
            Permission::create(['name' => 'delivery_collection_logs_view', 'readable_name' => 'View Delivery Collection Logs']);
            Permission::create(['name' => 'wallet_transactions_view', 'readable_name' => 'View Wallet Transactions']);
            Permission::create(['name' => 'reports_view', 'readable_name' => 'View Reports']);

            Permission::create(['name' => 'settings_manage', 'readable_name' => 'Manage Settings']);

            $user = User::where('id', '1')->first();
            $user->givePermissionTo(Permission::all());
            /* END Create Permission and add all permissions to Admin */

            /* END Save new keys for translations languages */
            /** CLEAR LARAVEL CACHES **/
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            /** END CLEAR LARAVEL CACHES **/

            return redirect()->back()->with(['success' => 'Operation Successful']);
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
    public function addMoneyToWallet(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if ($user) {
            try {
                $user->deposit($request->add_amount * 100, ['description' => $request->add_amount_description]);

                $alert = new PushNotify();
                $alert->sendWalletAlert($request->user_id, $request->add_amount, $request->add_amount_description, $type = 'deposit');

                return redirect()->back()->with(['success' => config('appSettings.walletName') . ' Updated']);
            } catch (\Illuminate\Database\QueryException $qe) {
                return redirect()->back()->with(['message' => $qe->getMessage()]);
            } catch (Exception $e) {
                return redirect()->back()->with(['message' => $e->getMessage()]);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['message' => $th]);
            }
        }
    }

    /**
     * @param Request $request
     */
    public function substractMoneyFromWallet(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        if ($user) {
            if ($user->balanceFloat * 100 >= $request->substract_amount * 100) {
                try {
                    $user->withdraw($request->substract_amount * 100, ['description' => $request->substract_amount_description]);

                    $alert = new PushNotify();
                    $alert->sendWalletAlert($request->user_id, $request->substract_amount, $request->substract_amount_description, $type = 'withdraw');

                    return redirect()->back()->with(['success' => config('appSettings.walletName') . ' Updated']);
                } catch (\Illuminate\Database\QueryException $qe) {
                    return redirect()->back()->with(['message' => $qe->getMessage()]);
                } catch (Exception $e) {
                    return redirect()->back()->with(['message' => $e->getMessage()]);
                } catch (\Throwable $th) {
                    return redirect()->back()->with(['message' => $th]);
                }
            } else {
                return redirect()->back()->with(['message' => 'Substract amount is less that the user balance amount.']);
            }

        }
    }

    public function walletTransactions()
    {
        $count = $transactions = Transaction::count();

        $transactions = Transaction::orderBy('id', 'DESC')->paginate(20);

        return view('admin.viewAllWalletTransactions', array(
            'transactions' => $transactions,
            'count' => $count,
        ));

    }

    /**
     * @param Request $request
     */
    public function searchWalletTransactions(Request $request)
    {
        $query = $request['query'];

        $transactions = Transaction::where('uuid', 'LIKE', '%' . $query . '%')
            ->paginate(20);

        $count = $transactions->total();

        return view('admin.viewAllWalletTransactions', array(
            'transactions' => $transactions,
            'query' => $query,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     * @param TranslationHelper $translationHelper
     */
    public function cancelOrderFromAdmin(Request $request, TranslationHelper $translationHelper)
    {
        $keys = ['orderRefundWalletComment', 'orderPartialRefundWalletComment'];
        $translationData = $translationHelper->getDefaultLanguageValuesForKeys($keys);

        $order = Order::where('id', $request->order_id)->first();

        $user = User::where('id', $order->user_id)->first();

        try {
            if ($order->orderstatus_id != 5 || $order->orderstatus_id != 6) {
                //5 = completed, 6 = canceled

                //check refund type

                // if refund_type === NOREFUND -> refund the wallet amount if present.
                if ($request->refund_type == 'NOREFUND' && $order->wallet_amount != null) {
                    $user->deposit($order->wallet_amount * 100, ['description' => $translationData->orderRefundWalletComment . $order->unique_order_id]);
                }

                //give full refund, even if not paid with wallet
                if ($request->refund_type == 'FULL') {
                    $user->deposit($order->total * 100, ['description' => $translationData->orderRefundWalletComment . $order->unique_order_id]);
                }

                //give half refund, even if not paid with wallet
                if ($request->refund_type == 'HALF') {
                    $user->deposit($order->total / 2 * 100, ['description' => $translationData->orderPartialRefundWalletComment . $order->unique_order_id]);
                }

                //cancel order
                $order->orderstatus_id = 6; //6 means canceled..
                $order->save();

                //throw notification to user
                if (config('appSettings.enablePushNotificationOrders') == 'true') {
                    $notify = new PushNotify();
                    $notify->sendPushNotification('6', $order->user_id, $order->unique_order_id);
                }

                return redirect()->back()->with(['success' => 'Operation Successful']);
            }
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
    public function acceptOrderFromAdmin(Request $request)
    {

        $order = Order::where('id', $request->id)->first();

        if ($order->orderstatus_id == '1') {
            $order->orderstatus_id = 2;
            $order->save();

            $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
            if ($restaurant) {

                // Send SMS Notification to Delivery Guy
                if (config('appSettings.smsDeliveryNotify') == 'true') {
                    //get restaurant

                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $order->restaurant_id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            //send Notification to Delivery Guy
                            $message = config('appSettings.defaultSmsDeliveryMsg');
                            $otp = null;
                            $smsnotify = new Sms();
                            $smsnotify->processSmsAction('OD_NOTIFY', $pU->phone, $otp, $message);
                        }
                    }

                }
                // END Send SMS Notification to Delivery Guy

                // Send Push Notification to Delivery Guy
                if (config('appSettings.enablePushNotificationOrders') == 'true') {
                    //get restaurant
                    $restaurant = Restaurant::where('id', $order->restaurant_id)->first();

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
                // END Send Push Notification to Delivery Guy
            }

            return redirect()->back()->with(array('success' => 'Order Accepted'));
        } else {
            return redirect()->back()->with(array('message' => 'Something went wrong.'));
        }
    }

    /**
     * @param Request $request
     */
    public function assignDeliveryFromAdmin(Request $request)
    {
        try {
            $assignment = new AcceptDelivery;
            $assignment->order_id = $request->order_id;
            $assignment->user_id = $request->user_id;
            $assignment->customer_id = $request->customer_id;
            $assignment->is_complete = 0;
            $assignment->created_at = Carbon::now();
            $assignment->updated_at = Carbon::now();
            $assignment->save();

            $order = Order::where('id', $request->order_id)->first();
            $order->orderstatus_id = 3;
            $order->save();

            $restaurant = Restaurant::where('id', $order->restaurant_id)->first();
            if ($restaurant) {

                // Send SMS Notification to Delivery Guy
                if (config('appSettings.smsDeliveryNotify') == 'true') {
                    //get restaurant

                    //get all pivot users of restaurant (delivery guy/ res owners)
                    $pivotUsers = $restaurant->users()
                        ->wherePivot('restaurant_id', $order->restaurant_id)
                        ->get();
                    //filter only res owner and send notification.
                    foreach ($pivotUsers as $pU) {
                        if ($pU->hasRole('Delivery Guy')) {
                            //send Notification to Delivery Guy
                            $message = config('appSettings.defaultSmsDeliveryMsg');
                            $otp = null;
                            $smsnotify = new Sms();
                            $smsnotify->processSmsAction('OD_NOTIFY', $pU->phone, $otp, $message);
                        }
                    }

                }
                // END Send SMS Notification to Delivery Guy

                // Send Push Notification to Delivery Guy
                if (config('appSettings.enablePushNotificationOrders') == 'true') {
                    //get restaurant
                    $restaurant = Restaurant::where('id', $order->restaurant_id)->first();

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
                // END Send Push Notification to Delivery Guy
            }

            return redirect()->back()->with(array('success' => 'Order Assigned'));
        } catch (Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with(array('message' => 'Something Went Wrong'));
            }
        }
    }

    /**
     * @param Request $request
     */
    public function reAssignDeliveryFromAdmin(Request $request)
    {

        $assignment = AcceptDelivery::where('order_id', $request->order_id)->first();
        $assignment->user_id = $request->user_id;
        $assignment->is_complete = 0;
        $assignment->updated_at = Carbon::now();
        $assignment->save();

        return redirect()->back()->with(array('success' => 'Order reassigned successfully'));
    }

    public function popularGeoLocations()
    {
        $locations = PopularGeoPlace::orderBy('id', 'DESC')->paginate(20);
        $locationsAll = PopularGeoPlace::all();
        $count = count($locationsAll);
        return view('admin.popularGeoLocations', array(
            'locations' => $locations,
            'count' => $count,
        ));
    }

    /**
     * @param Request $request
     */
    public function saveNewPopularGeoLocation(Request $request)
    {

        // dd($request->all());
        $location = new PopularGeoPlace();

        $location->name = $request->name;

        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;

        if ($request->is_active == 'true') {
            $location->is_active = true;
        } else {
            $location->is_active = false;
        }

        try {
            $location->save();
            return redirect()->back()->with(['success' => 'Location Saved']);
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
    public function disablePopularGeoLocation($id)
    {
        $location = PopularGeoPlace::where('id', $id)->first();
        if ($location) {
            $location->toggleActive()->save();
            return redirect()->back()->with(['success' => 'Location Disabled']);
        } else {
            return redirect()->route('admin.popularGeoLocations');
        }
    }

    /**
     * @param $id
     */
    public function deletePopularGeoLocation($id)
    {
        $location = PopularGeoPlace::where('id', $id)->first();

        if ($location) {
            $location->delete();

            return redirect()->route('admin.popularGeoLocations')->with(['success' => 'Location Deleted']);
        } else {
            return redirect()->route('admin.popularGeoLocations');
        }
    }

    public function translations()
    {
        $translations = Translation::orderBy('id', 'DESC')->get();
        $count = count($translations);

        return view('admin.translations', array(
            'translations' => $translations,
            'count' => $count,
        ));
    }

    public function newTranslation()
    {
        return view('admin.newTranslation');
    }

    /**
     * @param Request $request
     */
    public function saveNewTranslation(Request $request)
    {
        // dd($request->all());
        // dd(json_encode($request->except(['language_name'])));

        $translation = new Translation();

        $translation->language_name = $request->language_name;
        $translation->data = json_encode($request->except(['language_name', '_token']));

        try {
            $translation->save();
            return redirect()->route('admin.translations')->with(['success' => 'Translation Created']);
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
    public function editTranslation($id)
    {

        $translation = Translation::where('id', $id)->first();
        // dd(json_decode($translation->data));

        if ($translation) {
            return view('admin.editTranslation', array(
                'translation_id' => $translation->id,
                'language_name' => $translation->language_name,
                'data' => json_decode($translation->data),
            ));
        } else {
            return redirect()->route('admin.translations')->with(['message' => 'Translation Not Found']);
        }

    }

    /**
     * @param Request $request
     */
    public function updateTranslation(Request $request)
    {
        $translation = Translation::where('id', $request->translation_id)->first();

        $translation->language_name = $request->language_name;
        $translation->data = json_encode($request->except(['translation_id', 'language_name', '_token']));

        try {
            $translation->save();
            return redirect()->back()->with(['success' => 'Translation Updated']);
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
    public function disableTranslation($id)
    {
        $translation = Translation::where('id', $id)->first();
        if ($translation) {
            $translation->toggleEnable()->save();
            return redirect()->back()->with(['success' => 'Operation Successful']);
        } else {
            return redirect()->route('admin.translations');
        }
    }

    /**
     * @param $id
     */
    public function deleteTranslation($id)
    {
        $translation = Translation::where('id', $id)->first();
        if ($translation) {
            $translation->delete();
            return redirect()->route('admin.translations')->with(['success' => 'Translation Deleted']);
        } else {
            return redirect()->route('admin.translations');
        }
    }

    /**
     * @param $id
     */
    public function makeDefaultLanguage($id)
    {
        $translation = Translation::where('id', $id)->firstOrFail();

        //remove default of other
        $currentDefaults = Translation::where('is_default', '1')->get();
        // dd($currentDefault);
        if (!empty($currentDefaults)) {
            foreach ($currentDefaults as $currentDefault) {
                $currentDefault->is_default = 0;
                $currentDefault->save();
            }
        }

        //make this default
        $translation->is_default = 1;
        $translation->is_active = 1;
        $translation->save();
        return redirect()->back()->with(['success' => 'Operation Successful']);

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
     * @param $id
     */
    public function impersonate($id)
    {
        $user = User::where('id', $id)->first();
        if ($user && $user->hasRole('Store Owner')) {
            Auth::user()->impersonate($user);
            return redirect()->route('get.login');
        } else {
            return redirect()->route('admin.dashboard')->with(['message' => 'User not found']);
        }
    }

    /**
     * @param $order_id
     */
    public function approvePaymentOfOrder($order_id)
    {
        $order = Order::where('id', $order_id)->firstOrFail();

        if ($order->orderstatus_id == '8') {

            $restaurant = Restaurant::where('id', $order->restaurant_id)->first();

            if ($restaurant->auto_acceptable) {
                $orderstatus_id = '2';
                if (config('appSettings.enablePushNotificationOrders') == 'true') {
                    //to user
                    $notify = new PushNotify();
                    $notify->sendPushNotification('2', $order->user_id, $order->unique_order_id);
                }
                $this->sendPushNotificationStoreOwner($order->restaurant_id, $order->unique_order_id);
            } else {
                $orderstatus_id = '1';
                if (config('appSettings.smsRestaurantNotify') == 'true') {
                    $restaurant_id = $order->restaurant_id;
                    $this->smsToRestaurant($restaurant_id, $order->total);
                }
                $this->sendPushNotificationStoreOwner($order->restaurant_id, $order->unique_order_id);
            }

            $order->orderstatus_id = $orderstatus_id;
            $order->save();

            return redirect()->back()->with(['success' => 'Payment Approved']);
        } else {
            return 'Error! Payment already approved.';
        }
    }

    /**
     * @param $restaurant_id
     * @param $orderTotal
     */
    public function smsToRestaurant($restaurant_id, $orderTotal)
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
};
