@extends('admin.layout.template')
@section('contents')
  <div id="users_data">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Details</h3>
        @include('admin.user.back')
      </div>
      <div class="card-body">
        <div class="form-group row">
            <label for="first_name" class="col-sm-2 col-form-label">ID:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" value="{{ $data->name }}" readonly>
            </div>
        </div>
        <div class="form-group row">
          <label for="Email" class="col-sm-2 col-form-label">Shopify:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="email" value="{{ $data->email }}" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label for="Email" class="col-sm-2 col-form-label">Loop:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="email" value="{{ $data->phone }}" readonly>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
