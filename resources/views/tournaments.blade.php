@extends('layouts.nav')
@section('content')
<div class="uk-padding uk-container uk-container-small">
        @foreach($tournament as $tour)
    <div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin" uk-grid>
        <div class="uk-card-media-left uk-cover-container">
            <img class="uk-position-center" src="http://127.0.0.1:8000/img/tournament/{{$tour->image}}" style="object-fit: contain;" alt="">
            <canvas width="1000" height="300"></canvas>
        </div>
        <div>
            <div class="uk-card-body">
                @if(!$tour->status == 1)
                    <span class="uk-label uk-label-danger uk-text-left uk-align-right">Closed</span>
                  @else
                    <span class="uk-label uk-label-primary uk-text-left uk-align-right">Open</span>
                  @endif
                <p class="uk-text-left">{!!$tour->syarat!!}</p>
                <p class="uk-text-right"><a href="{{route('tour.view',[$tour->id,preg_replace('/\+/', '-',urlencode(strtolower($tour->tournament)))])}}" class="uk-button uk-button-text">More Info </a></p>
            </div>
        </div>
    </div>
    @endforeach
    {!! $tournament->render() !!}
</div>
@endsection