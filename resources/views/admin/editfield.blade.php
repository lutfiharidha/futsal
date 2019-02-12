@extends('layouts.app')
@section('content')
<div uk-scrollspy="cls: uk-animation-fade; delay: 500; repeat: false">
    <h1 class="uk-padding uk-text-center">Edit Field</h1>
<form action="{{ route('update.field',$fields) }}" enctype="multipart/form-data" method="POST">
{{ csrf_field() }}
      {{ method_field('PATCH')}}
<div class="uk-container uk-container-small uk-card-secondary uk-overlay uk-overlay-primary">
      <div class="uk-margin">
         <input class="uk-input" type="text" name="name" value="{{$fields->name}}" required>
      </div>
      <div class="uk-margin">
         <img src="http://127.0.0.1:8000/img/field/{{$fields->image}}" width="100" alt="Border pill">
         <div uk-form-custom>
            <input type="file" name="image">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
         </div>
      </div>
  
         <div class="uk-margin">
            <span class="uk-text-bold">Fasilitas</span>
         <textarea class="uk-textarea" name="fasilitas">{!!$fields->fasilitas!!}</textarea>
      </div>      
      <div class="uk-child-width-1-2 uk-margin" uk-grid> 
         <div>
         <div class="uk-form-controls">
            <input class="uk-input" type="number" name="price" value="{{$fields->harga}}" required>
         </div>
      </div>
         <div>
         <div class="uk-form-controls">
            <select class="uk-select" id="form-stacked-select" name="status">
               @if($fields->status == 1)
               <option value="{{$fields->status}}">Opened</option>
               <option value="0">Closed</option>
               @else
               <option value="{{$fields->status}}">Closed</option>
               <option value="1">Opened</option>
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