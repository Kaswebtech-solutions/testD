@extends('admin.layout.template')
@section('contents')
    <div id="profileRender">
        <style>
            .profile-pic {
                border-radius: 50%;
                height: 150px;
                width: 150px;
                background-size: cover;
                background-position: center;
                background-blend-mode: multiply;
                vertical-align: middle;
                text-align: center;
                color: transparent;
                transition: all .3s ease;
                text-decoration: none;
                cursor: pointer;
            }

            .profile-pic:hover {
                background-color: rgba(0, 0, 0, .5);
                z-index: 10000;
                color: #fff;
                transition: all .3s ease;
                text-decoration: none;
            }

            .profile-pic span {
                display: inline-block;
                padding-top: 4.5em;
                padding-bottom: 4.5em;
            }

            form input[type="file"] {
                display: none;
                cursor: pointer;
            }
        </style>
        <div id="alert_for_update">
        </div>
        <div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="changePasswordForm">
                            @csrf
                            <div class="form-group row">
                                <label for="old_password" class="col-sm-2 col-form-label">Old Password:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name='old_password'>
                                    <input type="hidden" name="user_id" value="{{ $admin->id }}">
                                    <div class="error" id="error_old_password"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-sm-2 col-form-label">New Password:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name='new_password'>
                                    <div class="error" id="error_new_password"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name='confirm_password'>
                                    <div class="error" id="error_confirm_password"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 text-center">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <form action="" id="changeProfilePic" class="text-center" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="fileToUpload">
                                        @if (!empty($admin->profile_image))
                                            <div class="profile-pic "
                                                style="background-image: url('{{ asset('/') . ('images/' . ($admin->profile_image ?? 'avtar.jpeg')) }}')">
                                                <span><i class="fas fa-camera"></i>
                                                </span>
                                                <span>Change Image</span>
                                            </div>
                                        @else
                                            <div class="profile-pic "
                                                style="background-image: url('{{ asset('images/avtar.jpeg') }}')">
                                                <span><i class="fas fa-camera"></i>
                                                </span>
                                                <span>Change Image</span>
                                            </div>
                                        @endif
                                    </label>
                                    <input type="file" accept="images/*" name="new_profile_image" id="fileToUpload">
                                </form>
                                <h3 class="profile-username text-center">{{ $admin->name}}</h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Phone:</b> <a class="float-right">{{ $admin->phone }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Email:</b> <a class="float-right">{{ $admin->email }}</a>
                                    </li>
                                </ul>
                                <button type="button" class="btn btn-primary change-password" data-toggle="modal"
                                    data-target="#changePassword">
                                    Change Password
                                </button>
                                <button type="button" class="btn btn-primary update-data" data-toggle="modal" data-target="#udateprofile">
                                    Edit
                                   </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="udateprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header px-4">
                              <h5 class="modal-title" id="changePasswordLabel">Update Profile</h5>
                              <a type="button" class="close change-profile" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                    </a>
                            </div>
                            <div class="modal-body px-4 py-4">
                              <form action="" id="profile_admin" autocomplete="off">
                                @csrf
                              <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                      <input type="name" class="form-control" value="{{$admin->name}}" name='name' placeholder="Enter name">
                                      <input type="hidden" name="user_id" value="{{$admin->id}}">
                                      <div class="error" id="error_name"></div>
                                    </div>
                                    </div>
                                  <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Email :</label>
                                    <div class="col-sm-10">
                                      <input type="email" class="form-control" name='email' value="{{$admin->email}}" placeholder="Enter email">
                                      <div class="error" id="error_email"></div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Phone :</label>
                                    <div class="col-sm-10">
                                      <input type="phone" class="form-control" value="{{$admin->phone}}" name='phone' placeholder="Enter phone">
                                      <div class="error" id="error_phone"></div>
                                    </div>
                                  </div>
                                    <div class="form-group row mt-4">
                                    <div class="col-sm-12 text-center">
                                      <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                  </div>
                              </form>
                            </div> 
                </div>
            </div>
        </section>
    </div>
    <script>
     function getFormWithImage(id) {
            let form = document.querySelector(`#${id}`);
            let data = new FormData(form);
            return data;
        }
    $("#fileToUpload").change(function(e) {
        e.preventDefault();
        data = getFormWithImage("changeProfilePic");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        $.ajax({
            type: 'post',
            url: "{{route('users-change-image')}}",
            dataType: "JSON",
            cache: false,
            processData: false,
            contentType: false,
            data: data,
            success: function(data) {
                location.reload();
            },
            error: function(data) {}
        });
    });


    $(document).on('submit', '#changePasswordForm', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('users-change-password') }}",
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
                }
            });
        });
        $(document).on('submit', '#profile_admin', function(e) {
            e.preventDefault();
            $('#page-loader').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.info.update') }}",
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
                    $.each(data.responseJSON.errors, function(id, msg) {
                        $('#error_update_' + id).html(msg);
                    });
                    $('#page-loader').hide();
                }
            });
        });
        $(document).on("click",".change-password",function(){
            $(".error").html("");
            $("#changePasswordForm").trigger("reset");
        });
    </script>
    </div>
@endsection
