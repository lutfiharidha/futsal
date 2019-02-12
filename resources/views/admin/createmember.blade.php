@extends('layouts.app')
@section('content')
<div uk-scrollspy="cls: uk-animation-fade; delay: 500; repeat: false">
    <h1 class="uk-text-center">Register Member</h1>
<form action="{{ route('storemember') }}" method="POST">
{{ csrf_field() }}
<div class="uk-container uk-container-small uk-card-secondary uk-overlay uk-overlay-primary">
    <div class="uk-margin">
         <input class="uk-input" name="id" type="text" value="{{$id}}">
    </div>
    <div class="uk-margin">
            <input class="uk-input" id="inputName" name="name" type="text" placeholder="Name" required>
    </div>
    <div class="uk-margin">
            <input class="uk-input" value="{{ old('email') }}" id="inputEmail" name="email" type="text" placeholder="Email" required>
    </div>
    <div class="uk-margin">
            <input class="uk-input" id="inputPassword" name="phone" type="number" placeholder="Phone Number" required>
    </div>
    <div class="uk-margin">
            <input class="uk-input" id="inputPassword" name="password" type="password" placeholder="Password" required>
    </div>
    <div class="uk-margin">
            <input class="uk-input" id="inputPassword" name="password_confirmation" type="password" placeholder="Password Confirmation" required>
    </div>
    <button class="uk-button uk-button-default">Register</button>
</div>
</form>
<div class="uk-margin uk-text-center">
        
        @if ($errors->has('email'))
        <h1 class="uk-text-danger">
            {{ $errors->first('email') }}    
        </h1>
        @endif
        @if ($errors->has('password'))
        <h1 class="uk-text-danger">
            {{ $errors->first('password') }}    
        </h1>
        @endif
        @if(session()->has('message'))
        <h1 class="uk-text-bold">
           {{ session()->get('message') }}
        </h1>
        @endif
    </div>
</div>
@endsection