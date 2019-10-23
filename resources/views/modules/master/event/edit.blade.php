<form action="{{ route($routes.'.update', $record->id) }}" method="POST" id="formData">
    @method('PATCH')
    @csrf
    <input type="hidden" name="id" value="{{ $record->id }}">
    <div class="modal-header">
        <h3 class="modal-title">Edit Data Event</h3>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Judul Event</label>
            <input type="text" name="title" class="form-control" placeholder="Judul Event" required="" value="{!! $record->title !!}">
        </div>
        <div class="form-group">
            <label class="control-label">Deskripsi</label>
            <textarea class="form-control" placeholder="Deskripsi" name="description">{{ $record->description }}</textarea>
        </div>
        <div class="form-group">
            @include('component.attachments',['multiple' => '','title' => 'Upload Foto Anda Disini','record' => $record->attachment])
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