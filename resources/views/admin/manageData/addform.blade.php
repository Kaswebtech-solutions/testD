<form class="form-horizontal" action="" id="addPermission" method="post" autocomplete="off">
    @csrf
    <div class="form-group row">
        <label for="first_name" class="col-sm-2 col-form-label">Name:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name ">
            <div class="error" id="error_name">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </div>
    </div>
</form>
