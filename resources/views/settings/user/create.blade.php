<form action="{{ route($routes.'.store') }}" method="POST" id="formData">
    @csrf

    <div class="modal-header">
        <h3 class="modal-title">Add New User</h3>
    </div>
    <div class="modal-body">
        {{-- <p class="text-muted">Please fill the information to continue</p> --}}
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter user fullname" required="">
        </div>
        <div class="form-group">
            <label class="control-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter user valid email" required="">
        </div>
        <div class="pull-in clearfix">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Password <em class="text-muted">(Min. 6 length)</em></label>
                    <input type="password" name="password" class="form-control" placeholder="Use letter and number combination" required="">   
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Confirm password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm the password" required="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label">Role</label>
            <select class="form-control" name="role" required="">
                <option value="">Select Role</option>
                @foreach(App\Models\Auth\Role::all() as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>                  
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