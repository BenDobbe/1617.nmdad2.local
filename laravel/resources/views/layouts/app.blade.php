<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    @foreach ([
                        'verify.index' => 'Verify vote',
                    ] as $route => $label)
                        <li class="nav-item {!! Route::is($route) ? ' active' : null !!}">
                            <a class="nav-link" href="{{ route($route) }}">{{ $label}}</a>
                        </li>
                    @endforeach
                </ul>
                <ul class="navbar-nav">
                    @if (Auth::guest())
                        @foreach ([
                            'login' => 'Login',
                            'register' => 'Register',
                         ] as $route => $label)
                            <li class="nav-item {!! Route::is($route) ? ' active' : null !!}">
                                <a class="nav-link" href="{{ route($route) }}">{{ $label}}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('logout') }}" onclick="submitLogoutForm(event)">
                                logout
                            </a>
                            <form class="hidden-xs-up" id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
@if (Auth::user())
    <script>
        function submitLogoutForm(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    </script>
@endif
</body>
</html>