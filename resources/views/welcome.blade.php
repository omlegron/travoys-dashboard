@extends('layouts.app')

@section('content')
<div id="content" class="app-content" role="main">
    <div class="app-content-body app-content-full">
        <div class="hbox hbox-auto-xs hbox-auto-sm" ng-init="
            app.settings.asideFolded = false;
            app.settings.asideDock = false;
            ">
            <!-- main -->
            <div class="col">
                <!-- main header -->
                <div class="bg-light lter b-b wrapper-md">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <h1 class="m-n font-thin h3 text-black">OUTFLOW / INFLOW</h1>
                            <small class="text-muted">Sub header here</small>
                        </div>
                        <div class="col-sm-6 text-right hidden-xs">
                            <div class="inline m-r text-left">
                                <div class="m-b-xs">1290 <span class="text-muted">items</span></div>
                                <div ng-init="d3_1=[ 106,108,110,105,110,109,105,104,107,109,105,100,105,102,101,99,98 ]"
                                    ui-jq="sparkline"
                                    ui-options="[ 106,108,110,105,110,109,105,104,107,109,105,100,105,102,101,99,98 ], {type:'bar', height:20, barWidth:5, barSpacing:1, barColor:'#dce5ec'}"
                                    class="sparkline inline">loading...
                                </div>
                            </div>
                            <div class="inline text-left">
                                <div class="m-b-xs">$30,000 <span class="text-muted">revenue</span></div>
                                <div ng-init="d3_2=[ 105,102,106,107,105,104,101,99,98,109,105,100,108,110,105,110,109 ]"
                                    ui-jq="sparkline"
                                    ui-options="[ 105,102,106,107,105,104,101,99,98,109,105,100,108,110,105,110,109 ], {type:'bar', height:20, barWidth:5, barSpacing:1, barColor:'#dce5ec'}"
                                    class="sparkline inline">loading...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / main header -->
                <div class="wrapper-md" ng-controller="FlotChartDemoCtrl">
                    <!-- stats -->
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <a href="" class="text-muted pull-right text-lg"><i class="icon-refresh"></i></a>
                                            <h4 class="font-thin m-t-none m-b text-u-c">Latest Campaign</h4>
                                            <div class="text-center">
                                                <h4><small>last </small>12<small> hrs</small></h4>
                                                <small class="text-muted block">yesterday: 20%</small>
                                                <div class="inline">
                                                    <div ui-jq="easyPieChart"  ui-options="{
                                                        percent: 25,
                                                        lineWidth: 10,
                                                        trackColor: '#e8eff0',
                                                        barColor: '#27c24c',
                                                        scaleColor: '#e8eff0',
                                                        size: 188,
                                                        lineCap: 'butt',
                                                        animate: 1000
                                                        }">
                                                        <div>
                                                            <span class="h2 m-l-sm step">25</span>%
                                                            <div class="text text-sm">today</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer"><small>% of change</small></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <a href="" class="text-muted pull-right text-lg"><i class="icon-refresh"></i></a>
                                            <h4 class="font-thin m-t-none m-b text-u-c">Latest Campaign</h4>
                                            <div class="text-center">
                                                <h4>3,450</h4>
                                                <small class="text-muted block">Worldwide visitors</small>
                                                <div class="inline m-t m-b">
                                                    <div ui-jq="easyPieChart" ui-options="{
                                                        percent: 50,
                                                        lineWidth: 10,
                                                        trackColor: '#e8eff0',
                                                        barColor: '#23b7e5',
                                                        scaleColor: false,
                                                        size: 158,
                                                        rotate: 90,
                                                        lineCap: 'butt'
                                                        }">
                                                        <div>
                                                            <span class="h2 m-l-sm step">50</span>%
                                                            <div class="text text-sm">new visits</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer"><small>% of change</small></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel wrapper">
                                <a href="" class="text-muted pull-right text-lg"><i class="icon-refresh"></i></a>
                                <h4 class="font-thin m-t-none m-b text-u-c">Latest Campaign</h4>
                                <div ui-jq="plot" ui-refresh="showSpline" ui-options="
                                    [
                                    { data: [ [0,7],[1,6.5],[2,12.5],[3,7],[4,9],[5,6],[6,11],[7,6.5],[8,8],[9,7] ], label:'TV', points: { show: true, radius: 1}, splines: { show: true, tension: 0.4, lineWidth: 1, fill: 0.8 } },
                                    { data: [ [0,4],[1,4.5],[2,7],[3,4.5],[4,3],[5,3.5],[6,6],[7,3],[8,4],[9,3] ], label:'Mag', points: { show: true, radius: 1}, splines: { show: true, tension: 0.4, lineWidth: 1, fill: 0.8 } }
                                    ],
                                    {
                                    colors: ['#23b7e5', '#7266ba'],
                                    series: { shadowSize: 3 },
                                    xaxis:{ font: { color: '#a1a7ac' } },
                                    yaxis:{ font: { color: '#a1a7ac' }, max:20 },
                                    grid: { hoverable: true, clickable: true, borderWidth: 0, color: '#dce5ec' },
                                    tooltip: true,
                                    tooltipOpts: { content: 'Visits of %x.1 is %y.4',  defaultTheme: false, shifts: { x: 10, y: -25 } }
                                    }
                                    " style="height:246px" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel wrapper">
                                <a href="" class="text-muted pull-right text-lg"><i class="icon-refresh"></i></a>
                                <h4 class="font-thin m-t-none m-b text-u-c">Realisasi Satker</h4>
                                <div class="padder-v">
                                    <span class="text-muted text-xs">Posisi Outflow</span>
                                    <div class="text-primary-dk font-thin h1">
                                        <span>Rp 123,4 T</span>
                                        <small style="font-size: .5em">
                                        <i class="fa fa-caret-up text-warning text-lg"></i>
                                        9%
                                        </small>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="">
                                        <span class="pull-right text-primary">60%</span>
                                        <span>Consulting</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-primary" data-toggle="tooltip" data-original-title="60%" style="width: 60%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-info">35%</span>
                                        <span>Online tutorials</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-info" data-toggle="tooltip" data-original-title="35%" style="width: 35%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-warning">25%</span>
                                        <span>EDU management</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-warning" data-toggle="tooltip" data-original-title="23%" style="width: 25%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-primary">60%</span>
                                        <span>Consulting</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-primary" data-toggle="tooltip" data-original-title="60%" style="width: 60%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-info">35%</span>
                                        <span>Online tutorials</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-info" data-toggle="tooltip" data-original-title="35%" style="width: 35%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-warning">25%</span>
                                        <span>EDU management</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-warning" data-toggle="tooltip" data-original-title="23%" style="width: 25%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-primary">60%</span>
                                        <span>Consulting</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-primary" data-toggle="tooltip" data-original-title="60%" style="width: 60%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-info">35%</span>
                                        <span>Online tutorials</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-info" data-toggle="tooltip" data-original-title="35%" style="width: 35%"></div>
                                    </div>
                                    <div class="">
                                        <span class="pull-right text-warning">25%</span>
                                        <span>EDU management</span>
                                    </div>
                                    <div class="progress progress-xs m-t-sm bg-white">
                                        <div class="progress-bar bg-warning" data-toggle="tooltip" data-original-title="23%" style="width: 25%"></div>
                                    </div>
                                </div>
                                <!-- <div id="container">
                                    <canvas id="canvas" height="500px"></canvas>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- / stats -->
                </div>
            </div>
            <!-- / main -->
        </div>
    </div>
</div>
@endsection