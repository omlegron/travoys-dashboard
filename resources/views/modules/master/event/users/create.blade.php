<form action="{{ route($routes.'.storeUsers') }}" method="POST" id="formData">
    @csrf
    <input type="hidden" name="trans_id" value="{{ $trans_id }}">
    <div class="modal-header">
        <h3 class="modal-title">Tambah Users</h3>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Judul Event</label>
            <select name="user_id" id="user_id" class="form-control selectpicker">
                {!! App\Models\Users::options('name', 'id') !!}
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
