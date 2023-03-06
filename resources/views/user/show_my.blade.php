@extends('layouts/layout')
@section('title', 'Мой профиль')
@section('content')
    <div class="main-wrap">
        <!-- Content Header (Page header) -->
        <section class="content-header less bg-primary-dark">
            <div class="wrap-margin">
                <div class="row container-top-header less">
                    <div class="col-sm-6 d-flex">
                        <div class="main-logo-wrap-img less">
                            <img src="{{asset('assets/img/logo.png')}}" alt="Логотип">
                        </div>
                        <div class="main-logo-wrap-text less">
                            <a class="link-logo" href="{{route('vacancies')}}" title="На главную страницу">
                                <h1 class="main-logo-text">
                                    <b style="color: white">Работа.<span class="cl-primary-green">Барнаул</span></b>
                                </h1>
                            </a>
                        </div>
                    </div>
                    <div class="wrap-login-header-top">
                        <div class="container-login float-right d-flex">
                            <a id="link-logout-my-profile" href="{{route('logout')}}">
                                <i class="fa-solid fa-right-from-bracket mr-2"></i>
                                Выйти</a>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="wrap-margin">
            <section class="content">
                @yield('myProfile')

            </section>
        </div>
        <!-- /.content -->
    </div>


@endsection
