<div class="card">
  <div class="card-header">
    <h3 class="card-title">Users List</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      @if(count($data)>0)
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      @endif
      <tbody>
        @forelse($data as $key=>$value)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$value->id}}</td>
          <td>{{$value->name}}</td>
          <td>{{$value->email}}</td>
          <td>{{$value->phone}}</td>
          <td>@if($value->status==1)
            <button data-id="{{$value->id}}" class="disable_enable btn btn-success btn-xs" onclick="toggleDisableEnable(this)">Active</button>
            @else
            <button data-id="{{$value->id}}" class="disable_enable btn btn-danger btn-xs" onclick="toggleDisableEnable(this)">Inactive</button>
            @endif
          </td>
        <td>
            <a href="{{route('user.viewData',$value->id)}}" target="_blank" class="btn btn-outline-success btn-xs view">View</a>
            <button data-id="{{$value->id}}" type="button" style="cursor:pointer" class="btn btn-outline-success btn-xs update" data-toggle="modal" id="updateUserRegister" data-target="#myModal1">Update</button>
            <div class="modal fade" id="myModal1" role="dialog">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Edit Detail</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body updatemodaluser">     
                  </div>
                </div>
              </div>
            </div>
            <button data-id="{{$value->id}}" data-toggle="modal"  data-target="#myModal2" class="btn btn-outline-success btn-xs view">Reset Password</button>
            <button data-id="{{$value->id}}" class="btn btn-danger btn-xs remove">Remove</button>
            <div class="modal fade" id="myModal2" role="dialog">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">Reset Password</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                          @include('admin.user.includes.reset-password')
                      </div>
                  </div>
              </div>
            </div>
          </td>
        </tr>
        @empty
        <center>
          <h3> No User Available </h3>
        </center>
        @endforelse
      </tbody>
    </table>
  </div>
  {{$data->links()}}
</div>
