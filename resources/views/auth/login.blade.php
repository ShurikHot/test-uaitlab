<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - Авторизація</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/adminlte.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">

<body class="hold-transition register-page">

<div class="register-box">
    <div class="card">
        <div class="card-body register-card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled login-error">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif

            <p class="login-box-msg">Авторизація користувача</p>
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-6 offset-3">
                        <button type="submit" class="btn btn-primary btn-block">Авторизація</button>
                    </div>

                </div>
            </form>
            <div class="text-center">
                <a href="{{route('register.create')}}">Ще не зареєстровані?</a>
            </div>
        </div>

    </div>
</div>

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/js/adminlte.js')}}"></script>
</body>
</html>
