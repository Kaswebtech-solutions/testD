<div class="card" id="data">
    <div class="card-body">
        <div class="tab-content">
            <div class="active tab-pane" id="view">
                @include('admin.rolePermission.includes.view')
            </div>
        </div>
    </div>
</div>
  
<script>
  
        //fetch Update user deatil
        $(document).on('click', '#updatePRole', function(event) {
            $('#page-loader').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('roles.p.edit') }}",
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
        $(document).on('submit', '#updateRolePData', function(e) {
            e.preventDefault();
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('roles.p.update') }}",
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

