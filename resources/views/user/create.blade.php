<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Работа.Барнаул - Регистрация и Авторизация</title>

    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
</head>
<body class="register-page bg-primary-dark">
<div class="register-box">
    <div id="wrap-register-logo">
        <h1 class="main-logo-text">
            <a class="link-logo-text" href="{{route('vacancies')}}" title="На главную страницу">
                <b style="color: white">Работа.<span class="cl-primary-green">Барнаул</span></b>
            </a>
        </h1>
    </div>
    <div class="card">
        <div class="">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs"  >
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-login" data-toggle="tab"
                               href="#tab-1" role="tab"  aria-controls="tab-2"
                               aria-selected="true"><b>Вход</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-register" data-toggle="tab"
                               href="#tab-2" role="tab" aria-controls="tab-1"
                               aria-selected="false"><b>Регистрация</b></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        {{--Авторизация--}}
                        <div id="tab-1" class="card-body login-card-body fade show active">
                            <div class="col-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-unstyled">
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <p class="login-box-msg">Войти на сайт</p>
                            <form action="{{route('login')}}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input name="email" type="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="password" type="password" class="form-control" placeholder="Пароль">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">
                                                Запомнить меня
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                                    </div>

                                </div>
                            </form>
                            {{--<div class="social-auth-links text-center mb-3">
                                <p>или</p>
                                <a href="#" class="btn btn-block btn-primary">
                                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                                </a>
                                <a href="#" class="btn btn-block btn-danger">
                                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                                </a>
                            </div>--}}

                            <p class="mb-1">
                                <a href="forgot-password.html">Я забыл свой пароль</a>
                            </p>
                        </div>
                        {{--Регистрация--}}
                        <div id="tab-2" class="card-body register-card-body fade">
                            <div class="col-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-unstyled">
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <p class="login-box-msg">Зарегистрироваться на сайте</p>
                            <form action="{{route('register.store')}}" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Полное имя" value="{{old('name')}}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control"
                                           placeholder="Email" value="{{old('email')}}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Пароль">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="Повторите пароль">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-column">
                                    <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="agreeTerms" name="terms" value="0">
                                            <label for="agreeTerms">
                                                Я согласен с <a href="#">условиями</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-8 m-auto">
                                        <button type="submit" id="btn-register"
                                                class="disabled btn btn-primary btn-block btn-register">
                                            Зарегистрироваться</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{--<div class="card-body register-card-body">
            <p class="login-box-msg">Регистрация нового пользователя</p>
            <form action="{{route('register.store')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Полное имя">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Повторите пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                Я согласен с <a href="#">условиями</a>
                            </label>
                        </div>
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Создать</button>
                    </div>

                </div>
            </form>
            <a href="login.html" class="text-center">У меня уже есть аккаунт</a>
        </div>--}}
    </div>
</div>


<script src="{{asset('assets/js/all.js')}}"></script>

</body>
</html>
