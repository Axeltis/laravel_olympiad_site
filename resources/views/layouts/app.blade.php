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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;0,900;1,900&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <style>
            @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");
   :root {
  --bg: white;
  --color: black;
  --underline-width: 2px;
  --underline-block-width: 20px;
  --underline-color: hsla(180, 100%, 50%, 0.5);
  --underline-color-hover: #198754;
  --underline-transition: 0.5s;
}
        #app{
            margin-bottom: 5vh;
            min-height: calc(100vh - 200px);
        }
.navbar {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding: 0 1rem!important;
    margin: 20px !important;
    backdrop-filter: blur(4px);
}

.carousel-inner{
    -webkit-transition: 5s linear left;
    -moz-transition: 5s linear left;
    -o-transition: 5s linear left;
    transition: 5s linear left;
}

a[type="button"] {
  color: var(--color)!important;
  text-decoration: none;
  margin-left: .2em;
  background-size: var(--underline-block-width) var(--underline-width),
    100% var(--underline-width);
  background-repeat: no-repeat;
  background-position-x: calc(var(--underline-block-width) * -1), 0;
  background-position-y: 100%;
  transition: background-position-x var(--underline-transition);
}

a[type="button"]:hover {
  background-image: linear-gradient(90deg, var(--bg), var(--bg)),
    linear-gradient(
      90deg,
      var(--underline-color-hover),
      var(--underline-color-hover)
    );
  background-position-x: calc(100% + var(--underline-block-width)), 0;
}



        .border-green {
            border: medium solid #457f57;
        }

        dl,
        ol,
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

