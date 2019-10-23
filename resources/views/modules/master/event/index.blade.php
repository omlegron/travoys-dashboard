@extends('layouts.list')

@section('title', 'Data Area')

@section('side-header')
    <div class="btn-group">
        <a href="#" type="button" class="btn btn-default">Master</a>
        <a href="#" type="button" class="btn btn-primary">Data Area</a>
    </div>
@endsection

@section('filters')
    <div class="form-group">
        <label class="control-label m-r-sm" for="filters"><i class="fa fa-filter"></i> &nbsp; Filter</label>
        <label class="control-label sr-only" for="filter-name">Name</label>
        <input type="text" class="form-control filter-control" name="filter[name]" data-post="name" placeholder="Area ">
    </div>
    
@endsection

