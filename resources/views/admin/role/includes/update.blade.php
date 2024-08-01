<form class="form-horizontal" action="" id="updateRoleData" method="post" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{$roles->id}}">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Role:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{$roles->name}}">
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>
