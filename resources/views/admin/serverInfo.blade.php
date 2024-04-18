@extends('admin.layouts.master')
@section("title") Server Stats - Dashboard
@endsection
@section('content')
<div class="content mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart has-fixed-height" id="cpu_gauge"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="chart-container">
                        <div class="chart has-fixed-height" id="ram_gauge"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>Avg Load: <strong> <span id="avgLoad"> -- </span> </strong> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>PHP Version: <strong> <span>{{ $phpVersion }}</span> </strong> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>Server Up Time: <strong> <span id="upTime"> -- </span></strong> </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p><strong>PHP Extensions</strong></p>
                        <ul class="p-0" style="list-style: none;">
                            @foreach ($phpExtensions->extensions() as $label => $satisfied)
                            <li class="mb-2">
                                @if($satisfied)
                                <i class="icon icon-checkmark-circle text-success mr-1"></i>
                                @else
                                <i class="icon icon-cancel-circle2 text-danger mr-1"></i>
                                @endif
                                {{ $label }} 
                                @if($label == "OPCache PHP Extension" && !$satisfied)
                                <i class="icon-question3 ml-1" data-popup="tooltip" title="OPCache PHP Extension is recommended for faster execution of PHP code." data-placement="top"></i>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        require.config({
        paths: {
            echarts: '{{ substr(url("/"), 0, strrpos(url("/"), '/'))}}/assets/backend/global_assets/js/plugins/visualization/echarts'
        }
    });
    
    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/gauge'
        ],
    
        function (ec, limitless) {
    
            var cpu_gauge = ec.init(document.getElementById('cpu_gauge'), limitless);
    
            var ram_gauge = ec.init(document.getElementById('ram_gauge'), limitless);
          
            cpu_gauge_options = {
                title: {
                    text: 'CPU Usage',
                    subtext: 'Current CPU usage in Percentage',
                    x: 'center'
                },
    
                tooltip: {
                    formatter: "{a} <br/>{b}: {c}%"
                },
    
                series: [
                    {
                        name: 'Processor Usage',
                        type: 'gauge',
                        center: ['50%', '55%'],
                        detail: {formatter:'{value}%'},
                        data: [{value: 50, name: 'CPU usage'}],
    
                        axisLine: {
                            lineStyle: {
                                color: [[0.2, '#2ecc71'], [0.8, '#3498db'], [1, '#e74c3c']], 
                                width: 10
                            }
                        },
                    }
                ]
            };
    
            ram_gauge_options = {
    
                title: {
                    text: 'RAM Usage',
                    subtext: 'Current RAM usage in Percentage',
                    x: 'center'
                },
    
                tooltip: {
                    formatter: "{a} <br/>{b} : {c}%"
                },
    
                series: [
                    {
                        name: 'Memory usage',
                        type: 'gauge',
                        center: ['50%', '55%'],
                        startAngle: 150,
                        endAngle: -150,
    
                        axisLine: {
                            lineStyle: {
                                color: [[0.2, '#2ecc71'], [0.8, '#3498db'], [1, '#e74c3c']], 
                                width: 20
                            }
                        },
    
                        axisTick: {
                            splitNumber: 5,
                            length: 5,
                            lineStyle: {
                                color: '#fff'
                            }
                        },
    
                        axisLabel: {
                            formatter: function(v) {
                                switch (v+''){
                                    case '10': return 'Idle';
                                    case '60': return 'Normal';
                                    case '90': return 'High';
                                    default: return '';
                                }
                            }
                        },
    
                        // Split line
                        splitLine: {
                            length: 35,
                            lineStyle: {
                                color: '#fff'
                            }
                        },
    
                        // Display title
                        title: {
                            offsetCenter: ['-81%', -15],
                            textStyle: {
                                fontSize: 13
                            }
                        },
    
                        // Display details info
                        detail: {
                            offsetCenter: ['-80%', -5],
                            formatter: '{value}%',
                            textStyle: {
                                fontSize: 25
                            }
                        },
    
                        // Add data
                        data: [{value: 50, name: 'Memory usage'}]
                    }
                ]
            };
    
            // clearInterval(refreshData);
            function refreshData() {
               $.ajax({
                   url: '{{ route('admin.getServerStatsData') }}',
                   type: 'GET',
                   dataType: 'JSON',
               })
               .done(function(data) {
                   console.log(data);
                   cpu_gauge_options.series[0].data[0].value = data.cpu;
                   cpu_gauge.setOption(cpu_gauge_options, true);
    
                   ram_gauge_options.series[0].data[0].value = data.ramUsedPercentage;
                   ram_gauge.setOption(ram_gauge_options, true);
    
                   $('#avgLoad').html(data.avgLoad);
                   $('#upTime').html(data.upTime.text);
               })
               .fail(function(data) {
                   console.log(data.responseJSON.message);
                   $.jGrowl("", {
                       position: 'bottom-center',
                       header: data.responseJSON.message,
                       theme: 'bg-danger',
                       life: '5000'
                   })
               })
               
               setTimeout(refreshData, 5000);
            }
            refreshData();
    
            cpu_gauge.setOption(cpu_gauge_options);
            ram_gauge.setOption(ram_gauge_options);
        });
    
    });
    
</script>
@endsection