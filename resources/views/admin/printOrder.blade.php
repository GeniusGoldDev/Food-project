@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.ovTitle')}}
@endsection 
@section('content')

@php
$subTotal = 0;
function calculateAddonTotal($addons) {
    $total = 0;
    foreach ($addons as $addon) {
        $total += $addon->addon_price;
    }
    return $total;
}
@endphp                    

<div class="content">
    <br/><div class="col-md-6">  
    <a href="javascript:void(0)" id="printButton">
        <input type='button' class="btn btn-lg btn-danger" id='btn' value='PRINT NOW' >
        <div class="clearfix"></div>
    </a>
    </div><br/>

    <div id="printOrderBlock">
        <div class="d-flex justify-content-around">
            <h4><b>{{ $order->unique_order_id }}</b></h4>
        </div>
        <div class="d-flex justify-content-around">
            <small> {{ $order->created_at->format('Y-m-d  - h:i A')}}  </small>
        </div>
        <div class="d-flex justify-content-around">
            <b>{{ $order->restaurant->name }}</b>
        </div>

        <div class="d-flex justify-content-start mt-2">
            <div>
                <b>{{__('storeDashboard.ovCustomerDetails')}}:</b><br/>
                <b>{{__('storeDashboard.ovName')}}: </b> {{ $order->user->name }}   <br/>
                <b>{{__('storeDashboard.ovEmail')}}: </b> {{ $order->user->email }}  <br/>
                <b>{{__('storeDashboard.ovContactNumber')}}:  </b> {{ $order->user->phone }} <br/>
                <b>{{__('storeDashboard.ovAddress')}}:  </b>
                    {{ $order->address }} <br/> <br/>
            </div>
        </div>

        <div class="d-flex justify-content-start mt-2">
            <div class="col-md-12 p-2 mb-3" style="background-color: #f7f8fb; float: right; text-align: left;">
                @foreach($order->orderitems as $item)
                <div>
                    <div class="d-flex mb-1 align-items-start" style="font-size: 1.2rem;">
                        <span class="badge badge-flat border-grey-800 text-default mr-2">{{ $item->quantity }}x</span>
                        <strong class="mr-1" style="width: 100%;">{{ $item->name }}</strong>
                        @php
                        $itemTotal = ($item->price +calculateAddonTotal($item->order_item_addons)) * $item->quantity;
                        $subTotal = $subTotal + $itemTotal;
                        @endphp
                        <span class="badge badge-flat border-grey-800 text-default">{{ config('appSettings.currencyFormat') }}{{ $itemTotal }}</span>
                    </div>
                    @if(count($item->order_item_addons))
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Addon</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item->order_item_addons as $addon)
                                <tr>
                                    <td>{{ $addon->addon_category_name }}</td>
                                    <td>{{ $addon->addon_name }}</td>
                                    <td>{{ config('appSettings.currencyFormat') }}{{ $addon->addon_price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    @if(!$loop->last)
                    <div class="mb-2" style="border-bottom: 2px solid #dcdcdc;"></div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center mt-2">
            <table class="table table-bordered bill-calc-table">

                <tr>
                    <td class="text-left td-title">SubTotal</td>
                    <td class="td-data"> {{ config('appSettings.currencyFormat') }}{{ $subTotal }}</td>
                </tr>

                @if($order->coupon_name != NULL)
                    <tr>
                        <td class="text-left td-title">Coupon</td>
                        <td class="td-data"> {{ $order->coupon_name }} @if($order->coupon_amount != NULL) ({{ config('appSettings.currencyFormat') }}{{ $order->coupon_amount }}) @endif </td>
                    </tr>
                @endif

                @if($order->restaurant_charge != NULL)
                <tr>
                    <td class="text-left td-title">Store Charge</td>
                    <td class="td-data"> {{ config('appSettings.currencyFormat') }}{{ $order->restaurant_charge }} </td>
                </tr>
                @endif

                <tr>
                    <td class="text-left td-title">Delivery Charge</td>
                    <td class="td-data"> {{ config('appSettings.currencyFormat') }}{{ $order->delivery_charge }} </td>
                </tr>

                @if($order->tax != NULL)
                    <tr>
                        <td class="text-left td-title">Tax</td>
                        <td class="td-data">{{ $order->tax }}% @if($order->tax_amount != NULL) ({{ config('appSettings.currencyFormat') }}{{ $order->tax_amount }}) @endif </td>
                    </tr>
                @endif

                @if(!$order->tip_amount == NULL)
                    <tr>
                        <td class="text-left td-title">Tip</td>
                        <td class="td-data">{{ config('appSettings.currencyFormat') }}{{ $order->tip_amount }}</td>
                    </tr>
                @endif

                @if($order->wallet_amount != NULL)
                    <tr>
                        <td class="text-left td-title">Paid With {{ config('appSettings.walletName') }}</td>
                        <td class="td-data"> {{ config('appSettings.currencyFormat') }}{{ $order->wallet_amount }} </td>
                    </tr>
                @endif

                <tr>
                    <td class="text-left td-title"><b>TOTAL</b></td>
                    <td class="td-data"> {{ config('appSettings.currencyFormat') }}{{ $order->total }} </td>
                </tr>

                @if($order->payable != NULL)
                    <tr>
                        <td class="text-left td-title">Payable</td>
                        <td class="td-data"><b> {{ config('appSettings.currencyFormat') }}{{ $order->payable }}</b></td>
                    </tr>
                @endif

            </table>
        </div>

    </div>                
</div> 

 <script>
    $('#printButton').click(function(event) {
        $('#printOrderBlock').printThis({
            removeScripts: true,
            pageTitle: "&nbsp;", 
            importCSS: true,
            loadCSS: "{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/css/orderPrint.css"
        });
    });
</script>
@endsection
