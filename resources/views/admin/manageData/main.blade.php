<div class="card" id="data">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a type="button" class="nav-link active" id="syncData">Sync</a>
            </li>
            <div class="modal fade" id="NmyModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Permission</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @include('admin.manageData.addform')
                        </div>
                    </div>
                </div>
            </div>
            <li class="nav-item search-right">
                <div>
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" id="search" type="search"
                            placeholder="Search" aria-label="Search">
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="view">
                @include('admin.manageData.includes.view')
            </div>
        </div>
    </div>
</div>
<script>
    //create Users
    $(document).on('submit', '#syncData', function(e) {
            e.preventDefault();
            
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('data.sync') }}",
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
        $(document).on('click', '#updateData', function(event) {
            $('#page-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('data.edit') }}",
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
        $(document).on('submit', '#update_data', function(e) {
            e.preventDefault();
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('data.update') }}",
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
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    function fetch_data(page) {
        $('#page-loader').show();
        var search = document.querySelector("#search").value;
        var data = {
            search
        };
        var make_url = "{{route('data.search')}}?page=" + page;
        $.ajax({
            url: make_url,
            data: data,
            success: function(data) {
                $('#view').empty().html(data);
                $('#page-loader').hide();
            },
            error: function(error) {
                $('#page-loader').hide();
            }
        });
    }
    document.querySelector("#search").addEventListener("keyup", (e) => {
        fetch_data(1);
    });
   //Remove Permission
   $(document).on('click', '.removePermission', function() {
            var id = $(this).attr('data-id');
            swal({
                title: "Oops....",
                text: "Are you sure you want to delete permission!",
                icon: "error",
                buttons: [
                    'NO',
                    'YES'
                ],
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $('#page-loader').show();
                    $.ajax({
                        url: "{{ route('permission.remove') }}",
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

