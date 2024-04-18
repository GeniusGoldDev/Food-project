@extends('admin.layouts.master')
@section("title")
Reports - Top Items | Dashboard 
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
    .select2-selection--single .select2-selection__rendered {
    padding-left: .875rem !important;
    padding-right: 5.375rem !important;
    }
    .range-selector {
    margin: 10px;
    }
</style>
<div class="page-header">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-circle-right2 mr-2"></i>
                <span class="font-weight-bold mr-2">Most Sold items</span>
                <span class="badge badge-primary badge-pill animated flipInX mr-2"></span>
            </h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
        <div class="header-elements">
            <form action="{{ route('admin.viewTopItems') }}" method="GET">
                <div class="form-group row mb-0">
                    <div class="col-lg-5">
                        <select class="form-control selectRest" name="restaurant_id" style="width: 300px;">
                            <option></option>
                            @foreach ($restaurants as $restaurant_select)
                            <option value="{{ $restaurant_select->id }}" @if( app('request')->input('restaurant_id') == $restaurant_select->id) selected @endif class="text-capitalize">{{ $restaurant_select->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-5">
                        <select class="form-control selectRange" name="range" required> 
                        <option value="1" @if(app('request')->input('range') == '1') selected @endif class="text-capitalize">This Week</option>
                        <option value="2" @if(app('request')->input('range') == '2') selected @endif class="text-capitalize">Last 7 Days</option>
                        <option value="3" @if(app('request')->input('range') == '3') selected @endif class="text-capitalize">This Month ({{ \Carbon\Carbon::now()->format('F')}})</option>
                        <option value="4" @if(app('request')->input('range') == '4') selected @endif class="text-capitalize">Last 30 Days</option>
                        <option value="5" @if(app('request')->input('range') == '5') selected @endif class="text-capitalize">All Time</option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">
                        <i class="icon-search4"></i>
                        </button>
                    </div>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
<div class="content mb-5">
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-flat dashboard-main-col mt-4" style="min-height: 30rem;">
                <div class="panel-heading">
                    <h4 class="panel-title pl-3 pt-3"><strong>Top 10 Most sold items </strong></h4>
                    <hr>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        @if($top_items_completed_restaurant)
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Sales Count</th>
                                <th>Net. Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_items_completed_restaurant as $item)
                            <tr>
                                <td>    
                                    <a href="{{ route('admin.get.editItem', $item->item_id) }}" class="letter-icon-title">{{ $item->name }}</a>
                                </td>
                                <td>
                                    {{ $item->qty}}
                                </td>
                                <td>
                                    <span class="text-semibold no-margin">{{ config('appSettings.currencyFormat') }} {{ round($item->price * $item->qty) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Sales Count</th>
                                <th>Net. Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_items_total as $top_item)
                            <tr>
                                <td>    
                                    <a href="{{ route('admin.get.editItem', $top_item->item_id) }}" class="letter-icon-title">{{ $top_item->name }}</a>
                                </td>
                                <td>
                                    {{ $top_item->qty}}
                                </td>
                                <td>
                                    <span class="text-semibold no-margin">{{ config('appSettings.currencyFormat') }} {{ round($top_item->price * $top_item->qty) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 d-none d-md-block">
            <div class="panel panel-flat">
                <div class="panel-body">
                    @if($anyOrder)
                    <div class="chart-container has-scroll">
                        <div class="chart has-fixed-height has-minimum-width" id="basic_bar"></div>
                    </div>
                    @else
                    <div class="chart-container has-scroll">
                        <h3 class="text-center"><i class="icon-exclamation"></i> No data</h3>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
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
                'echarts/chart/pie',
                'echarts/chart/funnel'
            ],
    
            function (ec, limitless) {
    
                var basic_bar = ec.init(document.getElementById('basic_bar'), limitless);
              
                basic_bar_options = {
                  
                    // Add title
                    title: {
                        text: 'Overview Of Most Sold Items',
                        subtext: 'Of all orders till {{ $todaysDate }}',
                        x: 'center'
                    },
    
                    // Add legend
                    legend: {
                        show: false,
                        orient: 'vertical',
                        x: 'left',
                        @if($top_items_restaurant)
                        data: {!! $top_items_restaurant !!}
                        @else
                        data:  {!! $top_items_data !!}
                        @endif
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
                                        formatter: '{b}' + '\n\n' + 'Sold : ' +'{c}',
                                        position: 'center',
                                        textStyle: {
                                            fontSize: '17',
                                            fontWeight: '500'
                                        }
                                    }
                                }
                            },
                            
                            @if($top_items_restaurant)
                        data: {!! $top_items_restaurant !!}
                        @else
                        data:  {!! $top_items_data !!}
                        @endif
                        }
                    ]
                };
    
                basic_bar.setOption(basic_bar_options);
    
                window.onresize = function () {
                    setTimeout(function (){
                        basic_bar.resize();
                    }, 200);
                }
            }
        );
    });
    
    $('.selectRest').select2({
        placeholder: 'Select Store',
        allowClear: true,
        width: "300px"
    });

     $('.selectRange').select2();
    
    $('.daterange-single').daterangepicker({ 
        singleDatePicker: true,
    });
    $('.daterange-single1').daterangepicker({ 
        singleDatePicker: true,
    });
</script>
@endsection