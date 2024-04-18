@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.ovTitle')}}
@endsection
@section('content')
<style>
    .content-wrapper {
        overflow: hidden;
    }
    .bill-calc-table tr td {
        padding: 6px 80px;
    }
    @media (min-width: 320px) and (max-width: 767px) {
        .bill-calc-table tr td {
            padding: 6px 50px;
        }
    }
    .td-title {
        padding-left: 15px !important;
    }
    .td-data {
        padding-right: 15px !important;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-lg-8 mt-4">
            @if(\Nwidart\Modules\Facades\Module::find('ThermalPrinter') && \Nwidart\Modules\Facades\Module::find('ThermalPrinter')->isEnabled())

            <button type="button" class="btn btn-sm btn-secondary my-2 ml-2 thermalPrintButton" disabled="disabled" title="{{__('thermalPrinterLang.connectingToPrinterMessage')}}" style="color: #fff; float: right; border-radius: 8px" data-type="kot"><i class="icon-printer4 mr-1 thermalPrinterIcon"></i> {{__('thermalPrinterLang.printKotWithThermalPrinter')}}</button>

            <button type="button" class="btn btn-sm btn-secondary my-2 ml-2 thermalPrintButton" disabled="disabled" title="{{__('thermalPrinterLang.connectingToPrinterMessage')}}" style="color: #fff; float: right; border-radius: 8px" data-type="invoice"><i class="icon-printer4 mr-1 thermalPrinterIcon"></i> {{__('thermalPrinterLang.printInvoiceWithThermalPrinter')}}</button>

            <input type="hidden" id="thermalPrinterCsrf" value="{{ csrf_token() }}">
            <script>
                var socket = null;
                var socket_host = 'ws://127.0.0.1:6441';

                initializeSocket = function() {
                    try {
                        if (socket == null) {
                            socket = new WebSocket(socket_host);
                            socket.onopen = function() {};
                            socket.onmessage = function(msg) {
                                let message = msg.data;
                                $.jGrowl("", {
                                    position: 'bottom-center',
                                    header: message,
                                    theme: 'bg-danger',
                                    life: '5000'
                                });
                            };
                            socket.onclose = function() {
                                socket = null;
                            };
                        }
                    } catch (e) {
                        console.log("ERROR", e);
                    }

                    var checkSocketConnecton = setInterval(function() {
                        if (socket == null || socket.readyState != 1) {
                            $('.thermalPrintButton').attr({
                                disabled: 'disabled',
                                title: '{{__('thermalPrinterLang.connectingToPrinterFailedMessage')}}'
                            });
                        }
                        if (socket != null && socket.readyState == 1) {
                             $('.thermalPrintButton').removeAttr('disabled').removeAttr('title');
                        }
                        clearInterval(checkSocketConnecton);
                    }, 500)
                };

                initializeSocket();

                $('.thermalPrintButton').click(function(event) {
                    $('.thermalPrinterIcon').removeClass('icon-printer').addClass('icon-spinner10 spinner');
                    let printButton = $('.thermalPrintButton');
                    printButton.attr('disabled', 'disabled');
                    let printType = $(this).data("type");

                    let order_id = '{{ $order->id }}';
                    let token = $('#thermalPrinterCsrf').val();

                    $.ajax({
                        url: '{{ route('thermalprinter.getOrderData') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {order_id: order_id, _token: token, print_type: printType },
                    })
                    .done(function(response) {
                        let content = {};
                        content.type = 'print-receipt';
                        content.data = response;
                        let sendData = JSON.stringify(content);
                        if (socket != null && socket.readyState == 1) {
                                socket.send(sendData);
                                $.jGrowl("", {
                                    position: 'bottom-center',
                                    header: '{{__('thermalPrinterLang.printCommandSentMessage')}}',
                                    theme: 'bg-success',
                                    life: '3000'
                                });
                                setTimeout(function() {
                                    $('.thermalPrinterIcon').removeClass('icon-spinner10 spinner').addClass('icon-printer');
                                    printButton.removeAttr('disabled');
                                }, 1000);
                            } else {
                                initializeSocket();
                                setTimeout(function() {
                                    socket.send(sendData);
                                    $.jGrowl("", {
                                        position: 'bottom-center',
                                        header: '{{__('storeDashboard.printCommandSentMessage')}}',
                                        theme: 'bg-success',
                                        life: '5000'
                                    });
                                }, 700);
                            }
                    })
                    .fail(function() {
                        alert("ERROR")
                    })
                });
            </script>
            @endif

            <a href="javascript:void(0)" id="printButton" class="btn btn-sm btn-primary mt-2" style="color: #fff; border: 1px solid #ccc; float: right; border-radius: 8px"><i class="icon-printer mr-1"></i>{{__('storeDashboard.ovPrint')}}</a>
                <div class="clearfix"></div>
            <div class="sidebar-category mt-1" style="box-shadow: 0 1px 6px 1px rgba(0, 0, 0, 0.05);background-color: #fff;">

                <div class="category-content" id="printThis">
                    <div href="#" class="btn btn-block content-group" style="text-align: left; background-color: #8360c3; color: #fff; border-radius: 8px 8px 0 0;"><strong style="font-size: 1.2rem;">{{ $order->unique_order_id }}</strong>
                    </div>
                    <div class="p-3">                        

                        <div class="d-flex justify-content-between">
                            <div class="form-group mb-0">
                                <h3><strong>{{ $order->restaurant->name }}</strong></h3>
                            </div>
                            <div class="form-group mb-0">
                                <label class="control-label no-margin text-semibold mr-1"><strong>{{__('storeDashboard.ovOrderPlaced')}}:</strong></label>
                                {{ $order->created_at->format('Y-m-d  - h:i A')}} 
                            </div>
                        </div>

                        <hr>

                        <div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label no-margin text-semibold mr-1"><strong><h5 class="font-weight-bold">{{__('storeDashboard.ovCustomerDetails')}}</h5></strong></label>
                                        <br>
                                        <p><b>{{__('storeDashboard.ovName')}}: </b> {{ $order->user->name }}</p>
                                        <p><b>{{__('storeDashboard.ovEmail')}}: </b> {{ $order->user->email }}</p>
                                        <p><b>{{__('storeDashboard.ovContactNumber')}}: </b> {{ $order->user->phone }}</p>
                                        @if($order->delivery_type == 1)
                                        <p><b>{{__('storeDashboard.ovAddress')}}: </b> {{ $order->address }}</p>
                                        @endif
                                        @if($order->user->tax_number != NULL)
                                        <p><b>{{__('storeDashboard.ovTaxNumber')}}: </b> {{ strtoupper($order->user->tax_number) }}</p>
                                        @endif
                                        @if($order->order_comment != NULL)
                                            <p><b>{{__('storeDashboard.ovCommentSuggestion')}}: </b> {{ $order->order_comment }}</p>
                                        @endif
                                        
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-1">
                                        <div class="d-flex justify-content-center align-items-center flex-column mb-1" style="border: 1px solid #ddd;">
                                            <div class="py-1" style="font-weight: 900;">{{__('storeDashboard.ovStatusText')}}</div>
                                            <hr style="width: 100%;" class="m-0">
                                            <div class="py-1 text-success @if ($order->orderstatus_id == 6) text-danger @endif" style="font-weight: 500;">
                                                @if ($order->orderstatus_id == 1) {{__('storeDashboard.opOrderStatus1')}} @endif
                                                @if ($order->orderstatus_id == 2) {{__('storeDashboard.opOrderStatus2')}} @endif
                                                @if ($order->orderstatus_id == 3) {{__('storeDashboard.opOrderStatus3')}} @endif
                                                @if ($order->orderstatus_id == 4) {{__('storeDashboard.opOrderStatus4')}} @endif
                                                @if ($order->orderstatus_id == 5) {{__('storeDashboard.opOrderStatus5')}} @endif
                                                @if ($order->orderstatus_id == 6) {{__('storeDashboard.opOrderStatus6')}} @endif
                                                @if ($order->orderstatus_id == 7) {{__('storeDashboard.opOrderStatus7')}} @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-1 mt-2">
                                    <div class="d-flex">
                                        <div class="col p-0 mr-2">
                                        <div class="d-flex justify-content-center align-items-center flex-column mb-1" style="border: 1px solid #ddd;">
                                            <div class="py-1" style="font-weight: 900;">{{__('storeDashboard.ovOrderType')}}</div>
                                            <hr style="width: 100%;" class="m-0">
                                            <div class="py-1 text-warning" style="font-weight: 500;">
                                                @if($order->delivery_type == 1)
                                                    {{__('storeDashboard.ovOrderTypeDelivery')}}
                                                @else
                                                    {{__('storeDashboard.ovOrderTypeSelfPickup')}}
                                                @endif
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col p-0">
                                        <div class="d-flex justify-content-center align-items-center flex-column mb-1" style="border: 1px solid #ddd;">
                                            <div class="py-1" style="font-weight: 900;">{{__('storeDashboard.ovPaymentMode')}}</div>
                                            <hr style="width: 100%;" class="m-0">
                                            <div class="py-1 text-warning" style="font-weight: 500;">
                                                {{ $order->payment_mode }}
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

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
                        <div class="text-right">
                            <div class="form-group">
                                <div class="clearfix"></div>
                                <div class="row">
                                <div class="col-md-12 p-2 mb-3" style="background-color: #f7f8fb; float: right; text-align: left;">
                                    @foreach($order->orderitems as $item)
                                    <div>
                                    <div class="d-flex mb-1 align-items-start" style="font-size: 1.2rem;">
                                        <span class="badge badge-flat border-grey-800 text-default mr-2">x{{ $item->quantity }}</span>
                                        <strong class="mr-2" style="width: 100%;">{{ $item->name }}</strong>
                                        @php
                                        $itemTotal = ($item->price +calculateAddonTotal($item->order_item_addons)) * $item->quantity;
                                         $subTotal = $subTotal + $itemTotal;
                                        @endphp
                                        <span class="badge badge-flat border-grey-800 text-default">{{ config('appSettings.currencyFormat') }}{{ $itemTotal }}</span>
                                    </div>
                                    @if(count($item->order_item_addons))
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{__('storeDashboard.ovTableCategory')}}</th>
                                                    <th>{{__('storeDashboard.ovTableAddon')}}</th>
                                                    <th>{{__('storeDashboard.ovTablePrice')}}</th>
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
                                            <div class="mb-2" style="border-bottom: 2px solid #c9c9c9;"></div>
                                        @endif
                                        </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="float-right">
                            <table class="table table-bordered table-striped bill-calc-table">

                                    <tr>
                                        <td class="text-left td-title">{{__('storeDashboard.ovSubTotal')}}</td>
                                        <td class="text-right td-data"> {{ config('appSettings.currencyFormat') }}{{ $subTotal }}</td>
                                    </tr>

                                    @if($order->coupon_name != NULL)
                                        <tr>
                                            <td class="text-left td-title">{{__('storeDashboard.ovCoupon')}}</td>
                                            <td class="text-right td-data"> {{ $order->coupon_name }} @if($order->coupon_amount != NULL) ({{ config('appSettings.currencyFormat') }}{{ $order->coupon_amount }}) @endif</td>
                                        </tr>
                                    @endif

                                    @if($order->restaurant_charge != NULL)
                                    <tr>
                                        <td class="text-left td-title">{{__('storeDashboard.ovStoreCharge')}}</td>
                                        <td class="text-right td-data"> {{ config('appSettings.currencyFormat') }}{{ $order->restaurant_charge }} </td>
                                    </tr>
                                    @endif

                                    <tr>
                                        <td class="text-left td-title">{{__('storeDashboard.ovDeliveryCharge')}}</td>
                                        <td class="text-right td-data"> {{ config('appSettings.currencyFormat') }}{{ $order->delivery_charge }} </td>
                                    </tr>

                                    @if($order->tax != NULL)
                                        <tr>
                                            <td class="text-left td-title">{{__('storeDashboard.ovTax')}}</td>
                                            <td class="text-right td-data">{{ $order->tax }}% @if($order->tax_amount != NULL) ({{ config('appSettings.currencyFormat') }}{{ $order->tax_amount }}) @endif</td>
                                        </tr>
                                    @endif

                                    @if($order->wallet_amount != NULL)
                                        <tr>
                                            <td class="text-left td-title">{{__('storeDashboard.ovPaidWithWallet')}} {{ config('appSettings.walletName') }}</td>
                                            <td class="text-right td-data"> {{ config('appSettings.currencyFormat') }}{{ $order->wallet_amount }} </td>
                                        </tr>
                                    @endif


                                    @php
                                       if(!is_null($order->tip_amount)) {
                                           $total = $order->total - $order->tip_amount;
                                       } else {
                                           $total = $order->total;
                                       }
                                   @endphp
                                    <tr>
                                        <td class="text-left td-title"><b>{{ __('storeDashboard.ovTotal') }}</b></td>
                                        <td class="text-right td-data"> {{ config('appSettings.currencyFormat') }}{{ $total }} </td>
                                    </tr>

                                     @php
                                        if(!is_null($order->tip_amount)) {
                                            $payable = $order->payable - $order->tip_amount;
                                        } else {
                                            $payable = $order->payable;
                                        }
                                    @endphp
                                    @if($order->payable != NULL)
                                        <tr>
                                            <td class="text-left td-title">{{ __('storeDashboard.ovPayable') }}</td>
                                            <td class="text-right td-data"><b> {{ config('appSettings.currencyFormat') }}{{ $payable }}</b></td>
                                        </tr>
                                    @endif
                            </table>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-4 mb-5">
            <div style="margin-top: 5.2rem"></div>
            @if($order->rating)
            <div class="card">
                <div class="card-body">
                    <p class="text-center mb-3"><b>{{ __('storeDashboard.ratingsAndReviewsText') }}</b></p>
                    <div>
                        <p> <b>Delivery Rating </b> <span class="ml-1 badge badge-flat text-white {{ ratingColorClass($order->rating->rating_delivery) }}">{{ $order->rating->rating_delivery }} <i class="icon-star-full2 text-white" style="font-size: 0.6rem;"></i></span></p>
                        
                        <p>{{ $order->rating->review_delivery }}</p>
                        <hr>
                        <p> <b>Store Rating </b>  <span class="ml-1 badge badge-flat text-white {{ ratingColorClass($order->rating->rating_store) }}">{{ $order->rating->rating_store }} <i class="icon-star-full2 text-white" style="font-size: 0.6rem;"></i></span> </p>
                       
                        <p>{{ $order->rating->review_store }}</p>
                    </div>
                </div>
            </div>
            @endif
            @if(($order->orderstatus_id == 1) || ($order->delivery_type == 2 && $order->orderstatus_id == 2) || ($order->delivery_type == 2 && $order->orderstatus_id == 7))
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center mb-3"> <strong> {{ __('storeDashboard.viewOrderOrderActions') }} </strong> </h4>
                    <div class="d-flex justify-content-center">
                        @if($order->orderstatus_id == 1)
                        <a href="{{ route('restaurant.acceptOrder', $order->id) }}"
                            class="mr-2 btn btn-lg acceptOrderBtn btn-primary"> {{__('storeDashboard.ovAccept')}} <i
                            class="icon-checkmark3 ml-1"></i></a>
                        <a href="{{ route('restaurant.cancelOrder', $order->id) }}"
                            class="btn btn-lg cancelOrderBtn btn-danger" data-popup="tooltip" data-placement="top" title="{{__('storeDashboard.ovTooltipCancel')}}"> {{__('storeDashboard.ovCancel')}} <i
                            class="icon-cross ml-1"></i></a>
                        @endif
                        @if($order->delivery_type == 2 && $order->orderstatus_id == 2)
                        <a href="{{ route('restaurant.markOrderReady', $order->id) }}"
                            class="btn btn-lg btn-warning"> {{__('storeDashboard.ovMarkAsReady')}} <i
                            class="icon-checkmark3 ml-1"></i></a>
                        @endif
                        @if($order->delivery_type == 2 && $order->orderstatus_id == 7)
                        <a href="{{ route('restaurant.markSelfPickupOrderAsCompleted', $order->id) }}"
                            class="btn btn-lg btn-success"> {{__('storeDashboard.ovMarkAsCompleted')}} <i
                            class="icon-checkmark3 ml-1"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    $('#printButton').on('click',function(){
        $('#printThis').printThis();
    })
    //on single click, accpet order and disable button
    $('body').on("click", ".acceptOrderBtn", function(e) {
        $(this).addClass('pointer-none');
    });
    
    //on Single click donot cancel order
    $('body').on("click", ".cancelOrderBtn", function(e) {
        return false;
    });
    
    //cancel order on double click
    $('body').on("dblclick", ".cancelOrderBtn", function(e) {
        $(this).addClass('pointer-none');
        window.location = this.href;
        return false;
     });
    
    if (window.location !== window.parent.location ) 
    { 
        //hide menu, nav, header and apply custom css colors when on iFrame from dashboard v2
        $('.navbar-dark').hide();
        $('.navbar-sticky').hide();
        $("body").overlayScrollbars({
            scrollbars : {
                visibility       : "auto",
                autoHide         : "leave",
                autoHideDelay    : 500
            }
        });
    }
</script>
@endsection