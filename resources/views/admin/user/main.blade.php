<div class="card" id="data">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a type="button" class="nav-link active" data-toggle="modal" data-target="#myModal">Add User</a>
            </li>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Register</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            @include('admin.user.addform')
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
                @include('admin.user.includes.view')
            </div>
        </div>
    </div>
    <h1 id="demo"></h1>
    <script>
        $(document).on('submit', '#createUser', function(e) {
            e.preventDefault();
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ route('user.add') }}',
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
                    console.log(data.responseJSON.errors);
                    $.each(data.responseJSON.errors, function(id, msg) {
                        $('#error_' + id).html(msg);
                    });
                    $('#page-loader').hide();
                }
            });
        });

        function toggleDisableEnable(e) {
            var id = $(e).attr('data-id');
            $('#page-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('user.update.status') }}",
                data: {
                    id: id
                },
                type: 'post',
                success: function(data) {
                    location.reload();
                    $('#page-loader').hide();
                },
                error: function(error) {
                    $('#page-loader').hide();
                }
            });
        }

        $(document).on('click', '.remove', function() {
            var id = $(this).attr('data-id');
            swal({
                title: "Oops....",
                text: "Are you sure you want to delete user!",
                icon: "error",
                buttons: [
                    'NO',
                    'YES'
                ],
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $('#page-loader').show();
                    $.ajax({
                        url: "{{ route('user.remove') }}",
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
            var make_url = "{{ route('user.search') }}?page=" + page;
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
        $(document).on('click', '.update', function(event) {
            $('#page-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).attr('data-id');
            $.ajax({
                url: '{{ route('user.updateuser') }}',
                type: 'get',
                dataType: "html",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".modal-backdrop").removeClass('modal-backdrop show');
                    $('.updatemodaluser').html(data);
                    $('#page-loader').hide();

                },
                error: function(error) {
                    console.log(error.responseText);
                    $('#page-loader').hide();
                }
            });
        });

        $(document).on('submit', '#update_user', function(e) {
            e.preventDefault();
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ route('user.updateuserdata') }}',
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
    </script>
