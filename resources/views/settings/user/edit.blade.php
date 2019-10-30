<form action="{{ route($routes.'.update', $record->id) }}" method="POST" id="formData">
    @method('PATCH')
    @csrf
    <input type="hidden" name="id" value="{{ $record->id }}">

    <div class="modal-header">
        <h3 class="modal-title">Edit User</h3>
    </div>
    <div class="modal-body">
        {{-- <p class="text-muted">Please fill the information to continue</p> --}}
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter user fullname" value="{{ $record->name }}" required>
        </div>
        <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter user valid email" value="{{ $record->email }}" required>
        </div>
        <div class="pull-in clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Password <em class="text-muted">(Fill to change password)</em></label>
                    <input type="password" name="password" class="form-control" placeholder="Use letter and number combination" required>   
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Confirm password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm the password" required>
                </div>
            </div>
        </div>
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