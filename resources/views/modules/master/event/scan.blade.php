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
			         <a href="{{ url('master/event') }}" title="" class="btn btn-danger">Kembali</a> 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type">Pilih Event</label>
                        <select name="event_id" id="event_id" class="form-control selectpicker">
                            {!! App\Models\Master\Event::options('title', 'id') !!}
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
        	<div class="row">
    			<div class="col-md-12">
                    <p>
                    <b>
                    *Setelah Selesai di scan beri modal success seperti success tambah event <br>
                    *data scan harus sesuai event<br>
                    *penempatan jquery di beda halaman dalam folder menu yang terkait<br>
                    </b>
                    </p>
                    <video id="preview" style="width: 100%"></video>
    			</div>
			</div>       
        </div>
    </div>
@endsection
