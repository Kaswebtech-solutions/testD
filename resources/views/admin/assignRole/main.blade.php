<div class="card" id="data">
<div class="card-header p-2">
        <ul class="nav nav-pills">
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
                @include('admin.assignRole.includes.view')
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
        $(document).on('click', '#updateAssignRole', function(event) {
            $('#page-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).attr('data-id');
            var role_id = $(this).attr('role-id');
            $.ajax({
                url: "{{ route('assign.roles.update.view') }}",
                type: 'get',
                dataType: "html",
                data: {
                    id: id,
                    role_id: role_id
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
                url: "{{ route('assign.roles.update') }}",
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
        var make_url = "{{route('assign.permission.search')}}?page=" + page;
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
</script>

