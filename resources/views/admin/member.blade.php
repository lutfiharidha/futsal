@extends('layouts.app')
@section('content')
<div class="uk-padding uk-container uk-container-medium">
  <a class="uk-button uk-float-right uk-button-text uk-text-primary" href="{{ route('add.member') }}">Tambah Member +</a>
    <table class="uk-table uk-table-responsive uk-table-divider">
    <thead>
        <tr>
            <th>No</th>
            <th>Id</th>
            <th>Nama Member</th>
            <th>Email</th>
            <th>Telpon</th>
            <th>Pemesanan</th>
            <th>Coupont</th>
            <th>Pendaftaran</th>
            <th>Action</th>
        </tr> 
    </thead>
    <tbody>
        @foreach ($member as $i => $user)
        <tr>
            <td>{{ $member->firstItem()+ $i }}</td>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            </button>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->pemesanan }}</td>
             @if($user->code == 1)
               <td><form action="{{ route('add.coupon',$user->id) }}" method="POST">
                  {{ csrf_field() }}
                        {{ method_field('PATCH')}}
                        <div class="uk-form-controls">
                <select class="uk-select" id="form-stacked-select" name="code">
                    <option>Add Coupon</option>
                    @foreach($cup as $c)
                    <option value="{{$c->id}}">{{$c->code}}</option>
                    @endforeach
                </select>
            </div>
                  <input type="submit" class="uk-button uk-button-primary uk-button-small" value="Add Coupon">
                  </form></td>
              @else
                  @if($user->cup->batas <= 0)
                  <td>{{ date('M', strtotime('+30 days')) }}</td>
                  @else
                  <td>{{ $user->cup->code }}</td>
                  @endif
            @endif
            <td>{{ $user->pemesanan }}</td>
            <td>{{ $user->created_at->format('d-m-Y') }}</td>
            <td>
                <a class="uk-button uk-button-text uk-text-primary" href="{{ route('update.member',$user) }}">Update</a>
               <form action="{{ route('member.destroy', $user) }}" method="post">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button class="uk-button uk-button-text uk-text-danger" onclick="return confirm('Are you sure to delete {{$user->name}}?')" > Delete </button>
               </form>
             </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $member->render() !!}
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