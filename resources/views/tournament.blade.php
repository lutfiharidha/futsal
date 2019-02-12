@extends('layouts.nav')
@section('content')
<div class="uk-container uk-container-medium">
	<div class="uk-card uk-card-default uk-card-body">
		<img class="uk-align-center" src="http://127.0.0.1:8000/img/tournament/{{$tournament->image}}" style="object-fit: contain;" alt="">
		<h1 class="uk-text-center">{{$tournament->tournament}}</h1>
		<p>{!!$tournament->description!!}</p>
		<p><span class="uk-text-bold">SYARAT</span>{!!$tournament->syarat!!}</p>
		<div class="uk-child-width-1-2@m" uk-grid>
			<div>
		<p><span class="uk-button uk-button-text uk-text-bold">Form Pendaftaran</span></p>
		@if($tournament->club != $limit)
		<form action="{{ route('tour.store', [$tournament->id,preg_replace('/\+/', '-',urlencode(strtolower($tournament->tournament)))])}}" method="POST">
			@csrf
			<div class="uk-margin">
		         <input class="uk-input" type="text" name="name" placeholder="Nama Club" required>
		     </div>
     			<div class="uk-child-width-1-2@m uk-margin" uk-grid>
     				<div>
         		<div class="uk-form-controls">
            		<select class="uk-select" id="form-stacked-select" name="province">
            			@foreach($province as $prov)
               			<option value="{{$prov->id}}">{{$prov->name}}</option>
               			@endforeach
            		</select>
         		</div>
     		 </div>
     		<div>
        		<select class="uk-select" name="city" id="state">
        				<option value="">Select Province</option>
    			</select>
				</div>
			</div>
			<div class="uk-margin">
		         <input class="uk-input" type="text" name="hp" placeholder="No HP" required>
		     </div>
		     <div class="uk-margin">
		         <textarea id="j" class="uk-textarea" name="pemain" rows="10" placeholder="Pemain" required></textarea>
		     </div>
		     <div class="uk-margin">
		         <input class="uk-input uk-width-1-2 uk-align-right uk-button uk-button-primary" type="submit" value="Submit">
		     </div>
	  </form>
	  @else
	  <img src="{{asset('img/cl.jpg')}}">
	  	@endif
	</div>
	<div>
	<p><a href="{{route('pay.tour', [$tournament->id,preg_replace('/\+/', '-',urlencode(strtolower($tournament->tournament)))])}}" class="uk-button uk-button-text uk-text-bold">Form Pembayaran</a></p>
		<table class="uk-table uk-table-responsive uk-table-divider">
    		<thead>
		        <tr>
		            <th>No</th>
		            <th>Club</th>
		            <th>Province</th>
		            <th>City</th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach ($utor as $i => $data)
		        <tr>
		            <td>{{ $i+1 }}</td>
		            <td>{{ $data->club }}</td>
		            <td>{{ $data->prov->name }}</td>
		            <td>{{ $data->cat->name }}</td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
	</div>
</div>
	  @if(session()->has('pay'))
    <script type="text/javascript">
    	UIkit.modal.alert("<h3>Thank you for payment, we'll verified your payment.</h3>").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
      	  @if(session()->has('message'))
    <script type="text/javascript">
    	UIkit.modal.alert("Thank you for registration {{$tournament->tournament}} tournament. Please pay the registration fee <a href='{{route('pay.tour', [$tournament->id,preg_replace('/\+/', '-',urlencode(strtolower($tournament->tournament)))])}}'>here</a>, or click on Form Pembayaran.").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
	  </div>
</div>
    <script type="text/javascript">
            $(document).ready(function() {
            $('select[name="province"]').on('change', function() {
                var provinceId = $(this).val();
                    if(provinceId) {
                    $.ajax({
                        url: '{{url("/get-city")}}/'+encodeURI(provinceId),
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="'+ value['id'] +'">'+ value['name'] +'</option>');
                            });
                        }
                    });
                    }else{
                    $('select[name="city"]').empty();
                      }
                   });
                });
        </script>
@endsection