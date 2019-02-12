@extends('layouts.nav')
@section('content')
<div class="uk-position-relative uk-visible-toggle uk-light"  uk-slideshow="ratio: 10:4; animation: scale; autoplay:true">

            <ul class="uk-slideshow-items">
                <li class="uk-animation-reverse" uk-scrollspy="cls: uk-animation-kenburns;">
                    <img src="{{asset('img/sliders/1.jpg')}}" alt="" uk-cover>
                     <div class="uk-overlay uk-overlay-primary uk-position-center uk-position-small uk-text-center uk-light">
                <h2 class="uk-margin-remove">Center</h2>
                <p class="uk-margin-remove">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
                </li>
                <li class="uk-animation-reverse" uk-scrollspy="cls: uk-animation-kenburns;">
                    <img src="{{asset('img/sliders/2.jpg')}}" alt="" uk-cover>
                    <div class="uk-overlay uk-overlay-primary uk-position-center uk-position-small uk-text-center uk-light">
                <h2 class="uk-margin-remove">Center</h2>
                <p class="uk-margin-remove">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
                </li>
                <li class="uk-animation-reverse" uk-scrollspy="cls: uk-animation-kenburns;">
                    <img src="{{asset('img/sliders/3.jpg')}}" alt="" uk-cover>
                    <div class="uk-overlay uk-overlay-primary uk-position-center uk-position-small uk-text-center uk-light">
                <h2 class="uk-margin-remove">Center</h2>
                <p class="uk-margin-remove">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
                </li>
            </ul>

            <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
            <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

        </div>
        <h1 id="about" class="uk-heading-line uk-text-center uk-margin-medium-top uk-padding"><span>About</span></h1>
        <div  class="uk-container uk-margin-small-top uk-padding uk-container-medium uk-column-1-2@l uk-padding">
            <p><img width="300" class="uk-margin-top uk-align-center" src="http://www.atlanticfutsalva.com/wp-content/uploads/2016/11/afl_logo_200px.png"></p>
            <p class="uk-text-justify">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
<div class="uk-background-fixed uk-blend-darken uk-background-cover uk-margin-medium-top uk-light" style="background-image: url(https://cdn.shopify.com/s/files/1/2658/1334/products/HJ09173_1024x1024.jpg?v=1532349032);">
    <div class="uk-padding uk-child-width-1-3@m" uk-grid>
    <div>
    <p class="uk-text-large uk-text-center"><span uk-icon="icon: heart; ratio: 5.5"></span><br>Love Our Customer</p>
    </div>
    <div>
    <p class="uk-text-large uk-text-center"><span uk-icon="icon: git-branch; ratio: 5.5"></span><br>Perfect Branch</p>
</div>
<div>
    <p class="uk-text-large uk-text-center"><span uk-icon="icon: world; ratio: 5.5"></span><br>International</p>
</div>
</div>
    <h2 class="uk-text-center">Suported By</h2>
    <div class="uk-padding uk-child-width-1-5@m" uk-grid>
        <div>
            <img src="https://discordemoji.com/assets/emoji/nike.png">
        </div>
        <div><img src="http://www.radiostudent.hr/wp-content/uploads/2016/04/fifa.png"></div>
        <div><img src="img/logo.png"></div>
        <div><img class="uk-margin-medium-top" src="img/tournament/shopee.png"></div>
        <div><img class="uk-margin-remove" src="https://www.axiselitevb.com/wp-content/uploads/2017/07/header-logo-mobile.png"></div>
    </div>
</div>
<div id="booking"  class="uk-padding uk-margin-medium-top">
	    <h1 class="uk-heading-line"><span>Booking Package</h1>
<div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
    @foreach($fields as $field)
    <div>
        <div class="uk-card uk-card-secondary uk-card-body">
            <h3 class="uk-card-title">{{$field->name}} <span class="uk-label">Rp {{$field->harga}}/Jam</span></h3>
            <p>{!!$field->fasilitas!!}</p>
            <p><a class="uk-button uk-button-primary uk-text-center uk-margin-top" href="{{route('book', [$field->id,preg_replace('/\+/', '-',urlencode(strtolower($field->name)))])}}">Booking</a></p>
        </div>
    </div>
    @endforeach
</div>

</div>
<div id="tournament" class=" uk-margin-medium-top uk-background-cover uk-padding" style="background-image: url(http://ditrudaonguyen.com/wp-content/uploads/2015/01/dse-creative-background-company-logo-design_1-01.png);">
    <h1 class="uk-heading-line"><span>Tournament</h1>
    <div class="uk-container uk-container-small ">
        @foreach($tournament as $tour)
        <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
    <div class="uk-card-media-left uk-cover-container">
        <img class="uk-position-center" src="img/tournament/{{$tour->image}}" style="object-fit: contain;" alt="">
        <canvas width="1000" height="300"></canvas>
    </div>
    <div>
        <div class="uk-card-body">
            @if(!$tour->status == 1)
                <span class="uk-label uk-label-danger uk-text-left uk-align-right">Closed</span>
              @else
                <span class="uk-label uk-label-primary uk-text-left uk-align-right">Open</span>
              @endif
              <p class="uk-text-bold uk-text-lead">{{$tour->tournament}}</p>
            <p class="uk-text-left">{!!$tour->syarat!!}</p>
            <p class="uk-text-right"><a href="{{route('tour.view',[$tour->id,preg_replace('/\+/', '-',urlencode(strtolower($tour->tournament)))])}}" class="uk-button uk-button-text">More Info </a></p>
        </div>
    </div>
