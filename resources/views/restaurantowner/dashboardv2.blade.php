@extends('admin.layouts.master')
@section("title")
{{__('storeDashboard.dashboardTitle')}}
@endsection
@section('content')
<style>
    .dashboard-stats {
    display: none !important;
    }
    .single-order-parent {
    border-radius: 0.25rem;
    background-color: #192038;
    cursor: pointer;
    }
    body {
    background-color: #161B31;
    }
    .card {
    background-color: #222b45;
    border: 1px solid #101426;
    color: #fff;
    }
    .card a {
    color: #fff;
    transition: 0.15s linear all;
    }
    .card a:hover {
    color: #ddd;
    transition: 0.15s linear all;
    }
    .card hr {
    border-color: #151a30;
    }
    .dark-badge {
    background-color: #222b45;
    border: 1px solid #101426;
    color: #fff;
    }
    @media (min-width: 1200px) {
    .container {
    max-width: 1250px;
    }
    } 
    .content-wrapper {
    height: 95vh;
    overflow-y: hidden;
    }
    .navbar-dark {
    display: none;
    }
    .navbar-sticky {
    display: none;
    }
    .modal-backdrop {
    background-color: #161B31;
    }
    .order-dashboard-time {
    background-color: transparent;
    border-radius: 0;
    text-align: left !important;
    padding: 0;
    color: #969696;
    margin-top: 0 !important;
    }
