@extends('layouts/layout')
@section('title', 'Вакансии в Барнауле')
@section('content')
    <div class="main-wrap">
        <!-- Content Header (Page header) -->
        <section class="content-header bg-primary-dark">
            @include('main_header')
        </section>

        <!-- Main content -->
        <div class="wrap-margin">
            <section class="content">
                <!-- Header content -->
                <div class="container-content-header">
                    <div class="wrap-count-vacancy">
                        <div class="count-vacancy"><b>{{$rowCountVacs}}</b></div>
                    </div>
                    {{--<div class="wrap-sort">
                        <div class="form-group">
                            <label for="select-sort">Сортировка</label>
                            <select id="select-sort" class="custom-select">
                                <option>По соответствию</option>
                                <option>По дате</option>
                            </select>
                        </div>
                    </div>--}}
                </div>
                <!-- Body content vacancies -->
                <div class="container-vacancy mb-5">
                    <!-- Item vacancy -->
                    @if (count($vacs))
                        @foreach($vacs as $vac)
                            <div class="item-vacancy">
                                <div class="content-item-vacancy">
                                    <div class="header-vacancy">
                                        <h3><b>{{$vac->title}}</b></h3>
                                        <span class="container-tag">
                                            @foreach($vac->tags as $tag)
                                                  <a href="{{route('vacancies.search.tag', ['slugTag' => $tag->slug])}}">
                                                      #{{str_replace(' ', '_', $tag->title)}}</a>
                                            @endforeach
                                        </span>
                                    </div>
                                    <div class="body-vacancy">
                                        <div class="col-left-vacancy">
                                            <div class="row-vacancy">
                                                <i class="fa fa-rub"></i>
                                                <span>
                                                    <b>
                                                        @if ($vac->max_salary == null)
                                                            От {{number_format($vac->min_salary, 0, '', ' ')}} руб.
                                                            @else {{number_format($vac->min_salary, 0, '', ' ')}}
                                                            &ndash; {{number_format($vac->max_salary, 0, '', ' ')}} руб.
                                                        @endif
                                                    </b>
                                                </span>
                                            </div>
                                            <div class="row-vacancy">
                                                <i class="fa-regular fa-clock"></i>
                                                <span>{{$vac->schedule->title}}</span>
                                            </div>
                                            <div class="row-vacancy">
                                                <i class="fa-solid fa-briefcase"></i>
                                                <span>Опыт {{$vac->experience->title}}</span>
                                            </div>
                                        </div>
                                        <div class="col-right-vacancy">
                                            <div class="row-vacancy">
                                                <i class="fa-solid fa-user-tie"></i>
                                                <span><b>{{$vac->employer}}</b></span>
                                            </div>
                                            <div class="row-vacancy">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span>{{$vac->address}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer-vacancy">
                                        <div class="row-footer-vacancy">
                                            <i class="fa fa-calendar-days"></i>
                                            <span>{{$vac->getHumanDate()}}</span>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('vacancies.show', ['id' => $vac->id])}}"
                                   class="item-arrow" title="Подробнее...">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>Подходящих вакансий не найдено</p>
                    @endif
                </div>
                <!-- /.card -->
            </section>
        </div>
        <!-- /.content -->
    </div>
@endsection
