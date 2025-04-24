<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Anywhere MD') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.3.0/jquery.flexdatalist.min.js"></script>
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-flexdatalist/2.3.0/jquery.flexdatalist.min.css">

    {{-- @livewireStyles --}}
    <style>
        .img-div {
            position: relative;
            width: 46%;
            float:left;
            margin-right:5px;
            margin-left:5px;
            margin-bottom:10px;
            margin-top:10px;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            max-width: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .img-div:hover .image {
            opacity: 0.3;
        }

        .img-div:hover .middle {
            opacity: 1;
        }
    </style>
</head>
<body>
    @php
        $bgColor = 'navbar-dark bg-dark';
        if(!empty(Auth::user()->user_type)){
            if(Auth::user()->user_type == 'Doctor')
                $bgColor = 'navbar-light bg-warning';
            if(Auth::user()->user_type == 'Clinic')
                $bgColor = 'navbar-dark bg-primary';
        }
            
    @endphp
    <div id="app">
        <nav class="navbar fixed-top z-index-1 navbar-expand-lg {{ $bgColor }}">
            @if (session()->has('message'))
            <div id="divFlashMessage" class="alert alert-primary mt-5 w-auto z-index-1 position-absolute top-0 start-50 translate-middle">
                <i class="bi bi-info-circle-fill"></i>&nbsp;{{ session()->get('message') }}
            </div>
            <script type=text/javascript>
                $("#divFlashMessage").fadeOut(7000);
            </script>
            @endif
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Anywhere MD') }} {{ !empty(Auth::user()->user_type) ? '(' . Auth::user()->user_type . ')' : '' }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav me-auto text-light">
                        @foreach ($moduleList as $module => $moduleDet)
                            @php
                                //print_r($moduleDet);
                                $active = "";
                                if($module == $moduleActive)
                                    $active = "active";
                            @endphp
                        <li class="nav-item @empty($moduleDet['link']) dropdown @endempty">
                            <a href="{{ $moduleDet['link'] ?? '#' }}" class="nav-link @empty($moduleDet['link']) dropdown-toggle @endempty {{ $active }}" @empty($moduleDet['link'])X role="button" data-bs-toggle="dropdown" aria-expanded="false" @endempty>{{ $module }}</a>
                            @empty($moduleDet['link'])
                            <ul class="dropdown-menu">
                                @foreach ($moduleDet['sub'] as $subMenu => $subMenuDet)
                                    @can($subMenuDet['link'])
                                <li><a class="dropdown-item" href="{{ route($subMenuDet['link']) }}">{{ $subMenu }}</a></li>        
                                    @endcan
                                @endforeach
                            </ul> 
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        {{-- @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ 'Hi ' . (Auth::user()->user_type == 'Doctor' ? 'Dr. ': '') . Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Route::has('home.myaccount'))
                                    <a class="dropdown-item" href="{{ route('home.myaccount') }}">{{ __('My Account') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @auth
        @isset($formAction)
            @include('layouts.modal')
            @include('layouts.offcanvas')
        @endisset
    @endauth
    {{-- @livewireScripts --}}
</body>
</html>
