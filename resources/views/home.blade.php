
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
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif

                            You are logged in!
                        </div>
                    </div>
                </div>
            </div>
            <!-- / main -->
        </div>
    </div>
</div>
@endsection
