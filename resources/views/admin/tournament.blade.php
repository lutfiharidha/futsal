@extends('layouts.app')

@section('content')
<div class="uk-padding uk-container uk-container-medium">
  <a class="uk-button uk-float-right uk-button-text uk-text-primary" href="{{ route('add.tournament') }}">Tambah Tournament +</a>
    <table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
        <tr>
            <th>No</th>
            <th>Tournament</th>
            <th>Image</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tournament as $i => $data)
        <tr>
            <td>{{ $tournament->firstItem()+ $i }}</td>
            <td>{{ $data->tournament }}</td>
            <td><img src="http://127.0.0.1:8000/img/tournament/{{$data->image}}" width="100"></td>
            <td>
              @if(!$data->status == 1)
                Closed
              @else
                Opened
              @endif
            </td>
            <td class="uk-text-center">
              <a class="uk-button uk-button-text" href="{{ route('view.tour',[$data->id,preg_replace('/\+/', '-',urlencode(strtolower($data->tournament)))]) }}">View </a> <br>
                <a class="uk-button uk-button-text uk-text-primary" href="{{ route('update.tour',$data) }}">Update</a> 
               <form action="{{ route('destroy.tour', $data) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="uk-button uk-button-text uk-text-danger" onclick="return confirm('Are you sure to delete {{$data->tournament}}?')" > Delete </button>
               </form>
             </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $tournament->render() !!}
@if(session()->has('message'))
<div class="uk-text-center uk-text-lead" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <h3>Notice</h3>
    <p>{{ session()->get('message') }}</p>
</div>
      @endif
</div>
@endsection