@extends('layouts.full')

@include('libs.datatable')
@include('libs.actions')

@push('styles')
<style type="text/css">
    .temeline-from ul {
        list-style: none; /* Remove HTML bullets */
        padding: 0;
        font-size: 12px;
        margin: 0;
    }

    .temeline-from li { 
        padding-left: 16px; 
    }

    .temeline-from li::before {
        content: "\f111"; /* FontAwesome Unicode */
        font-family: FontAwesome;
        padding-right: 8px;
        /*color: red; /* Or a color you prefer */
    }
    .item .top-right {
        position: absolute!important;
        top: 0 !important;
        margin-top: 1.5rem !important;
        width: 35rem !important;
        right: 0 !important;
    }
    button.btn.btn-default.no-shadow.pos-abt {
    display: none;
    }
</style>


@section('title', 'Dashboard')

@section('body')
	 <div class="col item">
        <div id="mapid" style="margin-top: 100px; width: 100%"></div>
        <div class="top-right" style="z-index: 600;">
            <div class="col-md-12">
              <div class="panel no-border">
                <div class="panel-heading wrapper b-b b-light">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="font-thin m-t-none m-b-none text-muted " style="margin-top:7px!important;">Dashboard</h4> 
                        </div>
                        <div class="col-md-8">
                            <table>
                                <tr>
                                    <td>
                                        <div class="input-group input-group input-group-sm" style="width: 100%!important">
                                            <input type="text" class="form-control numeric datepicker" style="text-align: center;" name="filters[tanggal]" style="" placeholder="  Tanggal" value="{{ date('Y-m-d') }}">
                                            <span class="input-group-addon btn-sm" style="cursor: pointer; text-align: center;"><i class="fa fa-search" style="margin-left: 5px;"></i></span>
                                        </div>
                                    </td>
                                </tr>
                            </table>     
                        </div>
                    </div>

                </div>
                
            </div>

           
        </div>
    </div>


    <div class="panel panel-default">
        <center><h3>Tarif Trans Jawa</h3></center>
        <hr>
        <div class="table-responsive">
            @if(isset($tableStruct))
            <table id="dataTable" class="table table-bordered m-t-none" style="width: 100%">
                <thead>
                    <tr>
                        @foreach ($tableStruct as $struct)
                            <th class="text-center" style="white-space:nowrap;">{{ $struct['label'] }}</th>
                        @endforeach
                  </tr>
                </thead>
                <tbody>
                    @yield('tableBody')
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection


