<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="description" content="Anshu Memorial Academy CBSE Pattern Based an English Medium School from Std. Play to 8th">
<meta name="keywords" content="CBSE English School, Best CBSE School in Rajapakar Hajipur Vaishali, Play School, Anshu Memorial Academy School.">
<meta name="theme-color" content="#0275d8">

<meta property="og:type" content="website">
<meta property="og:url" content="http://anshumemorial.in/v2">
<meta property="og:title" content=":: Student | Anshu Memorial Academy ::">
<meta property="og:description" content="Anshu Memorial Academy CBSE Pattern Based an English Medium School from Std. Play to 8th">
<meta property="og:locale" content="en_IN">

<meta property="og:image" content="{{asset('apple-icon-180x180.png')}}">
<meta property="og:image:url" content="{{asset('apple-icon-180x180.png')}}">
<meta property="og:image:type" content="image/png">
<meta property="og:image:alt" content="Anshu-Memorial-Academy-Logo">

<meta name="twitter:card" content="Anshu Memorial Academy (AMA)">
<meta name="twitter:site" content="@AnshuMemorial">
<meta property="twitter:url" content="http://anshumemorial.in/v2">
<meta property="twitter:title" content=":: Home | Anshu Memorial Academy ::">
<meta property="twitter:description" content="Anshu Memorial Academy CBSE Pattern Based an English Medium School from Std. Play to 8th">
<meta property="twitter:image" content="{{asset('favicon/apple-icon-180x180.png')}}">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="translucent black" />

<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon.png') }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">

<meta name="msapplication-TileColor" content="#0275d8">
<meta name="msapplication-TileImage" content="{{ asset('ms-icon-144x144.png')}}">
<meta name="theme-color" content="#0275d8">

    <!-- <title>{{ config('app.name', 'Laravel') }}</title> -->

    @yield('meta')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Anshu Memorial Academy
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    @yield('btm-js')
     
</body>

</html>