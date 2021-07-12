<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous">-->
    <!-- Scripts --><script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
   
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
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm flex-md-nowrap rounded-pill border-green "
         style="height: 40pt; ">


        <div class="container  ">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar <a class="navbar-brand" href="#">{{env('APP_NAME')}}</a> -->
       
 <!--<img src="https://i.ibb.co/JKh8W7b/gotovy3.png" class="rounded" style=" height: 9.1%; width: 9.1%; position:relative; right:10.8%; ">-->
  <img src="https://i.ibb.co/JKh8W7b/gotovy3.png" class="rounded" style=" height: 4.4%; width:4.4%; position:relative; right:10.8%; ">
                <div class="btn-group" >
                    <a type="button"  href="{{route('about')}}" class="btn  @if(\Route::current()->getName()=='about') btn-success @else btn-secondary @endif"> О конкурсе</a>
                    <a type="button" href="{{ route('competitions.schedule') }}"
                       class="btn @if(\Route::current()->getName()=='competitions.schedule') btn-success @else btn-secondary @endif"
                       autocomplete="off"> Расписание</a>
                    <a type="button" href="{{route('competitions')}}"
                       class="btn @if(\Route::current()->getName()=='competitions') btn-success @else btn-secondary @endif"
                    >Направления</a>
                    <a type="button"
                       @if(!Auth::check())   class="btn  btn-secondary disabled" @else
                       class="btn @if(\Route::current()->getName() == Auth::user()->role->slug.'.home') btn-success @else btn-secondary @endif"
                       href="{{ route(Auth::user()->role->slug.'.home')}}"
                        @endif
                    >{{ __('Личный кабинет') }}</a>
                    <a type="button"
                       @if(!Auth::check())   class="btn  btn-secondary disabled" @else
                       class="btn @if(\Route::current()->getName() == 'user.profile') btn-success @else btn-secondary @endif"
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
</body>

</html>
