@extends('layouts.app')

@section('content')
<div class="uk-position-center uk-text-center">
	<h1 class=" uk-text-uppercase">
		WELCOME BACK! 
	</h1>
	<h1 class=" uk-text-uppercase">{{auth()->user()->name}}</h1>
</div>
@endsection