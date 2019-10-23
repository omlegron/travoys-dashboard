@extends('layouts.base')

@include('libs.actions')

@section('title', 'SETTING - ROLE MANAGEMENT')

@section('side-header')
    <div class="btn-group">
        <a href="{{ route('setting.users.index') }}" type="button" class="btn btn-default">User Management</a>
        <a href="{{ route('setting.roles.index') }}" type="button" class="btn btn-primary">Role Management</a>
    </div>
@endsection

@section('body')
	<form id="formData" action="{{ route($routes.'.update', $record->id) }}" method="POST">
		@method('PATCH')
		@csrf
		
		<input type="hidden" name="name" value="{{ $record->name }}">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="font-thin h4">
					<span>Role : {{ $record->name }}</span>
					<span class="pull-right">{{ $record->users->count() }} Users</span>
				</h4>
			</div>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th class="text-center">Features</th>
						<th class="text-center">Read</th>
						<th class="text-center">Create</th>
						<th class="text-center">Update</th>
						<th class="text-center">Delete</th>
						<th class="text-center"></th>
					</tr>
				</thead>
				@foreach($perms as $title => $group)
					<thead>
						<tr>
							<th>{{ $title }}</th>
							<th class="text-center">
								<button type="button" class="btn btn-default btn-addon btn-sm check all" data-check="read">
									<i class="fa fa-check"></i>Read All
								</button>
							</th>
							<th class="text-center">
								<button type="button" class="btn btn-default btn-addon btn-sm check all" data-check="create">
									<i class="fa fa-check"></i>Create All
								</button>
							</th>
							<th class="text-center">
								<button type="button" class="btn btn-default btn-addon btn-sm check all" data-check="update">
									<i class="fa fa-check"></i>Update All
								</button>
							</th>
							<th class="text-center">
								<button type="button" class="btn btn-default btn-addon btn-sm check all" data-check="delete">
									<i class="fa fa-check"></i>Delete All
								</button>
							</th>
							<th class="text-center">
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($group as $key => $perm)
							<tr>
								<td>{{ ucwords(str_replace(['-', '_'], ' ', $key)) }}</td>
								<td class="text-center">
									@if(in_array('read', $perm))
									<label class="i-checks m-b-none">
										<input type="checkbox" class="read check" name="perms[read {{$key}}]" value="1" @if($record->hasPermissionTo('read '.$key)) checked @endif><i></i>
									</label>
									@endif
								</td>
								<td class="text-center">
									@if(in_array('create', $perm))
									<label class="i-checks m-b-none">
										<input type="checkbox" class="create check" name="perms[create {{$key}}]" value="1" @if($record->hasPermissionTo('create '.$key)) checked @endif><i></i>
									</label>
									@endif
								</td>
								<td class="text-center">
									@if(in_array('update', $perm))
									<label class="i-checks m-b-none">
										<input type="checkbox" class="update check" name="perms[update {{$key}}]" value="1" @if($record->hasPermissionTo('update '.$key)) checked @endif><i></i>
									</label>
									@endif
								</td>
								<td class="text-center">
									@if(in_array('delete', $perm))
									<label class="i-checks m-b-none">
										<input type="checkbox" class="delete check" name="perms[delete {{$key}}]" value="1" @if($record->hasPermissionTo('delete '.$key)) checked @endif><i></i>
									</label>
									@endif
								</td>
								<td class="text-center">
									<button type="button" class="btn btn-default btn-addon btn-sm select all"><i class="fa fa-check"></i>Select All</button>
								</td>
							</tr>
						@endforeach
					</tbody>
				@endforeach
			</table>
			<div class="panel-footer">
				<a href="{{ url()->previous() }}" class="btn btn-sm btn-default btn-addon">
					<i class="fa fa-angle-left"></i> Back
				</a>
				<button type="button" class="btn btn-sm btn-success btn-addon pull-right save button">
					<i class="fa fa-save"></i> Save
				</button>
			</div>
		</div>
	    <div class="loading dimmer padder-v" style="display: none">
	        <div class="loader"></div>
	    </div>
	</form>
@endsection

@push('scripts')
<script>
	$(document).on('click', '.select.all', function(e){
		var container = $(this).closest('tr');
		var checks = container.find('.check');

		checks.prop('checked', !checks.prop('checked'));
	});

	$(document).on('click', '.check.all', function(e){
		var container = $(this).closest('thead').next('tbody');
		var target = $(this).data('check');
		var checks = container.find('.' + target + '.check');

		checks.prop('checked', !checks.prop('checked'));
	});

    $(document).on('click', '.save.button', function(e){
        saveData('formData', function(resp){
            location.href = "{{ route($routes.'.index') }}";
        });
    });
</script>
@endpush