p {
background-color: transparent;
}

   	body {
  font-family: 'Roboto', sans-serif;
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}        .imgPreview img {
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

        .bg-dark-green {
            background-color: seagreen;
        }
        
            .facts{
        margin: 0 auto;
        border-radius: 12px;
        width:100%;
        height:200px;
        align-items: center;
        background-color: transparent;
        display: flex;
        justify-content: center;
        color: aliceblue;
        font-size: 1.4rem;
    }
    .customLIbullets li::marker{
        font-size: 1.4rem;
        content: "»";
        font-weight: 800;
    }
    li{
        font-size: 1.35rem;
        padding-left: 1.4em
    }
  .card-body  p{
        text-indent: 1.3em;
        font-size: 1.4rem
    }
    
    
    
    .Footer{
  background: #a3ceac;
  color: #fff;
  width: 100%;
  height: 250px;
  display: flex;
  justify-content: center;
  flex-direction: column; 
  align-items: center;
  margin-top: 5vh;
  border-top: 1px solid #00a651;
}
        .col a{
            text-decoration: none;
            color: #fff;
        }
        .col:nth-child(2){
            border-right:1px solid white ;
        }
        .col:nth-child(3){
            border-right:1px solid white ;
        }
    @media screen  and (max-width: 765px) {
        .customLIbullets li::marker{
        font-size: .75rem;
        content: "»";
        font-weight: 800;
    }
    li{
        padding-left: 1.1em;
        font-size: .75rem;
    }
  .card-body  p{
        text-indent: 1.1em;
        font-size: .8rem
    }
    .facts{
        margin: 0 auto;
        border-radius: 12px;
        width:75%;
        height:200px;
        align-items: center;
        background-color: transparent;
        display: flex;
        justify-content: center;
        color: aliceblue;
        font-size: .8rem;
    }
    }
    @media screen  and (max-width: 1024px) and (min-width:765px) {
        .customLIbullets li::marker{
        font-size: 1.3rem;
        content: "»";
        font-weight: 800;
    }
    li{
        font-size: 1.2rem;
        padding-left: 1.2em
    }
  .card-body  p{
        text-indent: 1em;
        font-size: 1.1rem
    }
    .facts{
        margin: 0 auto;
        border-radius: 12px;
        width:100%;
        height:200px;
        align-items: center;
        background-color: transparent;
        display: flex;
        justify-content: center;
        color: aliceblue;
        font-size: 1rem;
    }
    }
           
    </style>


</head>

<body>

<div id="app">
    
  <nav class="navbar sticky-top navbar-expand-sm navbar-dark shadow-sm border rounded border-success" style="padding:0 1rem!important">
        <div class="">
    <a class="navbar-brand" href="#">
       <img src="https://i.ibb.co/JKh8W7b/gotovy3.png" class="rounded" width=50>
    </a>
  </div>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse show" id="navbarToggler" >
                <div class="navbar-nav flex" >
                    <a type="button"  href="{{route('about')}}" class="btn btn-outline-success"> О конкурсе</a>
                    <a type="button" href="{{ route('competitions.schedule') }}"
                       class="btn btn-outline-success"
                       autocomplete="off"> Расписание</a>
                    <a type="button" href="{{route('competitions')}}"
                       class="btn btn-outline-success "
                    >Направления</a>
                    <a type="button"
                       @if(!Auth::check())   class="btn  btn-outline-secondary disabled" @else
                       class="btn btn-outline-success"
                       href="{{ route(Auth::user()->role->slug.'.home')}}"
                        @endif
                    >{{ __('Личный кабинет') }}</a>
                    <a type="button"
                       @if(!Auth::check())   class="btn  btn-outline-secondary disabled" @else
                       class="btn @if(\Route::current()->getName() == 'user.profile') btn-outline-success @else btn-outline-secondary @endif"
                       href="{{ route('user.profile',['user_id'=>Auth::user()->id])}}"
                        @endif
                    >{{ __('Профиль') }}</a>
                </div>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto  ">
                    <!-- Authentication Links -->
                    @guest
                        <div class="btn-group btn-group-toggle " data-toggle="buttons">
                            @if (Route::has('login'))
                                <a class="btn btn-light border-dark" href="{{ route('login') }}">{{ __('Вход') }}</a>
                            @endif
                            @if (Route::has('register'))
                                <a class="btn btn-light border-dark"
                                   href="{{ route('register') }}">{{ __('Регистрация') }}</a>
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
    </nav>


    <main class="py-4">
        @yield('content')
    </main>

     <div class="Footer">
    <div class="row row-cols-5 w-100 ">
        <div class="col"></div>
            <div class="col">
                <p>Наши партнеры</p>
                  <a href="http://atr73.ru">              <img class="mb-2" src="http://atr73.ru/wp-content/uploads/2019/10/Untitled-2.png" width="150"></a><br>
                  <a href="http://intelsi.ru">            <img class="mb-2" src="http://intelsi.ru/images/logo_01-02.svg?crc=4214952120" width="150"></a><br>
                  <a href="https://www.simbirsoft.com">   <img class="mb-2" src="https://www.simbirsoft.com/local/templates/.default/img/ss-logo-symbol-blue-216-54.png" width="150"></a><br>
                  <a href="https://ibs.ru/">              <img src="https://ibs.ru/local/templates/ibs-redesign/assets/images/ibs-logo.svg"  width="50"></a><br>
            </div>
            <div class="col">
                <p>Контакты</p>
                <i style="">Мардамшина Анна Александровна</i><br>
                <a href="tel:+79603757217"><i class="bi bi-telephone me-2"></i>+79603757217</a><br>
                <a href="mailto:mardamshinaa@bk.ru"><i class="bi bi-envelope me-2"></i>mardamshinaa@bk.ru</a><br>
            </div>
            <div class="col">
                <p>Мы в социальных сетях</p>
                <a href="https://vk.com/uaviakmck"><img class="me-2"src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/VK.com-logo.svg/192px-VK.com-logo.svg.png" width="17">ВКонтакте</a><br>
                <a href="https://www.instagram.com/uaviak_73/"><i class="bi bi-instagram me-2"></i>Instagram</a><br>
                <a href="https://uaviak.ru/"><i class="bi bi-globe2 me-2"></i>УАвиаК - МЦК</a>
            </div>
            <div class="col"></div>
        </div>

    </div>      




</div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>
