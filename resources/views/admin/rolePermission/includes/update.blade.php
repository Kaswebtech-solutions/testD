<form class="form-horizontal" action="" id="updateRolePData" method="post" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{$roles->id}}">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Role:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{$roles->name}}" readonly>
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="select2Multiple" class="col-sm-2 col-form-label">Permission</label>
        <div class="col-sm-10">
            <select class="select-multiple" name="permission[]" multiple placeholder="Select Permission" data-allow-clear="1">
                @foreach($allPermissions as $value)
                <option value="{{$value->id}}" {{in_array($value->id,$permissions)?'selected':''}}>{{$value->name}}</option>
                @endforeach
            </select>
      </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>
<script>
  $(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
});
</script>