@extends('layouts.app')
@section('content')
<div uk-scrollspy="cls: uk-animation-fade; delay: 500; repeat: false">
    <h1 class="uk-padding uk-text-center">Edit Tournamet</h1>
<form action="{{ route('update.testi',$testi) }}" enctype="multipart/form-data" method="POST">
{{ csrf_field() }}
      {{ method_field('PATCH')}}
<div class="uk-container uk-container-small uk-card-secondary uk-overlay uk-overlay-primary">
      <div class="uk-margin">
         <input class="uk-input" type="text" name="name" value="{{$testi->nama}}" required>
      </div>
      <div class="uk-margin">
         <img src="http://127.0.0.1:8000/img/testi/{{$testi->image}}" width="100" >
         <div uk-form-custom>
            <input type="file" name="image">
            <button class="uk-button uk-button-default" type="button" tabindex="-1">Select</button>
         </div>
      </div>
  
         <div class="uk-margin">
         <textarea class="uk-textarea" name="description">{!!$testi->description!!}</textarea>
      </div>        
         <div class="uk-form-controls">
            <select class="uk-select" id="form-stacked-select" name="status">
               @if($testi->status == 1)
               <option value="{{$testi->status}}">Publish</option>
               <option value="0">Not Publish</option>
               @else
               <option value="{{$testi->status}}">Not Publish</option>
               <option value="1">Publish</option>
               @endif
            </select>
      </div>
   </fieldset>
   <div class="uk-margin">
      <input  class="uk-button uk-button-default" type="submit" placeholder="Update">
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