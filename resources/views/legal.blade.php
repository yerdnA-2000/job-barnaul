@extends('layouts/layout')
@section('title', 'Правовая информация')
@section('meta_description', 'Сайт находится в тестовом режиме. Вакансии не актуальны')
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
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="wrap-margin">
            <section class="content">
                <div class="title-vacancy p-0">
                    <div class="title-page">
                        <a href="{{url()->previous()}}" title="Вернуться назад">
                            <i class="fas fa-2x fa-angle-left"  ></i>
                        </a>
                        Сайт находится в тестовом режиме. Вся информация не актуальна.
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content -->
    </div>
@endsection
