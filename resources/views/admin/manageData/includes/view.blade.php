<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data List</h3>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      @if(count($manage_data)>0)
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Shopify Customer ID</th>
          <th>Loop subscriber ID</th>
          <th>Customer Email Address</th>
          <th>Subscription Status</th>
          <th>Action</th>
        </tr>
      </thead>
      @endif
      <tbody>
        @forelse($manage_data as $key=>$value)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$value->shopify_id ?? 'N/A' }}</td>
          <td>{{$value->loop_subscriber_id ?? 'N/A' }}</td>
          <td>--</td>
          <td>{{$value->subscription_status ?? 'N/A' }}</td>
          <td>
          <a href="{{route('data.viewData',$value->id)}}" target="_blank" class="btn btn-outline-success btn-xs view">View</a>
            <button data-id="{{$value->id}}" type="button" style="cursor:pointer" class="btn btn-outline-success btn-xs" data-toggle="modal" id="updateData" data-target="#myModal1">Update</button>
            <!-- <button data-id="{{$value->id}}" class="btn btn-danger btn-xs removePermission">Remove</button> -->
          </td>
        </tr>
        @empty
        <center>
          <h3> No permission Available </h3>
        </center>
        @endforelse
      </tbody>
    </table>
  </div>
  {{$manage_data->links()}}
</div>
<div class="modal fade" id="myModal1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body updatemodalrole">
      </div>
    </div>
  </div>
</div>