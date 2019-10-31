@extends('layouts.list')

@section('title', 'Data Event')

@section('side-header')
    <div class="btn-group">
        <a href="#" type="button" class="btn btn-default">Master</a>
        <a href="#" type="button" class="btn btn-primary">Data Event</a>
    </div>
@endsection

@section('headerButton')
<div class="row">
    <div class="col-md-6">
        <form id="dataFilters" class="form-inline" role="form">
            <div class="form-group">
		        <label class="control-label m-r-sm" for="filters"><i class="fa fa-filter"></i> &nbsp; Filter</label>
		        <label class="control-label sr-only" for="filter-name">Name</label>
		        <input type="text" class="form-control filter-control" name="filter[name]" data-post="name" placeholder="Title ">
		    </div>
        </form>
    </div>
    <div class="col-md-6 text-right">
		<button class="btn m-b-xs btn-success btn-addon add button"><i class="fa fa-plus"></i>Add New</button>
    </div>
</div>
@endsection
