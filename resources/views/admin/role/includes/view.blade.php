<div class="card">
  <div class="card-header">
    <h3 class="card-title">Role List</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      @if(count($roles)>0)
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>ID</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      @endif
      <tbody>
        @forelse($roles as $key=>$value)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$value->id}}</td>
          <td>{{$value->name}}</td>
          <td>
          <button type="button" data-id="{{$value->id}}" style="cursor:pointer" class="btn btn-outline-success btn-xs" data-toggle="modal" id="updateRole" data-target="#myModal111">Update</button>
          <!-- <button data-id="{{$value->id}}" class="btn btn-danger btn-xs removeRole">Remove</button> -->

        </td>        </tr>
        @empty
        <center>
          <h3> No Role Available </h3>
        </center>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div class="modal fade" id="myModal111" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Detail</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body updatemodalrole">
    </div>
  </div>
  </div>
</div>