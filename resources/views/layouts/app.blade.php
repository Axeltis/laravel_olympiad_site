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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <style>
   :root {
  --bg: white;
  --color: black;
  --underline-width: 2px;
  --underline-block-width: 20px;
  --underline-color: hsla(180, 100%, 50%, 0.5);
  --underline-color-hover: #198754;
  --underline-transition: 0.5s;
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
  /* The image used */
  background-image: url("https://sun9-1.userapi.com/impg/qOQcXxlBaQBxApjRuu6B_wRNpCARp-ChhkXpcg/8VYgrvsI4Oo.jpg?size=1280x853&quality=96&sign=f44a98a4027100243347ce393be3eb6a&type=album");

  /* Full height */
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
        font-size: 1.7rem;
    }
    .customLIbullets li::marker{
        font-size: 1.7rem;
        content: "»";
        font-weight: 800;
    }
    li{
        font-size: 1.65rem;
        padding-left: 1.4em
    }
  .card-body  p{
        text-indent: 1.5em;
        font-size: 1.7rem
    }
    @media screen  and (max-width: 765px) {
        .customLIbullets li::marker{
        font-size: .81rem;
        content: "»";
        font-weight: 800;
    }
    li{
        padding-left: 1.1em;
        font-size: .81rem;
    }
  .card-body  p{
        text-indent: 1.1em;
        font-size: .91rem
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
        font-size: .85rem;
    }
    }
    @media screen  and (max-width: 1024px) and (min-width:765px) {
        .customLIbullets li::marker{
        font-size: 1.5rem;
        content: "»";
        font-weight: 800;
    }
    li{
        font-size: 1.25rem;
        padding-left: 1.2em
    }
  .card-body  p{
        text-indent: 1.1em;
        font-size: 1.3rem
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
        font-size: 1.2rem;
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

           




</div>
<div class="container-fluid">
<footer class="footer  pt-md-5 border-top"  style="border-radius: 30px;">
        <div class="row">

<div class="col-12 col-lg" style="text-align: right;">
            <h4 class="text-light">Контакты</h4>
<h5>
           
	        <ul class="text-small" >

             <li> <a class="text-light" href="https://www.instagram.com/uaviak_73/" target="_blank" ><i class="fa  fa-instagram" aria-hidden="true"></i> Instagram</a></li>
             <li> <a class="text-light" href="https://vk.com/uaviakmck" target="_blank" ><i class="fa  fa-vk" aria-hidden="true"></i> ВКонтакте </a></li>
             <li> <a class="text-light" href="https://uaviak.ru/" target="_blank" ><img src="https://i.ibb.co/Ybg2f20/logo.png" style="width:10%; height: 5%"> УАвиаК - МЦК</a> </li>
  
</ul>
<p>
<ul class="text-small text-info text-light" >
  <li>Мардамшина Анна Александровна</li>
 <li>+79603757217</li>
 <li>mardamshinaa@bk.ru</li>
</ul>
<p><p><p><p><p><p><p><p><p><p><p>
</h5>
          </div>

<div class="col-12 col-lg">
            <h4  class="text-light">Наши партнеры</h4>
<h5>
            <ul class="text-small">
	      <li style="padding-right:7rem;"><a class="text-light" href="https://atr73.ru/" target="_blank">Агенство технологического развития</a></li>
              <li style="padding-right:7rem;"><a class="text-light" href="https://www.simbirsoft.com/" target="_blank" ><img src="https://i.ibb.co/XkXB2Sz/logo.png" style="width:20%;height:auto" ></a></li>
              <li style="padding-right:7rem;"><a class="text-light" href="http://intelsi.ru/" target="_blank" >Интелси</a></li>
              <li style="padding-right:7rem;"><a class="text-light" href="https://ibs.ru/" target="_blank" ><img src="https://i.ibb.co/4jXymTb/ibs-logo.png" style="width:12%;height:auto" ></a></li>
            </ul>
</h5>
          </div>
   


          <div class="col-6 col-md">
                 </div>


          
           

        </div>
   </footer>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>
