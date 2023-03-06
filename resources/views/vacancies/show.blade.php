@extends('layouts/layout')
@section('title', $vac->title)
@section('meta_description', 'Свежие вакансии - {{$meta_description}}')
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
                        <h3><b>{{$vac->title}}</b></h3>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="content-item-vacancy">
                        <div class="body-vacancy">
                            <div class="col-left-vacancy">
                                <div class="row-vacancy mb-2">
                                    <span class="container-tag">
                                        @foreach($vac->tags as $tag)
                                            <a href="{{route('vacancies.search.tag', ['slugTag' => $tag->slug])}}">
                                                #{{str_replace(' ', '_', $tag->title)}}</a>
                                        @endforeach
                                    </span>
                                </div>
                                <div class="row-vacancy mb-2">
                                    <i class="fa fa-rub"></i>
                                    <span>
                                        @if ($vac->max_salary == null)
                                            От {{number_format($vac->min_salary, 0, '', ' ')}} руб.
                                            @else {{number_format($vac->min_salary, 0, '', ' ')}}
                                            &ndash; {{number_format($vac->max_salary, 0, '', ' ')}} руб.
                                        @endif
                                    </span>
                                </div>
                                <div class="row-vacancy mb-2">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <span>{{$vac->employer}}</span>
                                </div>
                                <div class="row-vacancy mb-2">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <span>{{$vac->address}}</span>
                                </div>
                                <div class="row-vacancy mb-2">
                                    <i class="fa-regular fa-clock"></i>
                                    <span>{{$vac->schedule->title}}</span>
                                </div>
                                <div class="row-vacancy mb-2">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span>Опыт {{$vac->experience->title}}</span>
                                </div>
                            </div>
                            <div class="col-right-vacancy">
                                @if ($vac->description != null)
                                <div class="row-vacancy mb-2">
                                    <span><b>Описание</b><br>{{$vac->description}}</span>
                                </div>
                                @endif
                                <div class="row-vacancy mb-2">
                                    <span><b>Контакты</b><br>{{$vac->contacts}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="footer-vacancy">
                            <div class="row-footer-vacancy">
                                <i class="fa fa-calendar-days"></i>
                                <span>{{$vac->getHumanDate()}}</span>
                            </div>
                            @if ($user != null)
                            <div class="row row-btn-add-favorites">
                                <form id="favorites" role="form" method="post">
                                    @csrf
                                    <input hidden name="vacancy_id" type="text" value="{{$vac->id}}">
                                    <button id="add-favorites" type="button"
                                            class="btn btn-outline-secondary btn-add-favorites @if (
                                                $isFavorite == false)no-favorites @else in-favorites @endif">
                                        <i id="star-favorite" class="fa-regular fa-star"></i>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content -->
    </div>


@endsection

