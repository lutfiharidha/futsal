@extends('layouts.app')
@section('content')
<div class="uk-container uk-container-small uk-padding uk-card uk-card-secondary" uk-scrollspy="cls: uk-animation-fade; repeat: true">
<form action="{{ route('supdate',auth()->user()->id) }}"  enctype="multipart/form-data" method="post">
   <fieldset class=" uk-margin-top uk-fieldset">
      {{ csrf_field() }}
      {{ method_field('PATCH')}}
      <legend class="uk-legend ">Update Account</legend>
      <div class="uk-margin">
         Name
         <input class="uk-input" type="text" name="name" value="{{auth()->user()->name}}">
      </div>
      <div class="uk-margin">
         Email
         <input class="uk-input" type="text" name="email" value="{{auth()->user()->email}}">
      </div>
      <div class="uk-margin">
         Phone
         <input class="uk-input" type="number" name="phone" maxlength="12" value="{{auth()->user()->phone}}">
      </div>
      <div class="uk-margin">
         Password
         <input class="uk-input" type="password" name="password">
      </div>
      <div class="uk-margin">
         Club
         <input class="uk-input" type="text" name="club"  value="{{auth()->user()->club}}">
      </div>
      <div class="uk-margin">
         @if(auth()->user()->image == null)
         <img src="http://www.atlanticfutsalva.com/wp-content/uploads/2016/11/afl_logo_200px.png" width="100" alt="Border pill">
         @else
         <img src="http://127.0.0.1:8000/img/club/{{auth()->user()->image}}" width="100" alt="Border pill">
         @endif
         <div uk-form-custom>
            <input type="file" name="image">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
         </div>
      </div>
   </fieldset>
   <div class="uk-margin">
      <input  class="uk-button uk-button-default" type="submit" value="Post">
      @if ($errors->has('email'))
      <div class="uk-text-danger">
         {{ $errors->first('email') }}    
      </div>
      @endif
      @if ($errors->has('password'))
      <div class="uk-text-danger">
         {{ $errors->first('password') }}    
      </div>
      @endif
      @if(session()->has('message'))
      <div class="uk-text-bold">
         {{ session()->get('message') }}
      </div>
      @endif
</form>
</div>

@endsection