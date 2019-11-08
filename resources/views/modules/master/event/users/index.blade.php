@extends('layouts.crud')

@section('title', 'Data Event Users')

@section('side-header')
    <div class="btn-group">
        <a href="#" type="button" class="btn btn-default">Master</a>
        <a href="#" type="button" class="btn btn-primary">Data Event Users</a>
    </div>
@endsection

@push('js')
    @include('modules.master.event.script.index')
    <script>
        $(document).ready(function(){
            createDatatable('dataTable',{urls:'{!! route($routes.'.gridusers') !!}'}, {trans_id:'{{ $trans_id }}'})
        });
    </script>
@endpush

@section('body')
<div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-9">
                    <!-- <form id="dataFilters" class="form-inline" role="form">
                       asd 
                    </form> -->
                </div>
                <div class="col-sm-3 text-right">
                    <!-- <a href="{{ url('master/event/scan/'.$trans_id) }}" class="btn m-b-xs btn-primary btn-addon add button"><i class="fa fa-camera"></i>Scan</a> -->
                    <a href="{{ url('master/event') }}" title="" class="btn m-b-xs btn-addon btn-danger"><i class="fa fa-mail-reply"></i> Kembali</a> 
                    <button class="btn m-b-xs btn-success btn-addon others-modal button" data-url="{{ url('master/event/add-event-users/'.$trans_id) }}">
                        <i class="fa fa-plus"></i>
                        Add New
                    </button>
                </div>
            </div>
        </div>
        <input type="hidden" name="trans_id" value="{{ $trans_id }}">
        <div class="row">
            <div class="col-md-6 mb-3 pr-0">
                 <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <video id="preview" style="width: 100%"></video>
                        </div>
                    </div>       
                </div>
            </div>
            <div class="col-md-6 mb-3 pr-0">
                 <div class="table-responsive">
            @if(isset($tableStruct))
            <table id="dataTable" class="table table-bordered m-t-none" style="width: 100%">
                <thead>
                    <tr>
                        @foreach ($tableStruct as $struct)
                            <th class="text-center">{{ $struct['label'] }}</th>
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
        </div>
       
    </div>
@endsection
