@extends('layouts.app')
@section('content')
<div uk-scrollspy="cls: uk-animation-fade; delay: 500; repeat: false">
    <h1 class="uk-padding uk-text-center">Add Field</h1>
<form action="{{ route('store.field') }}" enctype="multipart/form-data"  method="POST">
{{ csrf_field() }}
<div class="uk-margin-bottom uk-container uk-container-small uk-card-secondary uk-overlay uk-overlay-primary">
      {{ csrf_field() }}
      <div class="uk-margin">
         <input class="uk-input" type="text" name="name" placeholder="Field Name" required>
      </div>
      <div class="uk-margin">
         <div uk-form-custom>
            <input type="file" name="image">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
         </div>
      </div>
      <div class="uk-margin">
        <span class="uk-text-bold">Fasilitas</span>
         <textarea class="uk-textarea" name="fasilitas"></textarea>
      </div>  
      <div class="uk-child-width-1-2 uk-margin" uk-grid> 
      <div>
         <div class="uk-form-controls">
            <input class="uk-input" type="number" name="price" placeholder="Harga" required>
         </div>
      </div> 
      <div>
         <div class="uk-form-controls">
            <select class="uk-select" id="form-stacked-select" name="status">
               <option value="1">Open</option>
               <option value="0">Close</option>
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