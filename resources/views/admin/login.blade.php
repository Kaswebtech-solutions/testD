<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Base Admin Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <section class="form__section base__bg">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="base__form__wrapper">
                        <div class="base__heading text-center mb-3">
                            <div class="base__logo__img">
                                <img src="{{asset('images/icon.svg')}}" alt="Logo" />
                            </div>                           
                        </div>
                        <div class="base__form">
                            <h4 class="primary-color mb-3 text-center text-white">Admin</h4>
                            <form action="login" method="post" autocomplete ="off">
                                @csrf
                                @if (Session::get('success'))
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert">×</button> 
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                                </div>
                                
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <div class="check__box">
                                            <input name="remember" type="checkbox" id="remember">
                                            <label for="remember">
                                                Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        {{-- <a href="{{route('forgot')}}" class="link__clr link__forgot">Forgot Password?</a> --}}
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<script>
$(document).ready(function(){
    $("div.alert").delay(5000).slideUp(300);
});
</script>