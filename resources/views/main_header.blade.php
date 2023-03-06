
<div class="wrap-margin">
    @if (session()->has('success'))
        <div class="alert-message" data-message="{{session('success')}}">
        </div>
    @endif
    <div class="row container-top-header">
        <div class="col-sm-6 d-flex">
            <div class="main-logo-wrap-img">
                <img src="{{asset('assets/img/logo.png')}}" alt="Логотип">
            </div>
            <div class="main-logo-wrap-text">
                <a class="link-logo" href="{{route('vacancies')}}" title="На главную страницу">
                    <h1 class="main-logo-text">
                        <b style="color: white">Работа.<span class="cl-primary-green">Барнаул</span></b>
                    </h1>
                </a>
            </div>
        </div>
        <div class="wrap-login-header-top">
            @if ($user != null)
                <div class="container-login float-right d-flex">
                    <a id="link-my-profile" href="{{route('myProfile')}}">
                        <i class="fa-solid fa-user mr-2 mb-3"></i>
                        Мой профиль</a>
                    <a id="link-logout" href="{{route('logout')}}">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>
                        Выйти</a>
                </div>
            @else
                <div class="container-login float-right d-flex">
                    <a href="{{route('register.create')}}">
                        <i class="fa-solid fa-right-to-bracket mr-2"></i>
                        Войти на сайт</a>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="wrap-idea-site">
            <h2><b>Поиск работы в Барнауле</b></h2>
        </div>
    </div>
    <form name="search" method="get" action="{{route('vacancies.search')}}">
        <div class="row mb-4" style="max-width: 100%">
            <div class="" style="width: 100%">
                <div class="container-search input-group d-flex">
                    <input id="input-primary-search" type="search" name="search" autocomplete="off"
                           class="form-control form-control-lg"
                           placeholder="Введите должность, специальность, ключевые слова"
                           value="{{request()->get('search')}}">
                    <div class="input-group-append btn-search-wrap">
                        <button type="submit" class="btn btn-primary-search bg-primary-green">
                            <span class="text-btn-primary-search"><b>Показать вакансии</b></span>
                            <i class="fa fa-search i-btn-primary-search"></i>
                        </button>
                    </div>
                    <table class="table-prompt table-hover">
                        <thead>
                        </thead>
                        <tbody class="tbody-prompt">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row container-text-filter">
            <span class="txt-filter">Фильтры</span>
            @if($countFilter > 0) <div id="count-filter">{{$countFilter}}</div>@endif
            <i id="extend-filter" class="fa-solid fa-chevron-down"></i>
            <i id="compress-filter" class="fa-solid fa-chevron-up"></i>
            <div id="reset-filter"><i class="d-block fa-solid fa-xmark"></i>Сбросить фильтры</div>
        </div>
        <div class="container-filter">
            <div class="form-group">
                <label for="input-salary">Зарплата от</label>
                <input id="input-salary" name="salary" type="number" class="form-control"
                       placeholder="Зарплата, руб" value="{{request()->get('salary')}}">
            </div>
            <div class="form-group">
                <label for="select-experience">Опыт работы в сфере</label>
                <select id="select-experience" class="form-control" name="experience" >
                    <option class="option-default" selected value="">не выбрано</option>
                    @foreach($experiences as $key => $value)
                        <option value="{{ $key }}" @if($key == request()->get('experience')) selected @endif>
                            {{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="select-schedule">График работы</label>
                <select id="select-schedule" class="form-control" name="schedule">
                    <option class="option-default" selected value="">не выбрано</option>
                    @foreach($schedules as $key => $value)
                        <option value="{{ $key }}" @if($key == request()->get('schedule')) selected @endif>
                            {{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

</div><!-- /.container-fluid -->

