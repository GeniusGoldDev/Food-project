@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.opTitle')}}
@endsection
@section('content')
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4>
                <span class="font-weight-bold mr-2">{{ __('storeDashboard.total')}}</span>
                <i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">{{ $count }}</span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <form action="{{ route('restaurant.post.searchOrders') }}" method="GET">
        <div class="form-group form-group-feedback form-group-feedback-right search-box">
            <input type="text" class="form-control form-control-lg search-input"
                placeholder="{{__('storeDashboard.opSearchPh')}}" name="query">
            <div class="form-control-feedback form-control-feedback-lg">
                <i class="icon-search4"></i>
            </div>
        </div>
        @csrf
    </form>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{__('storeDashboard.opTableOrderId')}}</th>
                            <th>{{__('storeDashboard.opTableRestName')}}</th>
                            <th>{{__('storeDashboard.opTableStatus')}}</th>
                            <th>{{__('storeDashboard.opPaymentMode')}}</th>
                            <th>{{__('storeDashboard.opTableTotal')}}</th>
                            <th>{{__('storeDashboard.opTableCoupon')}}</th>
                            <th>{{__('storeDashboard.opTableOrderPlacedAt')}}</th>
                            <th class="text-center" style="width: 10%;"><i class="
                                icon-circle-down2"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td><span style="font-size: 0.7rem; font-weight: 700;">{{ $order->unique_order_id }}</span></td>
                            <td>{{ $order->restaurant->name }}</td>
                            <td>
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize text-left">
                                    @if ($order->orderstatus_id == 1) {{__('storeDashboard.opOrderStatus1')}} @endif
                                    @if ($order->orderstatus_id == 2) {{__('storeDashboard.opOrderStatus2')}} @endif
                                    @if ($order->orderstatus_id == 3) {{__('storeDashboard.opOrderStatus3')}} @endif
                                    @if ($order->orderstatus_id == 4) {{__('storeDashboard.opOrderStatus4')}} @endif
                                    @if ($order->orderstatus_id == 5) {{__('storeDashboard.opOrderStatus5')}} @endif
                                    @if ($order->orderstatus_id == 6) {{__('storeDashboard.opOrderStatus6')}} @endif
                                    @if ($order->orderstatus_id == 7) {{__('storeDashboard.opOrderStatus7')}} @endif

                                    @if($order->accept_delivery !== null)
                                    @if($order->orderstatus_id > 2 && $order->orderstatus_id  < 6)
                                    {{__('storeDashboard.opDeliveryBy')}}: <b>{{ $order->accept_delivery->user->name }}</b>
                                    @endif
                                    @endif
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                {{ $order->payment_mode }}
                                </span>
                            </td>
                            @php
                               if(!is_null($order->tip_amount)) {
                                   $total = $order->total - $order->tip_amount;
                               } else {
                                   $total = $order->total;
                               }
                             @endphp
                            <td>{{ config('appSettings.currencyFormat') }} {{ $total }}</td>
                            <td>
                                @if($order->coupon_name == NULL) {{__('storeDashboard.opNone')}} @else
                                <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                {{ $order->coupon_name }}
                                </span>
                                @endif
                            </td>
                            <td>
                                <span  data-popup="tooltip" data-placement="bottom" title="{{ $order->created_at->format('Y-m-d  - h:i A') }}">
                                {{ $order->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('restaurant.viewOrder', $order->unique_order_id) }}"
                                    class="btn btn-sm btn-primary"> {{__('storeDashboard.opView')}}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $orders->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection