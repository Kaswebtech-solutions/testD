<form class="form-horizontal" action="{{ url('/') }}/admin/user/updateuserdata" id="update_user" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $updateData->id }}">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_name" name="name" value="{{ $updateData->name }}">
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_email" name="email"
                value="{{ $updateData->email }}">
            <div class="error" id="error_update_email"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_phone" name="phone"
                value="{{ $updateData->phone }}">
            <div class="error" id="error_update_phone"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>
