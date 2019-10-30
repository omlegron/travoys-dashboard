@extends('layouts.app')

@push('styles')
<style type="text/css">
    #la-heading {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
    }
    #selfie-panel {
        height: 70vh;
        min-height: 400px;
        margin-bottom: 0;
        border: none;
    }
    #selfie-panel .panel-body {
        padding: 0;
        height: 100%;
        overflow: hidden;
        position: relative;
    }
    #selfie-panel img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: auto;
        min-height: 400px;
        object-fit: cover
    }
    #menu-container {
        /*position: absolute;
        bottom: 0; 
        left: 0; 
        width: 100%*/
    }
    #menu-container > div {
        display: flex;
        align-items: start;
    }
    #menu-container .panel {
        background: rgba(255,255,255,.35)
    }
    #menu-container .panel > .panel-body {
        padding: .25rem
    }
    .menu-block {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
    .menu-block .item {
        /*flex: auto;*/
        padding: .5rem 1.5rem;
        border: 1px solid #999;
        border-radius: 4px;
        width: calc(25% - 1rem);
        margin: .5rem;

        display: flex;
        align-items: center;
        justify-content: start;

        background: #fff;
    }
    .menu-block .item h4 {
        margin-top: 0;
        margin-bottom: 0;
        display: inline;
        font-size: 12px
    }
</style>
@endpush

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
                {{-- <div class="bg-light lter b-b wrapper-md" id="la-heading">
                    <div class="row">
                        <div class="col-xs-6 col-xs-12">
                            <h1 class="m-n font-thin h3 text-black">WELCOME</h1>
                            <small class="text-muted">welcome to the Indonesian bank's web dashboard</small>
                        </div>
                        <div class="col-xs-6 text-right hidden-xs">
                            <!-- list-group-item --> 
                            <a herf="" class="clearfix pull-right">
                                <span class="pull-left thumb-sm avatar m-r">
                                    <!-- <i class="icon-user icon"></i> -->
                                    <img src="{{ asset('src/img/avatar1.png') }}" alt="...">
                                </span>
                                <span class="clear">
                                    <span>{{ auth()->user()->name }}</span>
                                    <small class="text-muted clear text-ellipsis">{{ auth()->user()->email }}</small>
                                </span>
                            </a>
                        </div>
                    </div>
                </div> --}}

                <!-- / main header -->
                <div class="wrapper-md">
                   <div class="panel b-a">
                        <div class="panel-heading no-border bg-red text-white text-center" style="background: #dd0000">          
                            <span class="text-lt"><i class="fa fa-bar-chart-o"></i> Dashboards</span>
                        </div>
                        @include('home.section-dashboard')
                    </div>
                    
                </div>
            </div>
            <!-- / main -->
        </div>
    </div>
</div>
@endsection