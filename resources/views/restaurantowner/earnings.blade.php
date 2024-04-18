@extends('admin.layouts.master')
@section("title") {{__('storeDashboard.epTitle')}}
@endsection
@section('content')
<div class="content">
    @if(!empty($restaurants))
    <div class="row">
        <div class="form-group row mt-5">
            <label class="col-lg-12 col-form-label"><span class="text-danger">*</span>{{__('storeDashboard.epSelectStore')}}:</label>
            <div class="col-lg-12">
                <select class="form-control select-search select" name="restaurant_id" required id="dynamic_select" style="height: 2.5rem;">
                    <option value="">{{__('storeDashboard.epSelect')}} </option>
                    @foreach ($restaurants as $restaurant)
                    <option value="{{ route('restaurant.earnings') }}/{{ $restaurant->id }}" class="text-capitalize">{{ $restaurant->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('.select').select2(); 
          // bind change event to select
          $('#dynamic_select').on('change', function () {
              var url = $(this).val(); // get selected value
              if (url) { // require a URL
                  window.location = url; // redirect
              }
              return false;
          });
        });
    </script>
    @endif
    @if(!Request::is('store-owner/earnings'))
    <div class="row mt-4">
        <div class="col-12 col-xl-4 mb-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="text-center" style="color: #717171; font-weight: 500;">{{__('storeDashboard.epNetEarningsBeforeCommission')}}</div>
                        <div class="dashboard-display-number text-center">{{ config('appSettings.currencyFormat') }}{{ $balanceBeforeCommission }}</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="text-center" style="color: #717171; font-weight: 500;">{{__('storeDashboard.epYourBalanceAfterCommission')}}  <strong>{{ $restaurant->commission_rate }}%)</strong></div>
                        <div class="dashboard-display-number text-center">{{ config('appSettings.currencyFormat') }}{{ $balanceAfterCommission }}</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-2">
            <div class="col-xl-12 dashboard-display p-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="text-center" style="color: #717171; font-weight: 500;">{{__('storeDashboard.epTotalValueBeforeCommission')}}</div>
                        <div class="dashboard-display-number text-center">{{ config('appSettings.currencyFormat') }}{{ $totalEarning }}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row mt-4 d-none d-md-block">
        <div class="col-xl-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="chart-container hidden">
                        <div class="chart has-fixed-height has-minimum-width" id="basic_area"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-xl-12 p-3" style="border-radius: 4px; background-color: #fff; box-shadow: 0 1px 6px 1px rgba(0, 0, 0, 0.05);">
                <h4>
                    <strong>{{__('storeDashboard.epRequestPayout')}}</strong>
                </h4>

                @if(!((double)$balanceAfterCommission > (double)config('appSettings.minPayout')))
                <p>
                {{__('storeDashboard.epYourCurrentBalance')}} <strong>{{ config('appSettings.currencyFormat') }}{{$balanceAfterCommission}}</strong>. {{__('storeDashboard.epReqPayoutMessage')}}<strong> {{ config('appSettings.currencyFormat') }}{{ config('appSettings.minPayout') }}</strong>.
                </p>
                <i class="icon-exclamation" style="position: absolute; font-size: 5rem; color: #FF5722; right: 15px; top: 15px; opacity: 0.1;"></i>
                @else
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#sendPayoutRequest">{{__('storeDashboard.epRequestPayout')}}</button>
                <i class="icon-piggy-bank" style="position: absolute; font-size: 5rem; color: #FF5722; right: 15px; top: 15px; opacity: 0.1;"></i>

                <div id="sendPayoutRequest" class="modal fade mt-5" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><span class="font-weight-bold">{{__('storeDashboard.epRequestPayout')}}</span></h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <span class="help-text">
                                {{__('storeDashboard.epYourRequest')}} <strong>{{ config('appSettings.currencyFormat') }}{{$balanceAfterCommission}}</strong>
                                </span>
                                <div class="modal-footer mt-4">
                                    <form method="POST" action="{{ route('restaurant.sendPayoutRequest') }}">
                                        <input type="hidden" name="restaurant_id" value={{$restaurant->id}}>
                                        @csrf
                                    <button type="submit" class="btn btn-primary">{{__('storeDashboard.epSendRequest')}}</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('storeDashboard.epCancelReq')}}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    @if(!empty($payoutRequests))
    <div class="container">
        <div class="row mt-5 mb-5" style="border-radius: 4px; background-color: #fff; box-shadow: 0 1px 6px 1px rgba(0, 0, 0, 0.05);">
            <div class="col-xl-12">
                <h4 class="p-3">
                    <strong>
                        {{ __('storeDashboard.epRequestPayouts') }}
                    </strong>
                </h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                {{__('storeDashboard.epTableAmount')}}
                                </th>
                                <th>
                                {{__('storeDashboard.epTableStatus')}}
                                </th>
                                <th>
                                {{__('storeDashboard.epTableTransactionMode')}}                                </th>
                                <th>
                                {{__('storeDashboard.epTableTransactionID')}}
                                </th>
                                <th>
                                {{__('storeDashboard.epTableMessage')}}
                                </th>
                                <th>
                                {{__('storeDashboard.epTableCreated')}}
                                </th>
                                <th>
                                {{__('storeDashboard.epTableUpdated')}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payoutRequests as $payoutRequest)
                            <tr>
                                <td>{{ $payoutRequest->amount }}</td>
                                <td><span class="badge badge-flat border-grey-800 text-default text-capitalize">{{ $payoutRequest->status }}</span></td>
                                <td>
                                    @if($payoutRequest->transaction_mode != NULL)
                                    {{ $payoutRequest->transaction_mode }}
                                    @else
                                    ----
                                    @endif
                                </td>
                                <td>
                                    @if($payoutRequest->transaction_id != NULL)
                                    {{ $payoutRequest->transaction_id }}
                                    @else
                                    ----
                                    @endif
                                </td>
                                 <td>
                                    @if($payoutRequest->message != NULL)
                                    {{ $payoutRequest->message }}
                                    @else
                                    ----
                                    @endif
                                </td>
                                <td>{{ $payoutRequest->created_at->format('Y-m-d  - h:i A') }}</td>
                                <td>
                                    @if($payoutRequest->updated_at != NULL)
                                    {{ $payoutRequest->updated_at->format('Y-m-d  - h:i A') }}
                                    @else
                                    ----
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        $(function () {
        
            require.config({
                paths: {
                    echarts: '{{ substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/visualization/echarts'
                }
            });
        
            require(
                [
                    'echarts',
                    'echarts/theme/limitless',
                    'echarts/chart/bar',
                    'echarts/chart/line'
                ],
        
                function (ec, limitless) {
        
                    var basic_area = ec.init(document.getElementById('basic_area'), limitless);
                  
                    basic_area_options = {
                        
                        // Setup grid
                        grid: {
                            x: 40,
                            x2: 20,
                            y: 35,
                            y2: 25
                        },
        
                        // Add tooltip
                        tooltip: {
                            trigger: 'axis'
                        },
        
                        
                        calculable: false,
        
        
                            // Horizontal axis
                            xAxis: [{
                                type: 'category',
                                boundaryGap: false,
                                data: {!! $monthlyDate !!},
                            }],
        
                            // Vertical axis
                            yAxis: [{
                                name: "{{__('storeDashboard.epChartEarningsIn')}} {{ config('appSettings.currencyFormat') }}",
                                nameLocation: "end",
                                type: 'value'
                            }],
        
                            // Add series
                            series: [
                                {
                                    name: "{{__('storeDashboard.epChartSalesIn')}} {{ config('appSettings.currencyFormat') }}",
                                    type: 'line',
                                    smooth: true,
                                    itemStyle: {normal: {areaStyle: {type: 'default'}}},
                                    data: {!! $monthlyEarning !!},
                                    itemStyle: {
                                        normal: {
                                            label: {
                                                show: true,
                                                textStyle: {
                                                    fontWeight: 500,
                                                }
                                            }
                                        }
                                    },
                                },
                            ]
                        };
                    basic_area.setOption(basic_area_options);
        
                    window.onresize = function () {
                        setTimeout(function (){
                            basic_area.resize();
                        }, 200);
                    }
                }
            );
        });
    </script>
    @endif
</div>
@endsection