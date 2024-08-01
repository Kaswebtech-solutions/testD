<form class="form-horizontal" action="" id="update_data" method="post" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Customer Email Address:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_name" name="name" value="">
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Customer Billing Address:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_name" name="name" value="">
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Customer Shipping Address:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_name" name="name" value="">
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Next Billing date:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_name" name="name" value="">
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Subscription Status:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="update_name" name="name" value="">
            <div class="error" id="error_update_name"></div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </div>
</form>