</style>
<div class="content">
    <div class="d-flex justify-content-end mt-2">
        @if($autoPrinting)
        <button class="btn text-danger btn-md mr-2 mt-2 float-right printerStatus" data-popup="tooltip" data-placement="right" title="{{ __('thermalPrinterLang.connectingToPrinterFailedMessage') }}" style="border: 0; background-color: #222b45;"><i class="icon-printer4"></i>
        </button>
        @endif
        <a href="{{ route('restaurant.zenMode', "false") }}" class="btn text-white btn-md mr-1 mt-2" style="border: 0; background-color: #222b45;"><i class="icon-switch" data-popup="tooltip" data-placement="right" title="Quit ZenMode"></i></a>
    </div>

    <div class="row mt-4" @if($agent->isMobile()) style="display: block; overflow-x: auto; white-space: nowrap;" @endif>
    <div class="col @if($agent->isMobile()) d-inline-block @endif">
        <div class="card">
            <div class="text-center">
                <h4 class="mt-2 mb-0"><strong>{{__('storeDashboard.dashboardNewOrders')}} <span class="badge badge-flat dark-badge ml-1" id="newOrdersCount">
                    {{ count($newOrders) }}
                    </span></strong>
                </h4>
                <hr class="mt-1 mb-0">
            </div>
            <div class="card-body px-2" style="height: 95vh; overflow-y: scroll;">
                @if(!count($newOrders))
                <div class="text-center pt-2 pb-1 single-order-parent" id="newOrdersNoOrdersMessage">
                    <h4> {{__('storeDashboard.dashboardNoOrders')}} </h4>
                </div>
                @endif
                @foreach($newOrders as $nO)
                <div class="single-order-parent p-2 mb-3">
                    <div class="single-order single-new-order" data-order="{{ $nO->unique_order_id }}">
                        <a href="javascript:void(0)" class="letter-icon-title"><b>{{ $nO->unique_order_id }}</b></a>
                        <br>
                        {{ $nO->restaurant->name }}
                        <br>
                         @php
                            if(!is_null($nO->tip_amount)) {
                                $nOTotal = $nO->total - $nO->tip_amount;
                            } else {
                                $nOTotal = $nO->total;
                            }
                        @endphp
                        {{ config('appSettings.currencyFormat') }}{{ $nOTotal }}
                        <br>
                        @if($nO->delivery_type == 2)
                        <span class="badge badge-flat dark-badge">
                        {{__('storeDashboard.dashboardSelfPickup')}}
                        </span>
                        @endif
                    </div>
                    <p class="liveTimer my-1 text-center min-fit-content order-dashboard-time" title="{{ $nO->created_at }}"><i class="icon-spinner10 spinner position-left"></i></p>
                    <div class="new-order-actions d-flex mt-1">
                        <a href="javascript:void(0)"
                            class="btn btn-primary accpetOrderBtnTableList mr-1" data-id={{ $nO->id }}>
                        {{__('storeDashboard.dashboardAcceptOrder')}} </a>
                        <a href="{{ route('restaurant.cancelOrder', $nO->id) }}"
                            class="btn btn-danger cancelOrderBtnTableList" data-popup="tooltip"
                            data-placement="top" title="{{ __('storeDashboard.dashboardDoubleClickMsg') }}">{{__('storeDashboard.dashboardCancelOrder')}} </a>
                    </div>
                </div>
                @if($loop->last) 
                <div style="height: 10rem;"></div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="col @if($agent->isMobile()) d-inline-block @endif">
        <div class="card">
            <div class="text-center">
                <h4 class="mt-2 mb-0"><strong>{{__('storeDashboard.dashboardPreparingOrders')}} <span class="badge badge-flat dark-badge ml-1">
                    {{ count($preparingOrders) }}
                    </span></strong>
                </h4>
                <hr class="mt-1 mb-0">
            </div>
            <div class="card-body px-2" style="height: 95vh; overflow-y: scroll;">
                @if(!count($preparingOrders))
                <div class="text-center pt-2 pb-1 single-order-parent" id="newOrdersNoOrdersMessage">
                    <h4> {{__('storeDashboard.dashboardNoOrders')}} </h4>
                </div>
                @endif
                @foreach($preparingOrders as $pO)
                <div class="single-order-parent p-2 mb-3">
                    <div class="single-order" data-order="{{ $pO->unique_order_id }}">
                        <a href="javascript:void(0)" class="letter-icon-title"><b>{{ $pO->unique_order_id }}</b></a>
                        <br>
                        {{ $pO->restaurant->name }}
                        <br>
                         @php
                            if(!is_null($pO->tip_amount)) {
                                $pOTotal = $pO->total - $pO->tip_amount;
                            } else {
                                $pOTotal = $pO->total;
                            }
                        @endphp
                        {{ config('appSettings.currencyFormat') }}{{ $pOTotal }}
                        <br>
                        @if($pO->delivery_type == 2)
                        <span class="badge badge-flat dark-badge">
                        {{__('storeDashboard.dashboardSelfPickup')}}
                        </span>
                        @endif
                    </div>
                    <p class="liveTimer my-1 text-center min-fit-content order-dashboard-time" title="{{ $pO->created_at }}"><i class="icon-spinner10 spinner position-left"></i></p>
                </div>
                @if($loop->last) 
                <div style="height: 10rem;"></div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="col @if($agent->isMobile()) d-inline-block @endif">
        <div class="card">
            <div class="text-center">
                <h4 class="mt-2 mb-0"><strong>{{__('storeDashboard.dashboardSelfpickupOrders')}} <span class="badge badge-flat dark-badge ml-1">
                    {{ count($selfpickupOrders) }}
                    </span></strong>
                </h4>
                <hr class="mt-1 mb-0">
            </div>
            <div class="card-body px-2" style="height: 95vh; overflow-y: scroll;">
                @if(!count($selfpickupOrders))
                <div class="text-center pt-2 pb-1 single-order-parent" id="newOrdersNoOrdersMessage">
                    <h4> {{__('storeDashboard.dashboardNoOrders')}} </h4>
                </div>
                @endif
                @foreach($selfpickupOrders as $spO)
                <div class="single-order-parent p-2 mb-3">
                    <div class="single-order single-self-pickup-order" data-order="{{ $spO->unique_order_id }}" data-orderstatusid="{{ $spO->orderstatus_id }}">
                        <a href="javascript:void(0)" class="letter-icon-title"><b>{{ $spO->unique_order_id }}</b></a>
                        <br>
                        {{ $spO->restaurant->name }}
                        <br>
                        {{ config('appSettings.currencyFormat') }}{{ $spO->total }}
                        <br>
                    </div>
                    <div class="d-flex mt-1">
                        @if($spO->delivery_type == 2 && $spO->orderstatus_id == 2)
                        <a href="{{ route('restaurant.markOrderReady', $spO->id) }}"
                            class="btn btn-warning btn-labeled btn-labeled-left mr-2 actionAfterAccept"> <b><i
                            class="icon-checkmark3 ml-1"></i></b> {{__('storeDashboard.dashboardMarkAsReady')}} </a>
                        @endif
                        @if($spO->delivery_type == 2 && $spO->orderstatus_id == 7)
                        <a href="{{ route('restaurant.markSelfPickupOrderAsCompleted', $spO->id) }}"
                            class="btn btn-success btn-labeled btn-labeled-left mr-2 actionAfterAccept"> <b><i
                            class="icon-checkmark3 ml-1"></i></b> {{__('storeDashboard.dashboardMarkAsCompleted')}} </a>
                        @endif
                    </div>
                </div>
                @if($loop->last) 
                <div style="height: 10rem;"></div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

   
    <div class="col @if($agent->isMobile()) d-inline-block @endif">
        <div class="card">
            <div class="text-center">
                <h4 class="mt-2 mb-0"><strong>{{__('storeDashboard.dashboardOngoingDeliveries')}} <span class="badge badge-flat dark-badge ml-1">
                    {{ count($ongoingOrders) }}
                    </span></strong>
                </h4>
                <hr class="mt-1 mb-0">
            </div>
            <div class="card-body px-2" style="height: 95vh; overflow-y: scroll;">
                @if(!count($ongoingOrders))
                <div class="text-center pt-2 pb-1 single-order-parent" id="newOrdersNoOrdersMessage">
                    <h4> {{__('storeDashboard.dashboardNoOrders')}} </h4>
                </div>
                @endif
                @foreach($ongoingOrders as $ogO)
                <div class="single-order-parent p-2 mb-3">
                    <div class="single-order" data-order="{{ $ogO->unique_order_id }}">
                        <a href="javascript:void(0)" class="letter-icon-title"><b>{{ $ogO->unique_order_id }}</b></a>
                        <br>
                        {{ $ogO->restaurant->name }}
                        <br>
                         @php
                            if(!is_null($ogO->tip_amount)) {
                                $ogOTotal = $ogO->total - $ogO->tip_amount;
                            } else {
                                $ogOTotal = $ogO->total;
                            }
                        @endphp
                        {{ config('appSettings.currencyFormat') }}{{ $ogOTotal }}
                        <br>
                        @if($ogO->delivery_type == 2)
                        <span class="badge badge-flat dark-badge">
                        {{__('storeDashboard.dashboardSelfPickup')}}
                        </span>
                        @endif
                    </div>
                </div>
                @if($loop->last) 
                <div style="height: 10rem;"></div>
                @endif
                @endforeach
            </div>
        </div>
    </div>

