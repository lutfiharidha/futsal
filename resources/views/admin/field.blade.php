@extends('layouts.app')

@section('content')
<div class="uk-padding uk-container uk-container-medium">
  <a class="uk-button uk-float-right uk-button-text uk-text-primary" href="{{ route('add.field') }}">Tambah Field +</a>
    <table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Image</th>
            <th>Facility</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fields as $i => $data)
        <tr>
            <td>{{ $fields->firstItem()+ $i }}</td>
            <td>{{ $data->name }}</td>
            <td><img src="http://127.0.0.1:8000/img/field/{{$data->image}}" width="100"></td>
            <td>{!! $data->fasilitas !!}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->status }}</td>
            <!-- <td><img class="uk-border-circle" src="https://getuikit.com/docs/images/avatar.jpg" width="85" height="85" alt="Border pill"></td> -->
            <td>
              <a class="uk-button uk-button-text" href="{{ route('data.booking',$data) }}">View</a><br>
                <a class="uk-button uk-button-text uk-text-primary" href="{{ route('edit.field',$data) }}">Update</a>
               <form action="{{ route('field.destroy', $data) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="uk-button uk-button-text uk-text-danger" onclick="return confirm('Are you sure to delete {{$data->name}}?')" > Delete </button>
               </form>
             </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $fields->render() !!}
@if(session()->has('message'))
<div class="uk-text-center uk-text-lead" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <h3>Notice</h3>
    <p>{{ session()->get('message') }}</p>
</div>
      @endif
</div>
@endsection