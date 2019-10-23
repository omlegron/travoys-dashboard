<div class="list-group">
  <a class="list-group-item b-l-warning b-l-3x hover-anchor hover" style="">
    <span class="block text-ellipsis ng-binding">{{ $title }}</span>
    <div class="bootstrap-filestyle input-group ui file input">
      <input type="text" class="form-control" readonly >
      <input type="file" class="six wide column" name="attachment[]" autocomplete="off"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display: none" {!! $multiple !!}>
      <span class="group-span-filestyle input-group-btn">
        <label for="filestyle-0" class="btn btn-default">
          <span class="glyphicon glyphicon-folder-open"></span> Choose file
        </label>
      </span>
    </div>
    @if($record->count() > 0)
        <img src="{{ url('storage/'.$record->first()->url) }}" class="b b-a wrapper-xs bg-white img-responsive">
    @endif
  </a>
</div>