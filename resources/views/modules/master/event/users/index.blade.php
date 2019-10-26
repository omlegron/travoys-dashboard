@extends('layouts.crud')

@section('title', 'Data Event Users')

@section('side-header')
    <div class="btn-group">
        <a href="#" type="button" class="btn btn-default">Master</a>
        <a href="#" type="button" class="btn btn-primary">Data Event Users</a>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            createDatatable('dataTable',{urls:'{!! route($routes.'.gridusers') !!}'})
        });
    </script>
@endpush

@section('body')
<div class="panel panel-default">
        <div class="panel-body">
            @section('headerButton')
            <div class="row">
                <div class="col-sm-9">
                    <form id="dataFilters" class="form-inline" role="form">
                        @yield('filters')
                    </form>
                </div>
                <div class="col-sm-3 text-right">
                    @section('buttons')
                    <button class="btn m-b-xs btn-success btn-addon add button"><i class="fa fa-plus"></i>Add New</button>
                    @show
                </div>
            </div>
            @show
        </div>
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
@endsection
