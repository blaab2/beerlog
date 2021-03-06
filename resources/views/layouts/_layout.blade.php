<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/tools.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/toastr.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
                <i class="fas fa-beer text-success"></i>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">{{ __('List') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('beers.index') }}">{{ __('Drinks') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.paypal.com/pools/c/8qDeh9YPym"
                               target="_blank">{{__('pay your debts')}}</a>
                        </li>
                        @can('manage drinks')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('beertype.index') }}">{{ __('Beertype') }}</a>
                            </li>
                        @endcan
                        @can('show details')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('settings.index') }}">{{ __('Settings') }}</a>
                            </li>
                        @endcan
                    @endauth
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->nickname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @include('cookieConsent::index')
    @yield('body_content')
</div>
@yield('welcome_content')


<footer class="footer fixed-bottom bg-dark">
    <div class="container">
        <span class="text-muted">Beerlog 2020 </span>
        <a href="{{route('impressum')}}">{{ __('Datenschutz und Impressum') }}</a>
    </div>
</footer>


@if(session()->has('flash_message'))
    <script>toastr["success"]('{{session()->get('flash_message')}}');</script>
@endif
@if(session()->has('flash_error'))
    <script>toastr["error"]('{{session()->get('flash_error')}}');</script>
@endif
@if(session()->has('popup_message'))
    <script> Swal.fire(
            'Debts alert',
            'Please pay your debts! {{session()->get('popup_message')}}€<br>Pay at <a href="https://paypal.me/pools/c/8qDeh9YPym" target="_blank">Paypal</a> or cash to Betriebsrat',
            'warning'
        )</script>
@endif


</body>
</html>
