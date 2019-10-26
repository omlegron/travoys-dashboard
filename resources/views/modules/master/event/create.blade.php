@include('modules.master.event.script.attachments')
<form action="{{ route($routes.'.store') }}" method="POST" id="formData">
    @csrf

    <div class="modal-header">
        <h3 class="modal-title">Buat Data Event</h3>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Judul Event</label>
            <input type="text" name="title" class="form-control" placeholder="Judul Event" required="">
        </div>
        <div class="form-group">
            <label class="control-label">Deskripsi</label>
            <textarea class="form-control" placeholder="Deskripsi" name="description"></textarea>
        </div>
        <div class="form-group">
            @include('component.attachments',['multiple' => '','title' => 'Upload Foto Anda Disini','record' => []])
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
