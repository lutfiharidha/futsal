<!DOCTYPE html>
<html>
<head>
	<title>Atlantic Futsal</title>
	      <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- UIkit CSS -->
<link rel="stylesheet" href="{{asset('css/uikit.min.css')}}" />
<link href="https://fonts.googleapis.com/css?family=Titillium+Web:300" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link rel="stylesheet" href="{{ asset('f/css/froala_editor.pkgd.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('f/css/froala_style.min.css') }}" />
<!-- UIkit JS -->
      <link rel="stylesheet" href="{{ url('css/app.css') }}" />

 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{asset('js/uikit.min.js')}}"></script>
<script src="{{asset('js/uikit-icons.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.8.3.js"></script>
<script type="text/javascript" src="http://jonthornton.github.com/jquery-timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" type="text/css" href="http://jonthornton.github.com/jquery-timepicker/jquery.timepicker.css">
</head>
<body>
	<nav class="uk-background-secondary uk-light" uk-navbar uk-sticky>
		<div class="uk-navbar-left uk-navbar-item uk-margin-medium-left">
        <ul class="uk-navbar-nav">
           <!--  <li>
                <a href="{{route('index')}}">Home</a>
            </li>
            <li>
                <a href="#about" uk-scroll>Profile</a>
            </li>
            <li>
                <a href="#booking">Booking</a>
            </li> -->
        </ul>
    </div>
    <div class="uk-navbar-center">
        <a class="uk-margin-medium-right uk-navbar-item uk-logo" href="#">Atlantic Futsal</a>
	</div>
	    <div class="uk-navbar-right uk-navbar-item uk-margin-medium-right">
        <ul class="uk-navbar-nav">
            <li>
                <a href="{{route('index')}}">Home</a>
            </li>
            <li>
                <a href="#about" uk-scroll>Profile</a>
            </li>
            <li>
                <a href="#booking">Booking</a>
            </li>
            <li>
                <a href="{{route('tour')}}">Tournament</a>
            </li>
            <li>
                <a href="#member" uk-scroll>Member</a>                
            </li>
            <li>
                <a href="#contact" uk-scroll>Contact</a>
            </li>
        </ul>
    </div>
</nav>
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-text-large uk-navbar-center">
        @foreach($best as $b)
        <span class="uk-text-uppercase uk-margin-small-right"> {{$b->name}} </span> from <span class="uk-margin-small-right  uk-margin-small-left uk-text-uppercase">{{$b->club}} </span> is The Best Member<span class="uk-margin-small-left" uk-icon="icon: heart; ratio: 1.5"></span>

        @endforeach
    </div>
</nav>
@yield('content')
<div id="contact" class="uk-background-cover uk-padding" style="background-image: url(https://www.bikramyogabayside.com.au/wp-content/uploads/2016/12/footer-background-img.jpg);">
    <div class="uk-container uk-container-medium uk-child-width-1-3 uk-text-white" uk-grid>
        <div>
        <p class="uk-text-center"><img width="150" height="150" src="http://www.atlanticfutsalva.com/wp-content/uploads/2016/11/afl_logo_200px.png"><br>Jalan Lorem ipsum<br>Lhokseumawe, Aceh - Indonesia<br>Telp/Fax : 000000000<br>info@copany.com</p>
    </div>
    <div>
        <p><h4 class="uk-heading-line uk-text-white"><span>Customer Support</span></h4>
        <ul class="uk-list uk-list-large uk-text-muted">
            <li>Telkomsel: 000000000000</li>
            <li>Smartfren: 000000000000</li>
            <li>Three: 000000000000</li>
            <li>Indosat: 000000000000</li>
        </ul>
    </p>
</div>
<div>
    <p><form method="post" action="{{route('contact')}}">
@csrf
    <div class="uk-margin">
        <div class="uk-form-controls">
            <input class="uk-input" id="form-horizontal-text" name="email" type="text" placeholder="Email">
        </div>
    </div>

        <div class="uk-margin">
        <div class="uk-form-controls">
            <input class="uk-input" id="form-horizontal-text" name="nama" type="text" placeholder="Name">
        </div>
    </div>

 <div class="uk-margin">
            <textarea name="message" class="uk-textarea" rows="5" placeholder="Message"></textarea>
        </div>
    <button class="uk-float-right uk-button uk-button-primary uk-text-white">Send</button>

</form>
    </p>
</div>
    </div>
    @if(session()->has('message'))
    <script type="text/javascript">
      UIkit.modal.alert("Pesan Anda Telah Terkirim ").then(function () {
               console.log('Alert closed.')
               });
    </script>

      @endif
</div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script src="{{ asset('f/js/froala_editor.pkgd.min.js') }}"></script>
   <script> $('#j').froalaEditor({
    height: 300,
    placeholderText: 'Nama Pemain',
    quickInsertButtons: null,
  toolbarButtons: ['formatOL']
});</script></body>
</body>
</html>