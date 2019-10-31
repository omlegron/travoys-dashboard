@extends('layouts.list')

@section('title', 'Data Area')

@section('side-header')
    <div class="btn-group">
        <a href="#" type="button" class="btn btn-default">Master</a>
        <a href="#" type="button" class="btn btn-default">Data Event</a>
        <a href="#" type="button" class="btn btn-primary">Scan QR CODE</a>
    </div>
@endsection

@push('js')
	@include('modules.master.event.script.index')
@endpush

@section('body')
	<div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
			         <a href="{{ url('master/event/users/'.$trans_id) }}" title="" class="btn btn-danger">Kembali</a> 
                    </div>
                </div>
                <div class="col-md-6">
                    <input type="hidden" name="trans_id" value="{{ $trans_id }}">
                </div>
            </div>
        </div>
        <div class="table-responsive">
        	<div class="row">
    			<div class="col-md-12">
                    <video id="preview" style="width: 100%"></video>
    			</div>
			</div>       
        </div>
    </div>
@endsection
