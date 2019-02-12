<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}" />
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:300" rel="stylesheet">
<link rel="stylesheet" href="{{ url('css/app.css') }}" />
<!-- UIkit JS -->
<script src="{{ asset('js/uikit.min.js') }}"></script>
<script src="{{ asset('js/uikit-icons.min.js')}}"></script>
</head>
<body>
<div class="uk-background-fixed uk-background-cover uk-height-1 uk-panel uk-flex uk-flex-middle" uk-height-viewport="offset-bottom: false"  style="background-image: url(https://backgroundcheckall.com/wp-content/uploads/2017/12/background-login-5.png);">
    <div uk-scrollspy="cls: uk-animation-fade; repeat: false" class="uk-overlay uk-overlay-default uk-position-center uk-width-auto">
        <h1 class="uk-text-center">Atlantic Futsal</h1>

            <form class="uk-align-center" method="POST" action="{{ route('login') }}">
                        @csrf
    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="email" name="email" required autofocus>
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
            <input class="uk-input" type="password" name="password" required>
        </div>
    </div>
    <div class="uk-margin">
    <div class="uk-inline uk-float-right">
      <button class="uk-button uk-button-primary">Login</button>
    </div>
</div>
@if ($errors->has('email'))
      <div class="uk-text-danger">
         {{ $errors->first('email') }}    
      </div>
      @endif
</form>
</div>
</div>
</body>
</html>

