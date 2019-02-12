@extends('layouts.app')
@section('content')
<div class="uk-container uk-container-small">
	<div class="uk-padding uk-child-width-1-2@m" uk-grid>
	<div>
	<h3>USER INFO</h3>
	<dd class="uk-text-large" uk-grid>
            <b>Nama <br>Phone <br>Email <br>Pemesanan <br>Club</b>
            <span>{{auth()->user()->name}}<br>{{auth()->user()->phone}}<br>{{auth()->user()->email}}<br>{{auth()->user()->pemesanan}}<br>
            {{auth()->user()->club}}<br></span>
</dd>
<a href="{{route('saccount')}}" class="uk-margin-top uk-button uk-button-secondary uk-float-right">UPDATE</a>
</div>
	<div>
	<h3>COUPON INFO</h3>
	<form method="post" action="{{route('coupon')}}">
	@csrf
	{{ method_field('PATCH')}}
       @if(auth()->user()->cup->batas <= 0)
       <input class="uk-input" type="text" name="code" value="{{auth()->user()->cup->code}}" disabled>
       <p class="uk-margin-top uk-text-large">Batas pemakaian kode Anda sudah Habis, anda akan bisa memakai kode kembali bulan depan</p>
       @else
       <input class="uk-input" type="text" name="code" value="{{auth()->user()->cup->code}}">
        <p class="uk-margin-top uk-text-large">LIMIT {{auth()->user()->cup->batas}} Kali Pemesanan</p>
        <input type="submit" class="uk-margin-top uk-button uk-button-secondary uk-float-right" value="Update">
       @endif

</form>
</div>
</div>
</div>
@endsection