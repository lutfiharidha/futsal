@extends('layouts.app')
@section('content')
<div uk-scrollspy="cls: uk-animation-fade; delay: 500; repeat: false">
    <h1 class="uk-padding uk-text-center">{{$usertour->club}}</h1>
<form action="{{ route('update.user',$user) }}" method="POST">
{{ csrf_field() }}
      {{ method_field('PATCH')}}
<div class="uk-container uk-container-small uk-card-secondary uk-overlay uk-overlay-primary">
      <div class="uk-margin">
         <p>{{$user->club}}</p>
      </div>
      <div class="uk-margin">
         <p>{{$user->phone}}</p>
      </div>
      <div class="uk-margin">
         <p>{{$user->cat->name}},{{$user->prov->name}}</p>
      </div>
      <div class="uk-margin">
         <img src="http://127.0.0.1:8000/img/struk/{{$user->struk}}" width="100">
      </div>
      <div class="uk-margin">
         <p>{{$user->ref}}</p>
      </div>
      <div class="uk-child-width-1-2 uk-margin" uk-grid> 
         <div>
         <div class="uk-form-controls">
            <select class="uk-select" id="form-stacked-select" name="status">
               @if($user->status == 1)
               <option value="1">Verified</option>
               <option value="0">Not Verified</option>
               @else
               <option value="0">Not Verified</option>
               <option value="1">Verified</option>
               @endif
            </select>
         </div>
      </div>
   </div>
   </fieldset>
   <div class="uk-margin">
      <input  class="uk-button uk-button-default" type="submit" placeholder="Post">
</form>
</div>
</div>
@if($errors->any())
<div class="uk-text-center uk-text-lead uk-text-danger" uk-alert>
   <a class="uk-text-danger uk-alert-close" uk-close></a>
   <h3 class="uk-text-danger">Notice</h3>
   {{ implode('', $errors->all(':message')) }}
</div>
@endif
@endsection