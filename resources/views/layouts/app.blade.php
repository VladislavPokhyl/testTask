
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Board') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script> src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"</script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {"csrfToken":"{{ csrf_token() }}"}
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a href="{{route('home')}}"><span class="font-weight-bold">ГЛАВНАЯ</span></a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">для добавления необходима авторизация</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>

                            </li>
                        @endif
                    @else
                        <li>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                               Добавть объявление
                            </button>


                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Добавить объявление</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                                {!! Form::open(array('action'=>'HomeController@create','class'=>'form','method'=>'POST',"enctype"=>"multipart/form-data")) !!}
                                                {{ csrf_field() }}
                                                <ul class="list-unstyled">
                                                    <li><div class="form-check">
                                                            <select required class="custom-select" data-dependent="city" id="regions" name="regions" onchange="selectedChanged2(this.value)">
                                                                @for($i=0;$i<count($regions);$i++)
                                                                    <option value="{{$i}}">{{$regions[$i]}}</option>
                                                                @endfor
                                                            </select>
                                                        </div></li>
                                                    <li><div class="form-check ">
                                                            <select required class="custom-select dynamic" name="city" id="cities2" style="min-width :130px">

                                                            </select>

                                                        </div></li>
                                                    <li> <div class='form-check'>
                                                            <input type="text" required class="form-control" name="carBrand" placeholder="Марка">
                                                        </div></li>
                                                    <li>
                                                        <div class='form-check'>

                                                            <input type="text" required class="form-control" name="carModel" placeholder="Модель">
                                                        </div></li>
                                                    <li><div class='form-check'>

                                                            <input step="0.1" type="number" name="carEngine" class="form-control" placeholder="Объем двигателя" required>
                                                        </div></li>
                                                    <li> <div class='form-check'>
                                                            <input type="number" name="milage" required class="form-control" placeholder="Километраж">
                                                        </div></li>
                                                    <li><div class='form-check'>
                                                            <input type="number" name="ownersCount" required class="form-control" placeholder="Кол-во владельцев">
                                                        </div></li>
                                                </ul>
                        <li> <div class="form-check-inline">
                                <input type="file" name="pic" value="pic"/>
                            </div></li>
                        <div class='row'>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                                <button type="submit"   class="btn btn-primary">Добавить</button>
                            </div>
                        </div>
                        {!! Form::close() !!}



             </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->email }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</div>
<main class="py-4">
    <div class="container">
        @yield("content")

        <script type="text/javascript" src="../resources/js/test.js"></script>
    </div>

</main>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
    window.Laravel = {"csrfToken":"{{ csrf_token() }}"}
</script>
</html>





















<script>
    function selectedChanged2(value){
        let ao=null;
        let cities=document.getElementById('cities2');
        cities.innerHTML="";
        if (value=='-1') {
            cities.innerHTML="";

        }
        if (window.XMLHttpRequest) {
            ao=new XMLHttpRequest();
        }
        else
            ao=new ActiveXObject("Microsoft.XMLHTTP");

        ao.onreadystatechange=function(){
            if(ao.readyState==4&&ao.status==200){
                let resp=ao.responseText;
                cities.innerHTML=resp;

            }}
        ao.open("GET","/home/cities/"+value,true);
        ao.send(null);
    }
</script>
