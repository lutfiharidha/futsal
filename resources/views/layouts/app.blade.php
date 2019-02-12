<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link rel="stylesheet" href="{{ asset('f/css/froala_editor.pkgd.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('f/css/froala_style.min.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300" rel="stylesheet">

<link rel="stylesheet" href="{{ url('css/app.css') }}" />
<!-- UIkit JS -->
<script src="{{ asset('js/uikit.min.js') }}"></script>
<script src="{{ asset('js/uikit-icons.min.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
</head>
<body>

<nav class="uk-container uk-container-medium uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
<a class="uk-navbar-item uk-logo" href="{{ route('index') }}">Atlantic Futsal</a>
    </div>
    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
            @guest
            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
            <li> @if (Route::has('register'))
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif</li>
                        @else
                        @if(Auth::user()->hasRole('admin'))
            <li><a href="{{ route('data.member') }}">Members</a></li>
            <li><a href="{{ route('data.field') }}">Fields</a></li>
            <li><a href="{{route('data.tournament')}}">Tournaments</a></li>
            <li><a href="{{route('data.testi')}}">Testimonials</a></li>
            <li><a href="{{route('data.contact')}}">Contact</a></li>
                @elseif(!Auth::user()->hasRole('admin'))
                <li><a href="{{ route('data.account') }}">Account</a></li>
                @endif
                <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
                
            </li>
        </ul>
        @endguest
                </div>
            </li>
        </ul>
    </div>
</nav>
            @yield('content')
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script src="{{ asset('f/js/froala_editor.pkgd.min.js') }}"></script>
   <script> $('textarea').froalaEditor({
  toolbarButtons: ['undo', 'redo' , 'bold', 'italic', 'formatOL']
});</script></body>

</html>
