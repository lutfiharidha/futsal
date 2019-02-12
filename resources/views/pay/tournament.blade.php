@extends('layouts.nav')
@section('content')
	<div class="uk-padding uk-card uk-card-default uk-align-center uk-width-1-3@m uk-card-body">
		<h3>Pembayaran Tournament {{$tournament->tournament}}</h3>
		<dd class="uk-child-width-1-3 uk-remove-margin" uk-grid>
             <b>No Rek <br>A/N <br>Bank</b>
            <span>24081998<br>Atlantic<br>BANK ACEH</span>
</dd>
		<form action="{{ route('pay.store', [$tournament->id,preg_replace('/\+/', '-',urlencode(strtolower($tournament->tournament)))])}}" enctype="multipart/form-data" method="POST">
			@csrf
			<div class="uk-margin">
         		<div class="uk-form-controls">
            		<select class="uk-select" id="form-stacked-select" name="club">
            			@foreach($club as $cl)
               			<option value="{{$cl->id}}">{{$cl->club}}</option>
               			@endforeach
            		</select>
     		 </div>
		     </div>
		 <div class="uk-child-width-1-2@m uk-margin" uk-grid>
		     <div>
		         <input class="uk-input" type="number" name="ref" placeholder="No Ref" required>
		     </div>
		     <div>
		         <div uk-form-custom>
		            <input class="" type="file" name="struk">
		            <button class="uk-button uk-button-default" type="button" tabindex="-1">Image</button>
		         </div>
		      </div>
		</div>
		     <div class="uk-margin">
		         <input class="uk-input uk-width-1-2 uk-align-right uk-button uk-button-primary" type="submit" value="Submit">
		     </div>

	  </form>
@if($errors->any())
<div class="uk-text-center uk-text-lead uk-text-danger" uk-alert>
   <a class="uk-text-danger uk-alert-close" uk-close></a>
   <h3 class="uk-text-danger">Notice</h3>
   {{ implode('', $errors->all(':message')) }}
</div>
@endif
		</div>
@endsection