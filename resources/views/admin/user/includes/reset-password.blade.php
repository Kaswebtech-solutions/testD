<form action="{{ route('forget.password.post') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value={{$value->id}}>
    <div class="form-group row">
        <label for="first_name" class="col-sm-2 col-form-label">Email:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Name" value="{{$value->email}}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-success">Send Password Reset Link</button>
        </div>
    </div>
</form>