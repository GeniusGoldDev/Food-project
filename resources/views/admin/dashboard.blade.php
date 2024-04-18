@extends('admin.layouts.master')
@section("title")
Dashboard
@endsection
@section('content')
<style>
    .chart-container {
    margin-top: 5rem;
    overflow: hidden;
    }
    .chart-container.has-scroll {
    overflow: hidden;
    }
</style>
<div class="content mb-5">
    <div class="row mt-4">
        <div class="col-6 col-xl-3 mb-2 mt-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-left text-default" href="{{ route('admin.orders') }}">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-right mt-10 d-none d-sm-block">
                            <i class="dashboard-display-icon icon-basket"></i>
                        </div>
                        <div class="dashboard-display-number">{{ $displaySales }}</div>
                        <div class="font-size-sm text-uppercase text-muted">Orders</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-6 col-xl-3 mb-2 mt-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-left text-default" href="{{ route('admin.users') }}">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-right mt-10 d-none d-sm-block">
                            <i class="dashboard-display-icon icon-users4"></i>
                        </div>
                        <div class="dashboard-display-number">{{ $displayUsers }}</div>
                        <div class="font-size-sm text-uppercase text-muted">Users</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-6 col-xl-3 mb-2 mt-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-left text-default" href="{{ route('admin.restaurants') }}">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-right mt-10 d-none d-sm-block">
                            <i class="dashboard-display-icon icon-store2"></i>
                        </div>
                        <div class="dashboard-display-number">{{ $displayRestaurants }}</div>
                        <div class="font-size-sm text-uppercase text-muted">Stores</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-6 col-xl-3 mb-2 mt-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-left text-default" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-right mt-10 d-none d-sm-block">
                            <i class="dashboard-display-icon icon-coin-dollar"></i>
                        </div>
                        <div class="dashboard-display-number">{{ config('appSettings.currencyFormat') }} {{ $displayEarnings }}</div>
                        <div class="font-size-sm text-uppercase text-muted">Earnings</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <h4 class="panel-title pl-1 mt-4"><strong>Recent Orders <a href="{{ route('admin.orders') }}" class="btn btn-default float-right">View All</a></strong></h4>
            <div class="mt-2" style="min-height: 30rem;">
                @foreach($orders as $order)
                <div class="recent-order-card p-2">
                    <a href="{{ route('admin.viewOrder', $order->unique_order_id) }}">
                        <div class="float-right text-right">
                            <span class="badge order-badge badge-color-{{$order->orderstatus_id}} border-grey-800">
                            @if ($order->orderstatus_id == 1) Order Placed @endif
                            @if ($order->orderstatus_id == 2) Order Accepted @endif
                            @if ($order->orderstatus_id == 3) Delivery Assigned @endif
                            @if ($order->orderstatus_id == 4) Picked Up @endif
                            @if ($order->orderstatus_id == 5) Completed @endif
                            @if ($order->orderstatus_id == 6) Canceled @endif
                            @if ($order->orderstatus_id == 7) Ready for Pickup @endif
                            @if ($order->orderstatus_id == 8) Awaiting Payment @endif
                            @if ($order->orderstatus_id == 9) Payment Failed @endif
                            </span>
                            <br>
                            @if($agent->isDesktop())
                            @if($order->orderstatus_id == 5)
                            <p class="order-dashboard-time min-fit-content mt-1"><b>Completed in: </b>{{ timeStrampDiffFormatted($order->created_at, $order->updated_at) }}</p>
                            @elseif($order->orderstatus_id == 6)
                            <p class="order-dashboard-time min-fit-content mt-1"><b>Cancelled in: </b> {{ timeStrampDiffFormatted($order->created_at, $order->updated_at) }}</p>
                            @else
                            <p class="liveTimer mt-1 text-center min-fit-content order-dashboard-time" title="{{ $order->created_at }}"><i class="icon-spinner10 spinner position-left"></i></p>
                            @endif
                            @endif
                        </div>
                        <div class="d-flex justify-content-start">
                            <div>
                                <img src="{{substr(url("/"), 0, strrpos(url("/"), '/'))}}"
                                alt="" height="70" width="70"
                                style="border-radius: 8px;">
                            </div>
                            <div class="ml-2">
                                <span><b></b></span>
                                <br>
                                <span>#{{ substr ($order->unique_order_id, -9)  }}</span>
                                <br>
                                <span><strong>{{ config('appSettings.currencyFormat') }}{{ $order->total }}</strong></span>
                            </div>
                        </div>
                        @if($agent->isMobile())
                        <div class="mt-2">
                            @if($order->orderstatus_id == 5)
                            <p class="order-dashboard-time min-fit-content mt-1"><b>Completed in: </b>{{ timeStrampDiffFormatted($order->created_at, $order->updated_at) }}</p>
                            @elseif($order->orderstatus_id == 6)
                            <p class="order-dashboard-time min-fit-content mt-1"><b>Cancelled in: </b> {{ timeStrampDiffFormatted($order->created_at, $order->updated_at) }}</p>
                            @else
                            <p class="liveTimer mt-1 text-center min-fit-content order-dashboard-time" title="{{ $order->created_at }}"><i class="icon-spinner10 spinner position-left"></i></p>
                            @endif
                        </div>
                        @endif
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-xl-6 d-none d-md-block">
            <div class="panel panel-flat">
                <div class="panel-body">
                    @if($ifAnyOrders)
                    <div class="chart-container has-scroll">
                        <div class="chart has-fixed-height has-minimum-width" id="basic_donut"></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <h4 class="panel-title pl-1 mt-4"><strong>New Users <a href="{{ route('admin.users') }}" class="btn btn-default float-right">View All</a></strong></h4>
            <div class="mt-2">
                <div class="row">
                    @foreach($users as $user)
                    <div class="col-md-4">
                        <div class="col-md-12 new-users p-2">
                            <a href="{{ route('admin.get.editUser', $user->id) }}">
                                <div class="float-right">
                                    @foreach ($user->roles as $role)
                                    <span class="badge badge-flat border-grey-800 text-default text-capitalize">
                                    {{ $role->name }}
                                    </span>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="first-letter-icon custom-bg-{{ rand(1,8) }}">
                                        {{ returnAcronym($user->name) }}
                                    </div>
                                    <div class="ml-2">
                                        <span> {{ $user->name }}</span><br>
                                        <span>{{ $user->email }}</span><br>
                                        <span>{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
    
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
    
        require.config({
            paths: {
                echarts: '{{ substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/visualization/echarts'
            }
        });
    
        require(
            [
                'echarts',
                'echarts/theme/limitless',
                'echarts/chart/pie',
                'echarts/chart/funnel',
            ],
    
            function (ec, limitless) {
    
                var basic_donut = ec.init(document.getElementById('basic_donut'), limitless);
              
                basic_donut_options = {
    
                    // Add title
                    title: {
                        text: 'Overview Of Order Statuses',
                        subtext: 'Of all orders till {{ $todaysDate }}',
                        x: 'center'
                    },
    
                    // Add legend
                    legend: {
                        show: false,
                        orient: 'vertical',
                        x: 'left',
                        data: {!! $orderStatusesName !!}
                    },
    
                    // Display toolbox
                    toolbox: {
                        show: false,
                    },
    
                    // Enable drag recalculate
                    calculable: false,
    
                    // Add series
                    series: [
                        {
                            name: 'Orders',
                            type: 'pie',
                            radius: ['50%', '70%'],
                            center: ['50%', '58%'],
                            itemStyle: {
                                normal: {
                                    label: {
                                        show: true
                                    },
                                    labelLine: {
                                        show: true
                                    }
                                },
                                emphasis: {
                                    label: {
                                        show: true,
                                        formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                                        position: 'center',
                                        textStyle: {
                                            fontSize: '17',
                                            fontWeight: '500'
                                        }
                                    }
                                }
                            },
    
                            data: {!! $orderStatusesData !!} 
                        }
                    ]
                };
    
                basic_donut.setOption(basic_donut_options);
    
                 window.onresize = function () {
                    setTimeout(function (){
                        basic_donut.resize();
                    }, 200);
                }
    
            }
        );
    });
</script>
@endsection