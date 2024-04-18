@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.ovTitle')}}
@endsection 
@section('content')

<div class="content">
    <br/><div class="col-md-6">	 
    <a href="javascript:void(0)" id="printButton">
        <input type='button' class="btn btn-lg btn-danger" id='btn' value='{{__('storeDashboard.thermalPrinterOrder')}}' >
        <div class="clearfix"></div>
    </a>
    </div><br/>

    <div id="orderBlock">
        <table class="printer-ticket">
            <thead>
                <tr>
                    <th style="text-align: center;" class="title" colspan="3">
                        {{ $order->unique_order_id }} <br>
                        {{__('storeDashboard.ovOrderPlaced')}}: <br>
                        {{ $order->created_at}}  ( {{ $order->created_at->diffForHumans() }} ) <br>
                        {{__('storeDashboard.ovStoreName')}}: {{ $order->restaurant->name }}<br><br>
                    </th>
                </th>
                <tr>
                    <th colspan="3">
                        <tr class="top">
                            <td colspan="3">
                                <b>{{__('storeDashboard.ovCustomerDetails')}}:</b><br/>
                                <b>{{__('storeDashboard.ovName')}}: </b> {{ $order->user->name }}   <br/>
                                <b>{{__('storeDashboard.ovEmail')}}: </b> {{ $order->user->email }}  <br/>
                                <b>{{__('storeDashboard.ovContactNumber')}}:  </b> {{ $order->user->phone }} <br/>
                                <b>{{__('storeDashboard.ovAddress')}}:  </b> <br/>
                                    {{ $order->address }} <br/> <br/>
                            </td>
                        </tr>
                    </th>
                </tr>
                
                <tr>
                    @php
                    function calculateAddonTotal($addons) {
                        $total = 0;
                        foreach ($addons as $addon) {
                            $total += $addon->addon_price;
                        }
                        return $total;
                    }
                    @endphp
                    <th colspan="3">
                        <tr class="top">
                            <td colspan="3">
                                <b>{{__('storeDashboard.navSubItems')}}:</b><br/>
                                @foreach($order->orderitems as $item)
                                    <tr class="top">
                                        <td colspan="2">{{ $item->quantity }} - {{ $item->name }}...</td>
                                        <td align="right">{{ config('settings.currencyFormat') }} {{ ($item->price +calculateAddonTotal($item->order_item_addons)) * $item->quantity }}</td>
                                    </tr>
                                        @if(count($item->order_item_addons))
                                            @foreach($item->order_item_addons as $addon)
                                            <tr class="top"> 
                                                <td colspan="2"> &nbsp;- {{ $addon->addon_name }}</td>
                                                <td align="right">{{ config('settings.currencyFormat') }}{{ $addon->addon_price }}</td>
                                            </tr> 
                                            @endforeach
                                        @endif
                                @endforeach

                                @if(!$order->coupon_name == NULL)
                                <tr class="top">
                                    <td colspan="2">{{__('storeDashboard.ovCoupon')}}:</td>
                                    <td align="right">{{ $order->coupon_name }}</td>
                                </tr>
                                @endif

                                @if(!$order->restaurant_charge == NULL)
                                <tr class="top">
                                    <td colspan="2">{{__('storeDashboard.ovStoreCharge')}}: </td>
                                    <td align="right">{{ config('settings.currencyFormat') }}{{ $order->restaurant_charge }}</td>
                                </tr>
                                @endif

                                @if(!$order->delivery_charge == NULL)
                                <tr class="top">
                                    <td colspan="2">{{__('storeDashboard.ovDeliveryCharge')}}:</td>
                                    <td align="right">{{ config('settings.currencyFormat') }}{{ $order->delivery_charge }}</td>
                                </tr>
                                @endif

                                @if(!$order->tax == NULL)
                                <tr class="top">
                                    <td colspan="2">{{__('storeDashboard.ovTax')}}: </td>
                                    <td align="right">{{ $order->tax }}%</td>
                                </tr>
                                @endif

                            </td>
                        </tr>
                    </th>
                </tr> 
                
                <tr class="top">
                    <td colspan="2"> <b>{{__('storeDashboard.ovTotal')}}</b> </td>
                        <td align="right"><b>{{ config('settings.currencyFormat') }} {{ $order->total }}</b></td>
                    </td>
                </tr>                        

                <tr>
                    <th class="top" colspan="3">
                        <br/><b>{{__('storeDashboard.ovPaymentMode')}}:</b></br>{{ $order->payment_mode }}
                    </th>
                </tr>

                @if(!$order->order_comment == NULL)
                <tr>
                    <th class="top" colspan="3">
                        <br/><b>{{__('storeDashboard.ovCommentSuggestion')}}:</b><br/>
                        {{ $order->order_comment }}
                    </th>
                </tr>                           
                @endif
            </thead>
        </table>
    </div>                
</div> 

 <script>
    function printFunc() {
        let orderBlock = document.getElementById('orderBlock');
        let customCSS = '<style type="text/css"> table th, table td {border:0px solid #000;padding:0} </style>';
        customCSS += orderBlock.outerHTML;
        printWindow = window.open("");
        printWindow.document.write(customCSS);
        printWindow.document.write("&nbsp;<br>");
        printWindow.document.write("&nbsp;<br>");
        printWindow.document.write("&nbsp;<br>");
        printWindow.document.write("&nbsp;<br>");
        printWindow.document.write("&nbsp;<br>");
        printWindow.print();
        printWindow.close();
    }

    $(function() {
        $('#printButton').click();

        $('#printButton').on('click',function(){
            $('#orderBlock').printThis({
                removeScripts: true,
                pageTitle: "&nbsp;", 
                importCSS: false,
                loadCSS:'<style type="text/css"> table th, table td {border:0px solid #000;padding:0} </style>'
            });
        });
    }); 
</script>
@endsection
