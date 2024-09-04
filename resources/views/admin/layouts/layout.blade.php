<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name')}}@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/adminlte.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <div class="d-flex justify-content-between">
                    <a href="{{url('/')}}" class="nav-link">Home</a>
                    <a href="{{url('/import-excel')}}" class="nav-link ml-5 bg-cyan rounded">Імпортувати данні з таблиць</a>
                    <a href="{{url('/import-sql')}}" class="nav-link ml-5 bg-fuchsia rounded">Імпортувати довідники</a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/')}}" target="_blank" class="brand-link">
            <img src="{{asset('assets/admin/img/AdminLTELogo.png')}}" alt="{{ config('app.name')}}" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{ config('app.name')}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar auth (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('assets/admin/img/user_b.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    @if(Auth::check())
                        <p class="text-white">{{Auth::user()->name}}</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('warranty.index')}}" class="nav-link bg-blue" target="_blank">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Перейти в CRM
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">

                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>
                                Довідники
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('defect-codes.index')}}" class="nav-link">
                                    <i class="far fa-bookmark nav-icon"></i>
                                    <p>Коди дефектів</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('symptom-codes.index')}}" class="nav-link">
                                    <i class="far fa-bookmark nav-icon"></i>
                                    <p>Коди симптомів</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('works.index')}}" class="nav-link">
                                    <i class="far fa-bookmark nav-icon"></i>
                                    <p>Види сервісних робіт</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('parts.index')}}" class="nav-link">
                                    <i class="far fa-bookmark nav-icon"></i>
                                    <p>Запчастини</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Користувачі
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link">
                                    <i class="far fa-user-circle nav-icon"></i>
                                    <p>Усі користувачі</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.create')}}" class="nav-link">
                                    <i class="far fa-plus-square nav-icon"></i>
                                    <p>Додати користувача</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled list-mb0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
            </div>
        </div>

        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-<?= date('Y') ?> <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content g`oes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('assets/admin/plugins/jquery/jquery.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/admin/js/adminlte.js')}}"></script>
<script src="{{asset('assets/admin/js/main.js')}}"></script>

</body>
</html>
<?php
