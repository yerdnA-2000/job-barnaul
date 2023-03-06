@extends('user/show_my')

@section('myProfile')

    <!-- Header content -->
    <div class="container-content-header">
        <div class="title-page"><b>Мой профиль</b></div>
    </div>

    <!-- Body content vacancies -->
    <div class="container-profile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center">{{$user->name}}</h3>
                            <p class="text-muted text-center">Зарегистрирован с {{$user->getCreatedAt()}}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Дата рождения</b>
                                    <span class="float-right">{{$user->getDateBorn()}} ({{$user->getAge()}})</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <span class="float-right">{{$user->email}}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Телефон</b>
                                    <span class="float-right">не указан</span>
                                </li>
                            </ul>
                            {{--<a href="#" class="btn btn-outline-secondary btn-block"><b>Редактировать профиль</b></a>--}}
                        </div>
                    </div>
                    {{-------Функциональность компаний для будущих обновлений----
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Моя организация</h3>
                        </div>

                        <div class="card-body">
                            <strong class="card-name-company text-center">{{$company->title}}</strong>
                            <hr>
                            <strong><i class="fas fa-book mr-1"></i> Деятельность</strong>
                            <p class="text-muted">{{$company->activity}}</p>
                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Адрес</strong>
                            <p class="text-muted">{{$company->address}}</p>
                            <hr>
                            <strong><i class="fas fa-phone mr-1"></i> Контакты</strong>
                            <p class="text-muted">
                                <span class="tag tag-danger">{{$company->contacts}}</span>
                            </p>
                            <hr>
                            <p class="text-muted text-center">На сайте с {{$company->getCreatedAt()}}</p>
                            <a href="#" class="btn btn-outline-secondary btn-block"><b>Редактировать организацию</b></a>
                        </div>
                    </div>--}}
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">
                                        Мои вакансии</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">
                                        Избранное</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    @if (count($vacs))
                                        <div class="row mb-2 header-list-my-vacancies">
                                            <div class="col-sm-6">Размещено:
                                                <b>{{$rowCountVacs}}</b>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="float-sm-right">
                                                    <a href="{{route('vacancies.create')}}">Разместить вакансию +</a>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($vacs as $vac)
                                            <div class="item-vacancy">
                                                <div class="content-item-vacancy">
                                                    <div class="header-vacancy less">
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
                                                            <div class="row-vacancy less">
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
                                                            <div class="row-vacancy less">
                                                                <i class="fa-regular fa-clock"></i>
                                                                <span>{{$vac->schedule->title}}</span>
                                                            </div>
                                                            <div class="row-vacancy less">
                                                                <i class="fa-solid fa-briefcase"></i>
                                                                <span>Опыт {{$vac->experience->title}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-right-vacancy">
                                                            <div class="row-vacancy less">
                                                                <i class="fa-solid fa-user-tie"></i>
                                                                <span><b>{{$vac->employer}}</b></span>
                                                            </div>
                                                            <div class="row-vacancy less">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                                <span>{{$vac->address}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="footer-vacancy">
                                                        <div class="row-footer-vacancy less">
                                                            <i class="fa fa-calendar-days"></i>
                                                            <span>{{$vac->getHumanDate()}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="item-arrow" href="{{route('vacancies.show', ['id' => $vac->id])}}">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>Вы не размещали вакансий. Для создания вакансии нажмите кнопку
                                            "Разместить вакансию"</p>
                                    @endif
                                </div>

                                <div class="tab-pane" id="timeline">
                                    @if (count($favVacs))
                                        <div class="row mb-2 header-list-my-vacancies">
                                            <div class="col-sm-6">Избранных:
                                                <b>{{$rowCountFavVacs}}</b>
                                            </div>
                                        </div>
                                        @foreach($favVacs as $vac)
                                            <div class="item-vacancy">
                                                <div class="content-item-vacancy">
                                                    <div class="header-vacancy less">
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
                                                            <div class="row-vacancy less">
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
                                                            <div class="row-vacancy less">
                                                                <i class="fa-regular fa-clock"></i>
                                                                <span>{{$vac->schedule->title}}</span>
                                                            </div>
                                                            <div class="row-vacancy less">
                                                                <i class="fa-solid fa-briefcase"></i>
                                                                <span>Опыт {{$vac->experience->title}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-right-vacancy">
                                                            <div class="row-vacancy less">
                                                                <i class="fa-solid fa-user-tie"></i>
                                                                <span><b>{{$vac->employer}}</b></span>
                                                            </div>
                                                            <div class="row-vacancy less">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                                <span>{{$vac->address}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="footer-vacancy">
                                                        <div class="row-footer-vacancy less">
                                                            <i class="fa fa-calendar-days"></i>
                                                            <span>{{$vac->getHumanDate()}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="item-arrow" href="{{route('vacancies.show', ['id' => $vac->id])}}">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>У вас нет избранных вакансий</p>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection
