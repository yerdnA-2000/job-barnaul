@extends('layouts/layout')
@section('title', 'Размещение вашей вакансии')
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
                <div class="container-content-header">
                    <div class="title-page"><b>Размещение вашей вакансии</b></div>
                </div>
                <div class="row p-2">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-default-danger">
                                Заполните все обязательные поля или проверьте правильность их заполнения
                            </div>
                        @endif
                    </div>
                    <form class="form-create-vacancy" action="{{route('vacancies.store')}}" method="post">
                        @csrf
                        <div class="container-col-create-vacancy">
                            <div class="first-col col-sm-6">
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="title">Наименование</label>
                                        <span class="star">*</span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="title"
                                               class="form-control @error('title') is-invalid @enderror" maxlength="128"
                                               placeholder="Профессия, должность..." value="{{old('title')}}">
                                    </div>
                                </div>
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="min-salary max-salary">Зарплата, руб.</label>
                                        <span class="star">*</span>
                                    </div>
                                    <div class="d-flex w-75">
                                        <div class="col-sm-6">
                                            <div class="input-group w-75">
                                                <div class="d-flex">
                                                    <input type="number" name="min_salary"
                                                           class="form-control @error('title') is-invalid @enderror"
                                                           maxlength="7"
                                                           placeholder="От" value="{{old('min-salary')}}">
                                                    <span class="star">*</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group w-75">
                                                <input type="number" name="max_salary" class="form-control" maxlength="7"
                                                       placeholder="До" value="{{old('max-salary')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="schedule">График работы</label>
                                        <span class="star">*</span>
                                    </div>
                                    <div class="input-group">
                                        <select class="form-control @error('schedule') is-invalid @enderror"
                                                name="schedule">
                                            @foreach($schedules as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="experience">Требуемый опыт работы</label>
                                        <span class="star">*</span>
                                    </div>
                                    <div class="input-group">
                                        <select class="form-control @error('experience') is-invalid @enderror"
                                                name="experience">
                                            @foreach($experiences as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="description">Описание</label>
                                    </div>
                                    <div class="input-group">
                                    <textarea name="description" rows="5"
                                              class="form-control @error('description') is-invalid @enderror" maxlength="1000"
                                              placeholder="Описание условий, задач и т.п.">@if(old('description') != null)
                                            {{old('description')}} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="second-col col-sm-6 float-right">
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="employer">Работодатель</label>
                                        <span class="star">*</span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="employer"
                                               class="form-control @error('employer') is-invalid @enderror" maxlength="128"
                                               placeholder="Название организации или ваше имя"
                                               value="{{old('employer')}}">
                                    </div>
                                </div>
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="address">Адрес</label>
                                        <span class="star">*</span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" name="address"
                                               class="form-control @error('address') is-invalid @enderror" maxlength="255"
                                               placeholder="Фактический адрес вакансии" value="{{old('address')}}">
                                    </div>
                                </div>
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="contacts">Контактные данные</label>
                                        <span class="star">*</span>
                                    </div>
                                    <div class="input-group">
                                    <textarea name="contacts" class="form-control @error('contacts') is-invalid @enderror"
                                              rows="3" maxlength="255"
                                              placeholder="Телефон, почта, контактное лицо">@if(old('contacts') != null)
                                            {{old('contacts')}} @endif</textarea>
                                    </div>
                                </div>
                                <div class="input-create-vacancy">
                                    <div class="d-flex">
                                        <label for="contacts">Теги</label>
                                        <span class="ml-1" style="color: gray">(Упрощает поиск вашей вакансии)</span>
                                    </div>
                                    <div class="input-group">
                                        <select name="tags[]" class="tags @error('tags') is-invalid @enderror"
                                                multiple="multiple" id="tags2" data-placeholder="Выбор тегов (не более 5)"
                                                autocomplete="off" style="width: 100%;">
                                            @foreach($tags->pluck('title', 'id') as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
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
                                        <button type="submit" id="btn-create"
                                                class="disabled btn btn-primary btn-block btn-create">
                                            Разместить вакансию</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </section>
        </div>
        <!-- /.content -->
    </div>


@endsection
