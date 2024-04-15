<?php

namespace App\Http\Controllers\Datatables;

use App\Order;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class OrdersDatatable
{
    public function ordersDataTable()
    {
        // sleep(5000);
        $orders = Order::with('orderstatus', 'accept_delivery.user', 'restaurant', 'user');

        return Datatables::of($orders)
            ->editColumn('unique_order_id', function ($order) {
                $html = '';
                if (config('appSettings.restaurantAcceptTimeThreshold') != null) {
                    if ($order->orderstatus_id == 1) {
                        if ($order->created_at->diffInMinutes(Carbon::now()) >= (int) config('appSettings.restaurantAcceptTimeThreshold')) {
                            $lateMins = $order->created_at->diffInMinutes(Carbon::now()) - 5;
                            $html .= '<span class="pulse pulse-warning" data-popup="tooltip" title="" data-placement="bottom" data-original-title="Order not accepted by store. Late by' . $lateMins . 'mins."></span>';
                        }
                    }
                }

                if (config('appSettings.deliveryAcceptTimeThreshold') != null) {
                    if ($order->orderstatus_id == 2 && $order->delivery_type == 1) {
                        if ($order->created_at->diffInMinutes(Carbon::now()) >= (int) config('appSettings.deliveryAcceptTimeThreshold')) {
                            $lateMins = $order->created_at->diffInMinutes(Carbon::now()) - 5;
                            $html .= '<span class="pulse pulse-danger" data-popup="tooltip" title="" data-placement="bottom" data-original-title="Order not on accepted by delivery guy. Late by ' . $lateMins . 'mins."></span>';
                        }
                    }
                }
                $html .= '<a href="' . route('admin.viewOrder', $order->unique_order_id) . '"target="_blank" class="linked-item" data-popup="tooltip" title="" data-placement="bottom" data-original-title="Open order in a new tab">' . $order->unique_order_id . '</a>';

                return $html;

            })
            ->editColumn('created_at', function ($order) {
                return '<span data-popup="tooltip" data-placement="left" title="' . $order->created_at->diffForHumans() . '">' . $order->created_at->format('Y-m-d - h:i A') . '</span>';
            })
            ->editColumn('orderstatus_id', function ($order) {

                $html = '<div class="text-center"><span class="badge order-badge badge-color-' . $order->orderstatus_id . ' border-grey-800">' . $order->orderstatus->name . '</span>';

                $html .= '<br> <small> Order By: ' . '<a href="' . route('admin.get.editUser', $order->user->id) . '"target="_blank" class="linked-item">' . $order->user->name . '</a></small>';

                if ($order->orderstatus_id > 2 && $order->orderstatus_id < 6) {
                    if ($order->accept_delivery && $order->accept_delivery->user && $order->accept_delivery->user->name) {
                        $html .= '<br> <small> Delivery By: ' . '<a href="' . route('admin.get.editUser', $order->accept_delivery->user->id) . '"target="_blank" class="linked-item">' . $order->accept_delivery->user->name . '</a></small>';
                    }
                } else {
                    $html .= '</div>';
                }
                return $html;
            })
            ->editColumn('total', function ($order) {
                return config('appSettings.currencyFormat') . $order->total;
            })
            ->addColumn('restaurant_name', function ($order) {
                if ($order->restaurant) {
                    return $order->restaurant->name;
                } else {
                    return 'NA';
                }
            })
            ->addColumn('action', function ($order) {
                $html = '<a href="' . route('admin.viewOrder', $order->unique_order_id) . '" class="btn btn-sm btn-primary"> View</a>';
                return $html;
            })
            ->addColumn('live_timer', function ($order) {
                $html = '';
                if ($order->orderstatus_id == 5) {

                    $html .= '<p class="order-dashboard-time text-center mix-fit-content mt-1"><b>Completed in:<br> </b>' . timeStrampDiffFormatted($order->created_at, $order->updated_at) . '</p>';
                } elseif ($order->orderstatus_id == 6) {

                    $html .= '<p class="order-dashboard-time text-center mix-fit-content mt-1"><b>Cancelled in:<br> </b>' . timeStrampDiffFormatted($order->created_at, $order->updated_at) . '</p>';
                } else {

                    $html .= '<div class="text-center"><strong>Time Elapsed </strong> <p class="liveTimer mt-1 text-center mix-fit-content order-dashboard-time" title="' . $order->created_at . '"><i class="icon-spinner10 spinner position-left"></i></p> </div>';
                }
                return $html;
            })
            ->addColumn('paid_status', function ($order) {
                $html = '';
                if ($order->orderstatus_id == 5){
                    $html .='<div style="width:40px;height:15px;background-color:green;"></div>';
                }else{
                    $html .='<div style="width:40px;height:15px;background-color:red;"></div>';
                }

                return $html;
            })
            ->rawColumns(['paid_status','unique_order_id', 'orderstatus_id', 'action', 'created_at', 'live_timer'])
            ->make(true);
    }
}
