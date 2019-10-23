<form action="{{ route($routes.'.update', $record->id) }}" method="POST" id="formData">
    @method('PATCH')
    @csrf
    <input type="hidden" name="id" value="{{ $record->id }}">

    <div class="modal-header">
        <h3 class="modal-title">Edit Role</h3>
    </div>
    <div class="modal-body">
        {{-- <p class="text-muted">Please fill the information to continue</p> --}}
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter role name" value="{{ $record->name }}" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary save button">Save</button>
    </div>

    <div class="loading dimmer padder-v">
        <div class="loader"></div>
    </div>
</form>