</div>
@endforeach
@if($tour->count() > 2 )
<a href="{{route('tour')}}" class="uk-align-center uk-button uk-button-secondary">MORE</a>
@endif
<!-- 
<div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
    <div class="uk-card-media-left uk-cover-container">
        <img src="http://www.bluepad.es/wp-content/uploads/2017/09/costablancacup.jpg" alt="" uk-cover>
        <canvas width="750" height="400"></canvas>
    </div>
    <div>
        <div class="uk-card-body">
        	<span class="uk-label uk-label-danger uk-text-left uk-align-right">Closed</span>
            <p class="uk-text-left">- KTP<br> - Open<br> - Registrasi 150<br>- Pas Foto 3x4</p>
            <p class="uk-text-right"><a class="uk-button uk-button-text">More Info </a></p>
        </div>
    </div>
</div> -->
        </div>
    </div>
    
<h1 class="uk-heading-line uk-text-center uk-margin-medium-top uk-padding"><span>Our Testimonials</span></h1>

<div class="uk-background-fixed uk-position-relative uk-visible-toggle uk-light" uk-slideshow="ratio: 9:3;animation: push" style="background-image: url(https://www.chan-naylor.com.au/wp-content/uploads/2017/12/allher-testimonial-background.jpg);">

    <ul class="uk-slideshow-items">
        @foreach($testi as $t)
        <li>
         <div class="uk-position-center uk-text-center">
            <div class="testi uk-align-center">
            <img  uk-slideshow-parallax="y: -50,0,0; opacity: 1,1,0" src="/img/testi/{{$t->image}}" alt="{{$t->nama}}">
            </div>
            <p class="uk-text-capitalize uk-text-large" uk-slideshow-parallax="y: 0,0,0; opacity: 1,1,0">{{$t->nama}}</p>
            <p uk-slideshow-parallax="y: 50,0,0; opacity: 1,1,0">{!!$t->description!!}</p>
         </div>
      </li>
        @endforeach
    </ul>

    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

</div>
<div id="member" class="uk-container uk-container-medium uk-margin-medium-top uk-text-center uk-padding">
<h1 class="uk-heading-line uk-text-right"><span>Our Member</span></h1>
<div class="uk-child-width-1-3@m" uk-grid uk-lightbox="animation: fade">
    <!-- <div class="uk-inline-clip uk-transition-toggle uk-light" tabindex="0">        
        <a class="uk-inline" href="https://inggit22.files.wordpress.com/2013/07/rgb-logo.png" data-caption="STKIP BERAU FC">
             <div class="uk-position-center">
                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
            </div>
            <img width="150" height="150" src="https://inggit22.files.wordpress.com/2013/07/rgb-logo.png" alt="">
        </a>
    </div> -->
    @foreach($user as $u)
    <div class="uk-inline-clip uk-transition-toggle uk-light" tabindex="0">        
        <a class="uk-inline" href="http://127.0.0.1:8000/img/club/{{$u->image}}" data-caption="{{$u->club}}">
            <div class="uk-position-center">
                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
            </div>
            <img width="150" height="150" src="http://127.0.0.1:8000/img/club/{{$u->image}}" alt="{{$u->club}}">
        </a>
    </div>
    @endforeach
    <!-- <div class="uk-inline-clip uk-transition-toggle uk-light" tabindex="0">        
        <a class="uk-inline" href="http://3.bp.blogspot.com/-EVHtev6JxFE/Uo2h3O129CI/AAAAAAAAAD0/iQjV4M7PLL8/s1600/Logo+Futsal.jpg" data-caption="Caption 3">
             <div class="uk-position-center">
                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
            </div>
            <img width="150" height="150" src="http://3.bp.blogspot.com/-EVHtev6JxFE/Uo2h3O129CI/AAAAAAAAAD0/iQjV4M7PLL8/s1600/Logo+Futsal.jpg" alt="">
        </a>
    </div>
    <div class="uk-inline-clip uk-transition-toggle uk-light" tabindex="0">        
        <a class="uk-inline" href="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/4026ff28128443.5637010b477fb.png" data-caption="Caption 4">
             <div class="uk-position-center">
                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
            </div>
            <img width="250" height="250" src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/4026ff28128443.5637010b477fb.png" alt="">
        </a>
    </div>
    <div class="uk-inline-clip uk-transition-toggle uk-light" tabindex="0">        
        <a class="uk-inline" href="https://maulanayusufkidal.files.wordpress.com/2014/03/downl1oadfile.jpg" data-caption="Caption 5">
             <div class="uk-position-center">
                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
            </div>
            <img width="250" height="250" src="https://maulanayusufkidal.files.wordpress.com/2014/03/downl1oadfile.jpg" alt="">
        </a>
    </div>
    <div class="uk-inline-clip uk-transition-toggle uk-light" tabindex="0">        
        <a class="uk-inline" href="https://upload.wikimedia.org/wikipedia/de/6/6c/NSC-Minnesota-Stars-Logo.png" data-caption="Caption 6">
             <div class="uk-position-center">
                <span class="uk-transition-fade" uk-icon="icon: plus; ratio: 2"></span>
            </div>
            <img width="150" height="150" src="https://upload.wikimedia.org/wikipedia/de/6/6c/NSC-Minnesota-Stars-Logo.png" alt="">
        </a>
    </div> -->
<!--     <button class="uk-align-center uk-button uk-button-default">See More >></button>
 --></div>

</div>
@endsection