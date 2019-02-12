@extends('layouts.app')
@section('content')
<div class="uk-padding uk-container uk-container-medium">
  <span class="uk-text-lead uk-align-right">Kuota {{$limit - $tour->club}}</span>
    <table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
        <tr>
            <th>No</th>
            <th>Club</th>
            <th>Phone</th>
            <th>Province</th>
            <th>Status</th>
            <th>Bukti</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $i => $data)
        <tr>
            <td>{{ $user->firstItem()+ $i }}</td>
            <td><button class="uk-button uk-button-text" type="button" uk-toggle="target: #modal-close-default">{{ $data->club }}</button>
            <div id="modal-close-default" uk-modal>
              <div class="uk-modal-dialog uk-modal-body">
                  <button class="uk-modal-close-default" type="button" uk-close></button>
                  <h2 class="uk-modal-title">Player {{ $data->club }}</h2>
                  <p>{!! $data->pemain !!}</p>
              </div>
            </div>
            </td>
            <td>{{ $data->phone }}</td>
            <td>{{ $data->prov->name }}</td>
            <td>{{ $data->cat->name }}</td>
            <td>@if($data->struk == null)
              Not Found
              @else
              <div uk-lightbox>
                <a class="uk-button uk-button-text" href="http://127.0.0.1:8000/img/struk/{{$data->struk}}" data-caption="{{$data->ref}}">Bukti</a>
            </div>
              @endif </td>
            <form action="{{ route('edit.user', [$data->id,preg_replace('/\+/', '-',urlencode(strtolower($data->tour)))]) }}" method="Post">
              {{ csrf_field() }}
      {{ method_field('PATCH')}}
            <td>
              <div class="uk-form-controls">
                <select class="uk-select" id="form-stacked-select" name="status">
                   @if($data->status == 1)
                    <option value="1">Verified</option>
                    <option value="0">Not Verified</option>
                    @else
                    <option value="0">Not Verified</option>
                    <option value="1">Verified</option>
                    @endif
                </select>
            </div>
            </td>
            <td class="uk-text-center">
              <input type="hidden" name="id" value="{{$data->id}}">
                <input class="uk-button uk-button-text uk-text-primary" type="submit" value="Update">
              </form>
             </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $user->render() !!}
@if(session()->has('message'))
<div class="uk-text-center uk-text-lead" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <h3>Notice</h3>
    <p>{{ session()->get('message') }}</p>
</div>
      @endif  
</div>
@endsection