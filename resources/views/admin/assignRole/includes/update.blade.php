<form class="form-horizontal" action="" id="updateRoleData" method="post" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{$userId}}">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Role:</label>
        <div class="col-sm-10">
        <select class="form-control" name="role_id" placeholder="Select Permission" data-allow-clear="1">
                @foreach($allRoles as $value)
                <option value="{{$value->id}}" {{ $value->id == $roles->id ? 'selected' : '' }}>{{$value->name}}</option>
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
