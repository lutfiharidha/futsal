@extends('layouts.app')

@section('content')
<div class="uk-padding uk-container uk-container-medium">
  <a class="uk-button uk-float-right uk-button-text uk-text-primary" href="{{ route('add.testi') }}">Tambah Testimonials +</a>
    <table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Image</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($testi as $i => $data)
        <tr>
            <td>{{ $testi->firstItem()+ $i }}</td>
            <td>{{ $data->nama }}</td>
            <td><img class="image-cropper" src="http://127.0.0.1:8000/img/testi/{{$data->image}}" ></td>
            <td>{!! $data->description !!}</td>
            <td>
              @if(!$data->status == 1)
                Not Publish
              @else
                Publish
              @endif
            </td>
            <td class="uk-text-center">
                <a class="uk-button uk-button-text uk-text-primary" href="{{ route('update.testi',$data) }}">Update</a> 
               <form action="{{ route('destroy.tour', $data) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="uk-button uk-button-text uk-text-danger" onclick="return confirm('Are you sure to delete {{$data->nama}}?')" > Delete </button>
               </form>
             </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $testi->render() !!}
@if(session()->has('message'))
<div class="uk-text-center uk-text-lead" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <h3>Notice</h3>
    <p>{{ session()->get('message') }}</p>
</div>
      @endif

</div>
@endsection