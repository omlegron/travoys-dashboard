@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/form.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('libs/assets/bootstrap-select/bootstrap-select.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.min.css') }}" type="text/css" />
@endpush

@push('js')
    <script src="{{ asset('libs/assets/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('libs/jquery/redirect/jquery.redirect.js') }}"></script>
    <script src="{{ asset('js/numeral.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('styles')
    <style>
        .selectpicker option{
            color:#363636 !important;
            padding: 0!important;
            margin: 0!important;
        }   
        .small{
            /*margin-top: -40px !important;*/
            margin: -20!important;
            padding: -20!important;
            font-size: 9px !important;
            color: #3f5e60 !important;
        }
        .bg-panel{
            background:#111 !important;
            /*background:#1c2b36 !important;*/
            /*border: 1px solid rgba(210, 214, 216, 0.1) !important;*/
            border: 1px solid rgba(255, 255, 255, .5) !important;
            padding-bottom: 0 !important;
        }
        .heading h4, .heading .h4, .heading h5, .heading .h5, .heading h6, .heading .h6 {
            margin-top: 10px;
            margin-bottom: 0px !important;
        }
        .m-b-lg {
            margin-bottom: 12px;
        }
        .selectpicker
        {
            color:#363636 !important;
            font-size:9px !important;
        }
        .color-backround{
            background:rgb(0, 0, 0) !important;
            color: #FFF;
        }
        .color-tab{
            background:#111 !important;
            color: #FFF;
            /border: 1px 1px 1px solid rgba(210, 214, 216, 0.1) !important;/
        }
        .color-backround h1{
            color: #FFF;
        }

        .color-tabs{
            /border: 1px solid #999 !important;/
            background:rgb(0, 0, 0) !important;
            color:#FFF;
        }
        .nav-tabs.bg-black{
            border-bottom: 1px solid #FFF !important;
        }
        .nav-tabs.bg-black li.active a{
            border-bottom: 1px solid #111 !important;
        }

        .color-backround.nav-tabs > li.active > a, .color-backround.nav-tabs > li.active > a:hover, .color-backround.nav-tabs > li.active > a:focus{
            border: 1px solid #000 !important;
            background:rgba(5, 12, 26, 0.92) !important;
        }

        .panel {
            border: 1px solid #dddddd;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        }
        /*Font size lebih kecil, font color abu gelap (#363636), tidak bold, rata kiri/
        .color-backround .nav-tabs .active{
            background:#000 !important;
        }

        .color-backround .wrapper-md .bg-light{
            color: #FFF;
        }*/
    </style>
@endpush

@section('content')
    <div id="content" class="app-content" role="main">
        <div class="app-content-body app-content-full">
            <div class="hbox hbox-auto-xs hbox-auto-sm">
                <!-- main -->
                <div class="col">
                    <!-- main header -->
                    <div id="mainHeader" class="bg-light lter b-b wrapper-md">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <h1 class="m-n font-thin h3 text-black"><b>@yield('title', 'TITLE')</b></h1>
                                @if (trim($__env->yieldContent('subtitle')))
                                <small class="text-muted">@yield('subtitle', 'Subtitle here')</small>
                                @endif
                            </div>
                            <div class="col-sm-6 text-right hidden-xs">
                                @section('side-header')
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
                                @show
                            </div>
                        </div>
                    </div>
                    <!-- / main header -->
                    <div class="wrapper-md @yield('wrapper-class')">
                        {{-- change color --}}
                        <div data-ng-include=" 'tpl/blocks/settings.html' " class="settings panel panel-default ng-scope">
                            <button class="btn btn-default no-shadow pos-abt ng-scope" ui-toggle-class="active" target=".settings">
                            <i class="fa fa-tint"></i>
                            </button>
                            <div class="panel-heading ng-scope">
                                Settings Background
                            </div>
                            <div class="wrapper b-t b-light bg-light lter r-b ng-scope">
                                <div class="row row-sm">
                                    <div class="col-xs-6">
                                        <span class="btn" style="background-color: #000000;">Black</span>
                                    </div>
                                    <div class="col-xs-6">
                                        <span class="btn" style="background-color: #fefdff;">White</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- change color --}}
                        @yield('body')
                    </div>
                </div>
                <!-- / main -->
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Large modal -->
    <div id="largeModal" class="modal fade form-modal-lg" tabindex="-1" role="dialog" aria-labelledby="largeModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="loading dimmer padder-v">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Standar modal -->
    <div id="mediumModal" class="modal fade form-modal-md" tabindex="-1" role="dialog" aria-labelledby="mediumModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="loading dimmer padder-v">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Small modal -->
    <div id="smallModal" class="modal fade form-modal-sm" tabindex="-1" role="dialog" aria-labelledby="smallModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="loading dimmer padder-v">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        // Default Font buat charts
        Chart.defaults.global.defaultFontFamily = "'Questrial', sans-serif";
        Chart.defaults.global.tooltips.titleFontSize = 17;
        Chart.defaults.global.tooltips.bodyFontSize = 17;

        $(document).ready(function() {
            //change color
            var setCookie = function (n, val) {
                var exdays = 30;
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toGMTString();
                document.cookie = n + "=" + val + "; " + expires;
            };
            var getCookie = function (n) {
                var name = n + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1);
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            };
            document.onclick = function (e) {
                if (e.target.className == 'btn') {
                    var favColor = e.target.style.backgroundColor;
                    setCookie('color', favColor);
                    document.body.style.backgroundColor = favColor;
                    // console.log(favColor);
                    onloadColor();
                    location.reload();
                }
            };
            
            onloadColor = function () {
                var favColor = document.body.style.backgroundColor;
                var color = getCookie('color');
                // console.log(color);
                Chart.defaults.global.defaultFontColor = (color =='rgb(254, 253, 255)'?"#000":"#FFF");
                // Chart.defaults.scaleLineColor = (color =='rgb(254, 253, 255)'?"#000":"#FFF");
                // Chart.defaults.scale.display = false;
                // Chart.defaults.scale.gridLines.color = (color =='rgb(254, 253, 255)'?"#000":"#FFF");
                // console.log(Chart.defaults);

                if(color !== "rgb(254, 253, 255)"){
                    ($('.tab-content').length > 0)? $('.tab-content').addClass('color-tab'):"";
                    ($('.panel.bg-light').length > 0)? $('.panel.bg-light').addClass('bg-panel'):"";
                    ($('.content').length > 0)? $('.content').addClass('color-backround'):"";
                    ($('.wrapper-md').length > 0)? $('.wrapper-md').addClass('bg-black'):"";
                    ($('.font-thin').length > 0)? $('.font-thin').addClass('text-white'):"";
                    ($('.font-thin').length > 0)? $('.font-thin').removeClass('text-black'):"";
                    ($('.nav-tabs').length > 0)? $('.nav-tabs').addClass('bg-black'):"";
                    ($('.navbar-collapse').length > 0)? $('.navbar-collapse').addClass('bg-black'):"";
                    ($('.navbar-collapse').length > 0)? $('.navbar-collapse').removeClass('bg-white-only'):"";
                    ($('.btn.dropdown-toggle').length > 0)? $('.btn.dropdown-toggle').removeClass('btn-default'):"";
                    // ($('.btn.dropdown-toggle').length > 0)? $('.btn.dropdown-toggle').addClass('btn-black'):"";
                    // document.body.style.backgroundColor = "#1c2b36";
                    document.body.style.backgroundColor = "#111";
                }else{
                    ($('.tab-content').length > 0)? $('.tab-content').removeClass('color-tab'):"";
                    ($('.panel.bg-light') > 0)? $('.panel.bg-light').removeClass('bg-panel'):"";
                    ($('.content') > 0)? $('.content').removeClass('color-backround'):"";
                    ($('.wrapper-md') > 0)? $('.wrapper-md').removeClass('bg-black'):"";
                    ($('.font-thin') > 0)? $('.font-thin').addClass('text-black'):"";
                    ($('.font-thin') > 0)? $('.font-thin').removeClass('text-white'):"";
                    ($('.nav-tabs') >  0)? $('.nav-tabs').removeClass('bg-black'):"";
                    ($('.navbar-collapse') > 0)? $('.navbar-collapse').addClass('bg-white-only'):"";
                    ($('.navbar-collapse') > 0)? $('.navbar-collapse').removeClass('bg-black'):"";
                    ($('.btn.dropdown-toggle') > 0)? $('.btn.dropdown-toggle').addClass('btn-default'):"";
                    // ($('.btn.dropdown-toggle') > 0)? $('.btn.dropdown-toggle').removeClass('btn-black'):"";
                    document.body.style.backgroundColor = "#FFF";
                }
                // if (color === '') {
                //     document.body.style.backgroundColor = favColor;
                // } else {
                //     document.body.style.backgroundColor = color;
                // }
            };

            onloadColor();
        });

        $('.date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    </script>
@endpush