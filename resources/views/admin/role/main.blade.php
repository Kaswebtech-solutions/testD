<div class="card" id="data">
<div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a type="button" class="nav-link active" data-toggle="modal" data-target="#RmyModal" id="addUsers">Add Role</a>
            </li>
            <div class="modal fade" id="RmyModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Role</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @include('admin.role.addform')
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="view">
                @include('admin.role.includes.view')
            </div>
        </div>
    </div>
</div>
<script>
//create roles
$(document).on('submit', '#addRoles', function(e) {
            e.preventDefault();
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('roles.add') }}",
                type: 'post',
                dataType: "JSON",
                xhr: function() {
                    myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    $.each(data.responseJSON.errors, function(id, msg) {
                        $('#error_' + id).html(msg);
                    });
                    $('#page-loader').hide();
                }
            });
        });
        //fetch Update user deatil
        $(document).on('click', '#updateRole', function(event) {
            $('#page-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('roles.edit') }}",
                type: 'get',
                dataType: "html",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".modal-backdrop").removeClass('modal-backdrop show');
                    $('.updatemodalrole').html(data);
                    $('#page-loader').hide();

                },
                error: function(error) {
                    console.log(error.responseText);
                    $('#page-loader').hide();
                }
            });
        });
        //Update user deatil
        $(document).on('submit', '#updateRoleData', function(e) {
            e.preventDefault();
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('roles.update') }}",
                type: 'post',
                dataType: "JSON",
                xhr: function() {
                    myXhr = $.ajaxSettings.xhr();
                    return myXhr;
                },
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    location.reload();
                    $('#page-loader').hide();
                },
                error: function(data) {
                    console.log(data.responseJSON.errors);
                    $.each(data.responseJSON.errors, function(id, msg) {
                        $('#error_update_' + id).html(msg);
                    });
                    $('#page-loader').hide();
                }
            });
        });
        //Remove Role
   $(document).on('click', '.removeRole', function() {
            var id = $(this).attr('data-id');
            swal({
                title: "Oops....",
                text: "Are you sure you want to delete role!",
                icon: "error",
                buttons: [
                    'NO',
                    'YES'
                ],
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $('#page-loader').show();
                    $.ajax({
                        url: "{{ route('role.remove') }}",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            swal({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Remove Successfully',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.reload();
                            $('#page-loader').hide();
                        },
                        error: function(error) {
                            $('#page-loader').hide();
                        }
                    });
                }
            });
        });
</script>

