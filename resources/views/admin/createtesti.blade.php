@extends('layouts.app')
@section('content')
<div uk-scrollspy="cls: uk-animation-fade; delay: 500; repeat: false">
    <h1 class="uk-padding uk-text-center">Add Testimonial</h1>
<form action="{{ route('store.testi') }}" enctype="multipart/form-data"  method="POST">
{{ csrf_field() }}
<div class="uk-margin-bottom uk-container uk-container-small uk-card-secondary uk-overlay uk-overlay-primary">
      {{ csrf_field() }}
      <div class="uk-margin">
         <input class="uk-input" type="text" name="name" placeholder="Testimonial Name" required>
      </div>
      <div class="uk-margin">
         <div uk-form-custom>
            <input type="file" name="image">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
         </div>
      </div>
  
         <div class="uk-margin">
            <span class="uk-text-bold">Description</span>
         <textarea class="uk-textarea" name="description"></textarea>
      </div>      
      <div>
         <div class="uk-form-controls">
            <select class="uk-select" id="form-stacked-select" name="status">
               <option value="1">Publish</option>
               <option value="0">Not Publish</option>
            </select>
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