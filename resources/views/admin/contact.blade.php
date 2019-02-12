@extends('layouts.app')
@section('content')
<div class="uk-padding uk-container uk-container-medium">
    <table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Message</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($cont as $user)
        <tr>
            <td>{{ $user->nama }}</td>
            </button>
            <td>{{ $user->email }}</td>
            <td>{!! $user->message !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $cont->render() !!}
@if($errors->any())
<div class="uk-text-center uk-text-lead uk-text-danger" uk-alert>
   <a class="uk-text-danger uk-alert-close" uk-close></a>
   <h3 class="uk-text-danger">Notice</h3>
   {{ implode('', $errors->all(':message')) }}
</div>
@endif
@if(session()->has('message'))
<div class="uk-text-center uk-text-lead" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    <h3>Notice</h3>
    <p>{{ session()->get('message') }}</p>
</div>
      @endif
</div>
@endsection