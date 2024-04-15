<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Orderitem;
use App\Restaurant;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    /**
     * @param Request $request
     */
    public function viewTopItems(Request $request)
    {

        $todaysDate = Carbon::now()->format('Y-m-d');
        $range = null;
        $range = $request->range;

        $restaurants = Restaurant::all();

        $restaurant_id = null;
        $restaurant = null;
        $top_items_total = null;
        $top_items_data = null;

        $restaurant_id = $request->restaurant_id;

        // dd($restaurant_id);

        //////////////////////////////////////////////////////////////
        /////////////// For Restaurants Based Search/////////////////
        /////////////////////////////////////////////////////////////

        $top_items_completed_restaurant = null;
        $top_items_restaurant = null;

        // dd($restaurant);
        if ($restaurant_id) {

            $restaurant = restaurant::where('id', $restaurant_id)->first();

            // Range 1 = This Week
            if ($range == '1') {
                $top_items_orders_completed = Order::where('orderstatus_id', '5')->where('restaurant_id', $restaurant_id)->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek(),
                ])->pluck('id');
            }
            // Range 2 = Last 7 Days
            if ($range == '2') {
                $top_items_orders_completed = Order::where('orderstatus_id', '5')->where('restaurant_id', $restaurant_id)->whereDate('created_at', '>', Carbon::now()->subDays(7))->pluck('id');
            }
            // Range 3 = This Month
            if ($range == '3') {
                $top_items_orders_completed = Order::where('orderstatus_id', '5')->where('restaurant_id', $restaurant_id)->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth(),
                ])->pluck('id');
            }
            // Range 4 = Last 30 Days
            if ($range == '4') {
                $top_items_orders_completed = Order::where('orderstatus_id', '5')->where('restaurant_id', $restaurant_id)->whereDate('created_at', '>', Carbon::now()->subDays(30))->pluck('id');
            }
            // Range 5 = All time
            if ($range == '5') {
                $top_items_orders_completed = Order::where('orderstatus_id', '5')->where('restaurant_id', $restaurant_id)->pluck('id');
            }
            // Range null = From the begining of time
            if ($range == null) {
                $top_items_orders_completed = Order::where('orderstatus_id', '5')->where('restaurant_id', $restaurant_id)->pluck('id');
            }

            $anyOrder = $top_items_orders_completed->count();
            //dd($anyOrder);

            $top_items_completed_restaurant = Orderitem::whereIn('order_id', $top_items_orders_completed)->select('item_id', 'name', 'price', DB::raw('SUM(quantity) as qty'))->groupBy('item_id')->orderBy('qty', 'DESC')->take(10)->get();

            $top_items_restaurant = '[';
            foreach ($top_items_completed_restaurant as $item) {

                $top_items_restaurant .= '{value:' . $item->qty . ", name: '" . $item->name . "'},";

            }
            $top_items_restaurant = rtrim($top_items_restaurant, ',');
            $top_items_restaurant .= ']';

            //  dd($top_items_restaurant);
        }

        // For Top  Total Items Sold
        if (!$restaurant_id) {
            // Range 1 = This Week
            if ($range == '1') {
                $top_items_completed = Order::where('orderstatus_id', '5')->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek(),
                ])->pluck('id');
            }
            // Range 2 = Last 7 Days
            if ($range == '2') {
                $top_items_completed = Order::where('orderstatus_id', '5')->whereDate('created_at', '>', Carbon::now()->subDays(7))->pluck('id');
            }
            // Range 3 = This Month
            if ($range == '3') {
                $top_items_completed = Order::where('orderstatus_id', '5')->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth(),
                ])->pluck('id');
            }
            // Range 4 = Last 30 Days
            if ($range == '4') {
                $top_items_completed = Order::where('orderstatus_id', '5')->whereDate('created_at', '>', Carbon::now()->subDays(30))->pluck('id');
            }
            // Range 5 = All time
            if ($range == '5') {
                $top_items_completed = Order::where('orderstatus_id', '5')->pluck('id');
            }
            // Range null = From the begining of time
            if ($range == null) {
                $top_items_completed = Order::where('orderstatus_id', '5')->pluck('id');
            }
            $anyOrder = $top_items_completed->count();
            $top_items_total = Orderitem::whereIn('order_id', $top_items_completed)->select('item_id', 'name', 'price', DB::raw('SUM(quantity) as qty'))->groupBy('item_id')->orderBy('qty', 'DESC')->take(10)->get();

            //dd($top_items_total);
            // For Charts
            $top_items_data = null;
            $top_items_data = '[';
            foreach ($top_items_total as $item1) {

                $top_items_data .= '{value:' . $item1->qty . ", name: '" . $item1->name . "'},";

            }
            $top_items_data = rtrim($top_items_data, ',');
            $top_items_data .= ']';
            // dd($top_items_data);
        }

        return view('admin.viewTopItems', array(
            'range' => $range,
            'todaysDate' => $todaysDate,
            'restaurants' => $restaurants,
            'top_items_restaurant' => $top_items_restaurant,
            'top_items_completed_restaurant' => $top_items_completed_restaurant,
            'restaurant' => $restaurant,
            'top_items_total' => $top_items_total,
            'top_items_data' => $top_items_data,
            'anyOrder' => $anyOrder,
        ));
    }

}
