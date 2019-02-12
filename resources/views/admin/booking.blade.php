@extends('layouts.app')

@section('content')
<div class="uk-padding uk-container uk-container-medium">
  <a class="uk-button uk-float-right uk-button-text uk-text-primary" href="{{ route('add.field') }}">Tambah Field +</a>
    <table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
        <tr>
            <th>No</th>
            <th>No Book</th>
            <th>Nama</th>
            <th>Phone</th>
            <th>Tanggal</th>
            <th>Durasi</th>
            <th>Bukti</th>
            <th>Code</th>
            <th>Total</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($book as $i => $data)
        <tr>
            <td>{{ $book->firstItem()+ $i }}</td>
            <td>{{ $data->no_book }}</td>
            <td>{{ $data->nama }}</td>
            <td>{!! $data->phone !!}</td>
            <td>{{ $data->tanggal }}</td>
            <td>{{ $data->dari }}- {{ $data->sampai }}</td>
         <td>@if($data->struk == null)
              Not Found
              @else
              <div uk-lightbox>
                <a class="uk-button uk-button-text" href="http://127.0.0.1:8000/img/struk/{{$data->struk}}" data-caption="{{$data->ref}}">Bukti</a>
            </div>
              @endif </td>
             <td>
              @if($data->kupon == null)
              -
              @else
              {{$data->kup->code}}
            @endif
          </td>
             <td>{{$data->total}}</td>
             <form action="{{ route('edit.book',$data) }}" method="post">
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
              @if($data->user == null)
               <input type="hidden" name="idu" value="0">
               @else
              <input type="hidden" name="idu" value="0">
               @endif
              <input type="hidden" name="field" value="{{$data->lapangan}}">
                <input class="uk-button uk-button-text uk-text-primary" type="submit" value="Update">
              </form>
             </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $book->render() !!}
@if(session()->has('message'))
<div class="uk-text-center uk-text-lead" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <h3>Notice</h3>
    <p>{{ session()->get('message') }}</p>
</div>
      @endif
</div>
@endsection