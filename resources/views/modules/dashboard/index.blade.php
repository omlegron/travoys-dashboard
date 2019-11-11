@extends('layouts.full')
@push('css')
     <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css') }}"/>
@endpush

@push('js')
      <script src="{{ asset('plugins/leaflet/leaflet.js') }}"/></script>
@endpush

@push('scripts')
    <script type="text/javascript">
        //Maps
        var mymap = L.map('mapid').setView([-8.650000, 115.216667], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
            maxZoom: 18,
        }).addTo(mymap);

        var marker = L.marker([-8.650000, 115.216667]).addTo(mymap);
        // $('#koordinat').val("-8.650000, 115.216667");

        mymap.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            marker.setLatLng(e.latlng);
            $('#koordinat').val(lat.toString()+', '+lng.toString());
        });
    </script>
@endpush

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
</style>


@section('title', 'Dashboard')


@section('body')
     <div class="col item">
        <div id="mapid" style="height: 100vh; width: 100%"></div>
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
@endsection
