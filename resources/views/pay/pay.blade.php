@extends('layouts.nav')
@section('content')
	<div class="uk-padding uk-card uk-card-default uk-align-center uk-width-1-3@m uk-card-body">
		<h3>Pembayaran Tournament {{$field->name}}</h3>
		<dd class="uk-child-width-1-3 uk-remove-margin" uk-grid>
            <b>No Rek <br>A/N <br>Bank</b>
            <span>24081998<br>Atlantic<br>BANK ACEH</span>
</dd>
		<form action="{{ route('sbook', [$field->id,preg_replace('/\+/', '-',urlencode(strtolower($field->name)))])}}" enctype="multipart/form-data" method="POST">
			@csrf
			<div class="uk-margin">
         		<div class="uk-form-controls">
            		<select class="uk-select" id="form-stacked-select" name="user" onclick="calc()">
            			@foreach($booked as $cl)
               			<option value="{{$cl->id}}">{{$cl->no_book}} - {{$cl->nama}}</option>
               			@endforeach
            		</select>
     		 </div>
		     </div>
		     <div class="uk-margin" id="info">
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
		<script type="text/javascript">
			function calc(){
            $(document).ready(function() {
            $('select[name="user"]').on('click', function() {
                var id = $(this).val();
                    if(id) {
                    $.ajax({
                        url: '{{url("http://127.0.0.1:8000/booking/user")}}/'+encodeURI(id),
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                        $.each(data, function(key, value) {
                        $("#info").html('<dd class="uk-child-width-1-3 uk-remove-margin" uk-grid><b>Nama <br>Tanggal <br>Dari <br>Sampai <br>Harga </b><span>'+value['nama']+'<br>'+value['tanggal']+'<br>'+value['dari']+'<br>'+value['sampai']+'<br>'+value['total']+'</span></dd>');
                        if (value['kupon'] != null) {
                        $("#info").html('<dd class="uk-child-width-1-3 uk-remove-margin" uk-grid><b>Nama <br>Tanggal <br>Dari <br>Sampai <br>Discount <br>Harga </b><span>'+value['nama']+'<br>'+value['tanggal']+'<br>'+value['dari']+'<br>'+value['sampai']+'<br> 25%<br>'+value['total']+'</span></dd>');
                        }
                            });

                        }
                    });
                    }
                   });
                });
        }
        </script>
@endsection