</div>
<div id="viewOrderModal" class="modal fade mt-1" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="height: 85vh;border-radius: 0.8rem;">
            <div class="float-right pr-3 pt-3" style="position: absolute; right: 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0" style="border-radius: 0.8rem;">
                <iframe src="" frameborder="0" style="overflow:hidden;height:100%;width:100%;border-radius: 0.8rem;min-height: 100vh;" height="100%" width="100%"></iframe>
                <input type="hidden" value="">
            </div>
        </div>
    </div>
</div>
<div id="newOrderModal" class="modal fade mt-5" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title mt-3"> <i class="icon-bell3 animated-bell"></i> </h5>
            </div>
            <div class="float-right pr-3 pt-3" style="position: absolute; right: 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="newOrdersData">
                <div class="d-flex justify-content-center">
                    <h3 class="text-muted"> {{__('storeDashboard.dashboardNoOrders')}} </h3>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
<script>

    var autoPrinting = '{{ $autoPrinting }}';

    if (autoPrinting) {
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
                    $('.printerStatus').attr('data-original-title', '{{__('thermalPrinterLang.connectingToPrinterFailedMessage')}}').removeClass('text-success').addClass('text-danger');
                }
                if (socket != null && socket.readyState == 1) {
                     $('.printerStatus').removeClass('text-danger').addClass('text-success').attr('data-original-title', '{{ __('thermalPrinterLang.connectionSuccessToLocalServer') }}');
                }
                clearInterval(checkSocketConnecton);
            }, 500)
        };
    }

    $(function() {

        if (autoPrinting) {
            initializeSocket();
        }


        var touchtime = 0;
    
        timer = setInterval(updateClock, 1000);
    
        var newDate = new Date();
        var newStamp = newDate.getTime();
    
        var timer; 
    
        function updateClock() {
    
            $('.liveTimer').each(function(index, el) {
                var orderCreatedData = $(this).attr("title");
                var startDateTime = new Date(orderCreatedData); 
                var startStamp = startDateTime.getTime();
            
    
                newDate = new Date();
                newStamp = newDate.getTime();
                var diff = Math.round((newStamp-startStamp)/1000);
                
                var d = Math.floor(diff/(24*60*60));
                diff = diff-(d*24*60*60);
                var h = Math.floor(diff/(60*60));
                diff = diff-(h*60*60);
                var m = Math.floor(diff/(60));
                diff = diff-(m*60);
                var s = diff;
                var checkDay = d > 0 ? true : false;
                var checkHour = h > 0 ? true : false;
                var checkMin = m > 0 ? true : false;
                var checkSec = s > 0 ? true : false;
                var formattedTime = checkDay ? d+ " day" : "";
                formattedTime += checkHour ? " " +h+ " hour" : "";
                formattedTime += checkMin ? " " +m+ " minute" : "";
                formattedTime += checkSec ? " " +s+ " second" : "";
    
                $(this).text(formattedTime);
            });
        }
    
        var clickedElem = null;
        var orderstatus_id = null;
        $('.single-order').click(function(event) {
            clickedElem = $(this);
            clickedElem.addClass('popup-order-processing')
            event.preventDefault();
            orderstatus_id = clickedElem.attr("data-orderstatusid");
            let order_id = clickedElem.attr("data-order");
            let url = 'order/'+order_id;
            let iframeElem = $('#viewOrderModal');
            iframeElem.modal('show');
            iframeElem.find('iframe').attr('src', url)
            iframeElem.find('input').val(order_id);
            $('#viewOrderModal').modal('show').find('iframe').attr('src', url);
        });
    
        //on modal hide
        $('#viewOrderModal').on('hidden.bs.modal', function () {
            clickedElem.removeClass('popup-order-processing');
    
            let order_id = $(this).find('input').val();
            let token = $('#csrfToken').val();
    
            if(clickedElem.hasClass("single-new-order")) {
                $.ajax({
                    url: "{{ route('restaurant.checkOrderStatusNewOrder') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {order_id: order_id, _token: token},
                })
                .done(function(data) {
    
                    console.log(data.reloadPage);
                    if (data.reloadPage) {
                        //on true, reload the page
                        window.location.reload();
                    }
                })
                .fail(function() {
                    console.log("error");
                    //reload the page
                    window.location.reload();
                })
            }
            if (clickedElem.hasClass('single-self-pickup-order')) {
                if (orderstatus_id == 7) {
                    var processSelfPickup = true
                } else {
                    processSelfPickup=  false;
                }
                $.ajax({
                    url: "{{ route('restaurant.checkOrderStatusSelfPickupOrder') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {order_id: order_id, _token: token, processSelfPickup: processSelfPickup},
                })
                .done(function(data) {
                    console.log(data.reloadPage);
                    if (data.reloadPage && orderstatus_id == 2) {
                        //on true, reload the page
                        window.location.reload();
                    }
                    if (data.reloadPage && orderstatus_id == 7) {
                        //on true, reload the page
                        window.location.reload();
                    }
                })
                .fail(function() {
                    console.log("error");
                    //reload the page
                    window.location.reload();
                })
            }
        })
    
        $(".card-body").overlayScrollbars({
            scrollbars : {
                visibility       : "auto",
                autoHide         : "leave",
                autoHideDelay    : 500
            }
        });
        
        $('body').on("click", ".accpetOrderBtnTableList", function(e) {
            
            let elem = $(this);
            $(this).parents('.new-order-actions').addClass('popup-order-processing');

            @if($autoPrinting)
                let printType = null;
                let order_id = $(this).data("id");
                let token = $('.csrfToken').val();

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
                        acceptOrderTableList(elem);
                    })
                    .fail(function() {
                        console.log("Print Error.")
                        acceptOrderTableList(elem);
                    })
                @else
                    acceptOrderTableList(elem);
                @endif
        });

        acceptOrderTableList = function(elem) {
            let id = elem.attr("data-id");
            let acceptOrderUrl = "{{ url('/store-owner/orders/accept-order') }}/" +id;
            $.ajax({
                url: acceptOrderUrl,
                type: 'GET',
                dataType: 'JSON',
            })
            .done(function(data) {
                $.jGrowl("{{__('storeDashboard.orderAcceptedNotification')}}", {
                    position: 'bottom-center',
                    header: '{{__('storeDashboard.successNotification')}}',
                    theme: 'bg-success',
                    life: '5000'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 500);
            })
            .fail(function() {
                console.log("error")
                $.jGrowl("{{__('storeDashboard.orderSomethingWentWrongNotification')}}", {
                    position: 'bottom-center',
                    header: '{{__('storeDashboard.woopssNotification')}}',
                    theme: 'bg-warning',
                    life: '5000'
                });
            })
        }
    
        $('body').on("click", ".cancelOrderBtnTableList", function(e) {
            return false;
        });
    
        $('body').on("click", ".cancelOrderBtnTableList", function(e) {
            e.preventDefault()
            if (((new Date().getTime()) - touchtime) < 500) {
                $(this).parents('.new-order-actions').addClass('popup-order-processing');
                window.location = this.href;
                return false;
            }
            touchtime = new Date().getTime();
        });
    
        /* NEW ORDER ALERT POPUP */
        let notification = document.createElement('audio');
        let notificationFileRoute = '{{substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/tones/{{ config('appSettings.restaurantNotificationAudioTrack') }}.mp3';
           notification.setAttribute('src', notificationFileRoute);
           notification.setAttribute('type', 'audio/mp3');
           // notification.setAttribute('muted', 'muted');
           notification.setAttribute('loop', 'true');
        
        $(".stopSound").click(function(event) {
            notification.pause();
            notification.currentTime = 0;
        });
        
      
        const newOrderJson = @json($newOrders);
        console.log(newOrderJson);
    
        setInterval(function() {
            $.ajax({
                url: '{{ route('restaurant.getNewOrders') }}',
                type: 'POST',
                dataType: 'json',
                data: {listed_order_ids: @json($newOrdersIds), _token: $('#csrfToken').val()},
            })
    
            .done(function(newArray) {
                console.log("New Array", newArray)
                console.log(newOrderJson.length);
                console.log(newArray.length );
    
                if (newArray.length > 0) {
                    //if new orders, then lenght will be greater, if order cancelled, then it should not go inside this 
                    console.log("NEW ORDER")
                
                    $('#newOrderModal').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
    
                    //play sound
                    notification.play();
    
                    console.log("New Array", newArray)
                    // const newOrder = newArray[0];
    
                    let newOrderData = "";
                    $.map(newArray, function(order, index) {
                        if(order.delivery_type == 2) {
                            var selfPickup = '<span class="badge badge-flat border-danger-800 text-default text-capitalize ml-1">{{__('storeDashboard.dashboardSelfPickup')}}</span>'
                        } else {
                            selfPickup = "";
                        }
    
                        let viewOrderURL = "{{ url('/store-owner/order') }}/" + order.unique_order_id;
                        
                        if (order.tip_amount != null) {
                            var orderTotal = parseFloat(order.total) - parseFloat(order.tip_amount); 
                        } else {
                             var orderTotal = order.total;
                        }

                        newOrderData +='<div class="popup-order mb-3"><div class="text-center my-3 h5"><strong><span class="text-semibold no-margin">{{ config('appSettings.currencyFormat') }}'+orderTotal+'</span> <i class="icon-arrow-right5"></i> <a href="'+viewOrderURL+'">'+order.unique_order_id+'</a> <i class="icon-arrow-right5"></i>'+order.restaurant.name+'</strong> '+ selfPickup +'</div>';
    
                        newOrderData += '<div class="d-flex justify-content-center"><button data-id="'+order.id+'" class="btn btn-primary btn-labeled btn-labeled-left mr-2 acceptOrderBtn"><b><i class="icon-checkmark3 ml-1"></i></b> {{__('storeDashboard.dashboardAcceptOrder')}} </a> <button data-id="'+order.id+'" class="btn btn-danger btn-labeled btn-labeled-right mr-2 cancelOrderBtnPopup" data-popup="tooltip" data-placement="top" title="{{__('storeDashboard.dashboardDoubleClickMsg')}}"> <b><i class="icon-cross ml-1"></i></b> {{__('storeDashboard.dashboardCancelOrder')}}  </a></div></div>'
                        
    
                        $('#newOrdersData').html(newOrderData);
                        $('#newOrdersNoOrdersMessage').remove();
                    });
                    
                } else {
                    console.log("NO New Order")
                    //when orde has been accepted or denied, length will be 0, close the model
                    $('#newOrderModal').modal('hide');
                }
            })
            .fail(function() {
                console.log("error");
            })  
        }, {{ config("appSettings.restaurantNewOrderRefreshRate") }} * 1000); //all API every x seconds (config settings from admin)
        
        //reload page when popup closed
        $('#newOrderModal').on('hidden.bs.modal', function () {
            window.location.reload();
        });
    
        //process accept order click on new order alert popup
         $('body').on("click", ".acceptOrderBtn", function(e) {
            
            let context = $(this).parents('.popup-order');
            context.addClass('popup-order-processing').prepend('<div class="d-flex pt-2 pr-2 float-right"><i class="icon-spinner10 spinner"></i></div>')
            console.log("HERE", context);
    
            let id = $(this).attr("data-id");
            let acceptOrderUrl = "{{ url('/store-owner/orders/accept-order') }}/" +id;
            $.ajax({
                url: acceptOrderUrl,
                type: 'GET',
                dataType: 'JSON',
            })
            .done(function(data) {
                $(context).remove();
                //count number of order on popup, if 0 then remove popup
                if ($('.popup-order').length == 0) {
                    $('#newOrderModal').modal('hide');
                }
                $.jGrowl("{{__('storeDashboard.orderAcceptedNotification')}}", {
                    position: 'bottom-center',
                    header: '{{__('storeDashboard.successNotification')}}',
                    theme: 'bg-success',
                    life: '5000'
                });
            })
            .fail(function() {
                console.log("error")
                $.jGrowl("{{__('storeDashboard.orderSomethingWentWrongNotification')}}", {
                    position: 'bottom-center',
                    header: '{{__('storeDashboard.woopssNotification')}}',
                    theme: 'bg-warning',
                    life: '5000'
                });
            })
        });
    
         //cancel order on double click popup
         $('body').on("click", ".cancelOrderBtnPopup", function(e) {
            e.preventDefault()
    
            if (((new Date().getTime()) - touchtime) < 500) {
            
             let context = $(this).parents('.popup-order');
             context.addClass('popup-order-processing').prepend('<div class="d-flex pt-2 pr-2 float-right"><i class="icon-spinner10 spinner"></i></div>')
             console.log("HERE", context);
         
             let id = $(this).attr("data-id");
             let cancelOrderURL = "{{ url('/store-owner/orders/cancel-order') }}/" +id;
             $.ajax({
                 url: cancelOrderURL,
                 type: 'GET',
                 dataType: 'JSON',
             })
             .done(function(data) {
                 $(context).remove();
                 //count number of order on popup, if 0 then remove popup
                 if ($('.popup-order').length == 0) {
                     $('#newOrderModal').modal('hide');
                 }
                 $.jGrowl("{{__('storeDashboard.orderCanceledNotification')}}", {
                     position: 'bottom-center',
                     header: '{{__('storeDashboard.successNotification')}}',
                     theme: 'bg-success',
                     life: '5000'
                 });
             })
             .fail(function() {
                 console.log("error");
                 $.jGrowl("{{__('storeDashboard.orderSomethingWentWrongNotification')}}", {
                     position: 'bottom-center',
                     header: '{{__('storeDashboard.woopssNotification')}}',
                     theme: 'bg-warning',
                     life: '5000'
                 });
             })
            }
            touchtime = new Date().getTime();
          });
    });
</script>
@endsection