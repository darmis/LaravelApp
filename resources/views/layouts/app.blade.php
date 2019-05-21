<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img src="{{ asset('images/logo.jpg') }}" alt="logo picture">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Prisijungti</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} {{ Auth::user()->lastname }} <span class="caret"></span>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile/{{Auth::user()->id}}/edit">
                                    Keisti profilio duomenis
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Atsijungti
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

        <main>
            <div class="container-fluid">
                <div class="row">
                    @guest
                        <div class="col-md-12">
                    @else
                        <div class="left-nav col-md-2">
                            <div class="left-menu-item role-text">
                                {{-- @if($role == 0) Owner
                                @elseif($role == 1) Administrator
                                @elseif($role == 2) User
                                @endif --}}
                            </div>
                            <div class="left-menu-item">
                                <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'now-on' : '' }}"><i class="fa fa-columns"></i>Pradinis</a>
                            </div>
                            <div class="hr"></div>
                            <div class="left-menu-item">
                                <a href="{{ url('/repairs') }}" class="{{ Request::is('repairs') ? 'now-on' : '' }}"><i class="fa fa-wrench"></i>Remontas</a>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/repairs') }}" class="{{ Request::is('repairs') ? 'now-on' : '' }}"><i class="fa fa-bullseye"></i>Visi</a>
                                </div>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/newRepairs') }}" class="{{ Request::is('newRepairs') ? 'now-on' : '' }}"><i class="fa fa-file-o"></i>Nauji</a>
                                </div>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/notFinishedRepairs') }}" class="{{ Request::is('notFinishedRepairs') ? 'now-on' : '' }}"><i class="fa fa-spinner"></i>Vykdomi</a>
                                </div>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/thisMonthRepairs') }}" class="{{ Request::is('thisMonthRepairs') ? 'now-on' : '' }}"><i class="fa fa-bar-chart"></i>Šio mėnesio</a>
                                </div>
                            </div>
                            <div class="hr"></div>
                            <div class="left-menu-item">
                                <a href="{{ url('/services') }}" class="{{ Request::is('services') ? 'now-on' : '' }}"><i class="fa fa-cogs"></i>Servisas</a>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/services') }}" class="{{ Request::is('services') ? 'now-on' : ''}}"><i class="fa fa-bullseye"></i>Visi</a>
                                </div>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/newServices') }}" class="{{ Request::is('newServices') ? 'now-on' : '' }}"><i class="fa fa-file-text"></i>Nauji</a>
                                </div>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/notFinishedServices') }}" class="{{ Request::is('notFinishedServices') ? 'now-on' : '' }}"><i class="fa fa-spinner"></i>Vykdomi</a>
                                </div>
                                <div class="left-menu-item-inner">
                                    <a href="{{ url('/thisMonthServices') }}" class="{{ Request::is('thisMonthServices') ? 'now-on' : '' }}"><i class="fa fa-pie-chart"></i>Šio mėnesio</a>
                                </div>
                            </div>
                            <div class="hr"></div>
                            <div class="left-menu-item">
                                <a href="{{ url('/tasks') }}" class="{{ Request::is('tasks') ? 'now-on' : '' }}"><i class="fa fa-calendar"></i>Kalendorius</a>
                            </div>
                            <div class="hr"></div>
                            <div class="left-menu-item">
                                <a href="{{ url('/clients') }}" class="{{ Request::is('clients') ? 'now-on' : '' }}"><i class="fa fa-address-book-o"></i>Klientai</a>
                            </div>
                            <div class="hr"></div>
                            <div class="left-menu-item">
                                <a href="{{ url('/users') }}" class="{{ Request::is('users') ? 'now-on' : '' }}"><i class="fa fa-users"></i>Vartotojai</a>
                            </div>
                            <div class="hr"></div>
                            <div class="left-menu-item">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>Atsijungti</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        <div class="col-md-10 py-4">
                    @endguest
                        @include('inc.messages')
                        @yield('content')
                </div>
            </div>
        </main>
    </div>

<script type="text/javascript">

        function ConfirmDelete(){
            var x = confirm("Ar tikrai norite ištrinti?");
            if (x)
                return true;
            else
                return false;
        }
    document.addEventListener("DOMContentLoaded", function(event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.isShowingRepair').on('change', function() {
            var id = $(this).data('showing-id');
            if($(this).is(":checked")) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/isShowingRepair') }}",
                    data: { 
                        id: id,
                        arRodo: 1
                     }
                });
            } else {
                $.ajax({
                    type: "get",
                    url: "{{ url('/isShowingRepair') }}",
                    data: { 
                        id: id,
                        arRodo: 0
                     }
                });
            }
            
        });

        $('.isShowingService').on('change', function() {
            var id = $(this).data('showing-id');
            if($(this).is(":checked")) {
                $.ajax({
                    type: "get",
                    url: "{{ url('/isShowingService') }}",
                    data: { 
                        id: id,
                        arRodo: 1
                     }
                });
            } else {
                $.ajax({
                    type: "get",
                    url: "{{ url('/isShowingService') }}",
                    data: { 
                        id: id,
                        arRodo: 0
                     }
                });
            }
            
        });

        $('.search-btn').on('click', function(){
            $('.search-form').toggleClass('hidden');
        });
    });
    </script>
</body>
</html>
