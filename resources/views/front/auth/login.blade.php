@extends('front.layouts.layout')

@section('content')

    <body class="login-page">

    <div class="main" id="main">
        <form action="{{route('crm.login')}}" method="post">
            @csrf

            <p class="form-title">Авторизація</p>

            <div class="form-group required" data-valid="mask">
                <label for="email">Електронна пошта</label>
                <input class="_js-mask-email" type="text" id="email" name="email" placeholder="Пошта">
                <div class="help-block" data-empty="Обов`язкове поле"></div>
            </div>

            <div class="form-group required" data-valid="empty">
                <label for="password">Пароль</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Пароль">
                    <button type="button" class="icon-visible btn-password-visible"></button>
                </div>
                <div class="help-block" data-empty="Обов`язкове поле"></div>
            </div>

            <div class="form-group checkbox">
                <input type="checkbox" id="remember">
                <label for="remember">Запам’ятати мене</label>
            </div>

            <button type="submit" class="btn-primary btn-blue">Увійти</button>
        </form>
        <div class="hello">
            <h1 class="h1">
                👋 Вітаємо у <strong>AL-KO Service</strong>
            </h1>
            <div class="desc">
                <p>
                    Для доступу до порталу введіть свої електронну пошту та пароль
                </p>
            </div>
        </div>
    </div>

@endsection
