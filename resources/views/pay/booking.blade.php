@extends('layouts.nav')
@section('content')
<div class="uk-container uk-container-medium">
	<div class="uk-card uk-card-default uk-card-body">
		<img class="uk-width-1-2 uk-align-center" src="http://127.0.0.1:8000/img/field/{{$field->image}}" style="object-fit: contain;" alt="">
		<div>
		<p class="uk-text-bold">FASILITAS</p>
		<p>{!!$field->fasilitas!!}</p>
		</div>
		<h1 class="uk-text-center">{{$field->tournament}}</h1>
		<div class="uk-child-width-1-2@m" uk-grid>
			
			<div>
		<p><span class="uk-button uk-button-text uk-text-bold">Form Booking</span></p>
		<form action="{{ route('bookstore', [$field->id,preg_replace('/\+/', '-',urlencode(strtolower($field->name)))])}}" method="POST">
			@csrf
			<div class="uk-margin">
		         <input class="uk-input" type="text" name="name" placeholder="Nama" required>
		     </div>
			<div class="uk-margin">
		         <input class="uk-input" type="text" name="hp" placeholder="No HP" required>
		     </div>
		     <div class="uk-child-width-1-2@m uk-margin" uk-grid>
     				<div>
         		<input  id="datefield" class="uk-input" type="date" name="date" min="" required>
     		 </div>
     		<div>
        		  <input id="horaInicio" type="hidden" class="uk-input time" name="dari" />
			</div>
			<div>
         		<div class="uk-form-controls">
            		<select class="uk-select" id="form-stacked-select" name="waktu" onclick="calc()">
               			<option>Waktu</option>
               			<option value="3600">1 Jam</option>
               			<option value="7200">2 Jam</option>
               			<option value="10800">3 Jam</option>
               			<option value="14400">4 Jam</option>
               			<option value="18000">5 Jam</option>
            		</select>
         		</div>
     		 </div>
		     <div>
          @guest
		         <input class="uk-input" type="text" name="kupon" placeholder="Kupon Member">
             @else
             <input type="checkbox" name="used" value="Bike"> Coupon<br>
             @endguest
		     </div>
		         <input type="hidden" name="total" id="ttl">
		     <div>
		         <input class="uk-input uk-button uk-button-primary" type="submit" value="Booking">
		     </div>
			</div>
	  </form>
	</div>
			<div>
	<p><a href="{{route('pay.book', [$field->id,preg_replace('/\+/', '-',urlencode(strtolower($field->name)))])}}" class="uk-button uk-button-text uk-text-bold">Form Pembayaran</a></p>
			<p class="uk-text-bold">Booked</p>
		<table class="uk-table uk-table-responsive uk-table-divider">
    		<thead>
		        <tr>
		            <th>No</th>
		            <th>Nama</th>
		            <th>Tanggal</th>
		            <th>Dari</th>
		            <th>Sampai</th>
		        </tr>
		    </thead>
		    <tbody>
		        @foreach ($book as $i => $data)
		        <tr>
		            <td>{{ $book->firstItem()+ $i }}</td>
		            <td>{{ $data->nama }}</td>
		            <td>{{ $data->tanggal }}</td>
		            <td>{{ $data->dari }}</td>
		            <td>{{ $data->sampai }}</td>
		        </tr>
		        @endforeach
		    </tbody>
		</table>
		{!!$book->render()!!}
	</div>
</div>
<script type="text/javascript">
            $(document).ready(function() {
            $('#datefield').on('change', function() {
                var tanggal = $(this).val();
                    if(tanggal) {
                    $.ajax({
                        url: '{{url("/tanggal")}}/'+encodeURI(tanggal),
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                        let exclusions = data.map(item=>[item.dari, item.sampai]);
$('#horaInicio').timepicker('remove').timepicker(
          {
          	'disableTimeRanges': exclusions, 
          	'minTime': '08:00am',
    		'maxTime': '11:00pm',
    		'className' : 'uk-select',
    		'timeFormat': 'H:i:s',
          	useSelect: true 
          });

                        }
                    });
                    }
                   });
                });
        </script>
        <script type="text/javascript">
        	   function calc(){
                $('select[name="waktu"]').on('click', function() {
                var x = $(this).val();
            	var y = {{$field->harga}};
            	if(x == 3600){
            	var z = 1 * parseFloat(y);
            	}
            	else if(x == 7200) {
            	var z = 2 * parseFloat(y);            		
            	}
            	else if(x == 10800) {
            	var z = 3 * parseFloat(y);            		
            	}
            	else if(x == 14400) {
            	var z = 4 * parseFloat(y);            		
            	}
            	else if(x == 18000) {
            	var z = 5 * parseFloat(y);            		
            	} 
            	document.getElementById("ttl").value = z;

            });
            }

        </script>
 @if(session()->has('pay'))
    <script type="text/javascript">
    	UIkit.modal.alert("<h3>Thank you for payment, we'll verified your payment.</h3>").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
      	  @if(session()->has('su'))
    <script type="text/javascript">
    	UIkit.modal.alert("Thanks For Booking with our coupon").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
      @if(session()->has('un'))
    <script type="text/javascript">
      UIkit.modal.alert("Your Coupon Not Valid ").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
      @if(session()->has('mem'))
    <script type="text/javascript">
      UIkit.modal.alert("Thanks For Booking And Still with Our").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
      @if(session()->has('au'))
    <script type="text/javascript">
      UIkit.modal.alert("Thanks For booking").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
	  </div>
</div>
<script type="text/javascript">
	var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("min", today);
</script>
    
@endsection