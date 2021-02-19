<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous">-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        dl,
        ol,
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .imgPreview img {
            padding: 8px;
            max-width: 100px;
        }

        .list-group {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }

        .dropdown-menu .dropdown-menu {
            top: auto;
            left: 100%;
            transform: translateY(-2rem);
        }

        .dropdown-item + .dropdown-menu {
            display: none;
        }

        .dropdown-item.submenu::after {
            content: '▸';
            margin-left: 0.5rem;
        }

        .dropdown-item:hover + .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
        }

        .navbar {
            margin: 20px !important;
            padding: 20px !important;
        }
.bg-dark-green{
    background-color: seagreen;
}
    </style>


</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm flex-md-nowrap rounded-pill"
         style="height: 40pt;">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <a class="navbar-brand" href="#">{{env('APP_NAME')}}</a>
                <div class="btn-group">

                    <a type="button" class="btn btn-secondary" autocomplete="off" checked> Об олимпиаде</a>


                    <a type="button" class="btn btn-secondary" autocomplete="off">Направления</a>


                    <a type="button" class="btn btn-secondary" autocomplete="off">Результаты</a>


                    <a type="button" class="btn btn-secondary" autocomplete="off">Зал славы</a>

                    @if(Auth::check())
                        <a type="button"
                           class="btn @if(\Route::current()->getName() == Auth::user()->role->slug.'.home') btn-success @else btn-secondary @endif"
                           href="{{ route(Auth::user()->role->slug.'.home')}}"
                            autocomplete="off">{{ __('Личный кабинет') }}</a>
                        <a type="button"
                           class="btn @if(\Route::current()->getName() == 'user.profile') btn-success @else btn-secondary @endif"
                           href="{{ route('user.profile',['id'=>Auth::user()->id])}}"
                          autocomplete="off">{{ __('Профиль') }}</a>
                    @endif
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <div class="btn-group btn-group-toggle " data-toggle="buttons">
                            @if (Route::has('login'))
                                <a class="btn btn-light border-dark" href="{{ route('login') }}">{{ __('Вход') }}</a>
                            @endif
                            @if (Route::has('register'))
                                <a class="btn btn-light border-dark" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                            @endif
                        </div>
                    @else


                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-light" type="submit"> {{ __('Выйти') }}</button>
                            </form>
                        </li>

                    @endguest

                </ul>
            </div>

        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>

</html>
