@extends('layouts.list')

@section('title', 'Setting - Role Management')

@section('side-header')
    <div class="btn-group">
        <a href="{{ route('setting.users.index') }}" type="button" class="btn btn-default">User Management</a>
        <a href="{{ route('setting.roles.index') }}" type="button" class="btn btn-primary">Role Management</a>
    </div>
@endsection

@section('filters')
    <div class="form-group">
        <label class="control-label m-r-sm" for="filters"><i class="fa fa-filter"></i> &nbsp; Filter</label>
        <label class="control-label sr-only" for="filter-name">Name</label>
        <input type="text" class="form-control filter-control" name="filter[name]" data-post="name" placeholder="Name Contain">
    </div>
@endsection