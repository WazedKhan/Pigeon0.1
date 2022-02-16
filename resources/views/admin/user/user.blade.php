@extends('admin.master')
@section('page_name')
<h1 class="text-center text-info">Users({{ $data->count() }})</h1>
@endsection
@section('content')
  @if(session()->has('notice'))
          <p class="alert alert-success">
              {{session()->get('notice')}}
          </p>
  @endif
<div class="my-3 p-3 bg-body rounded shadow-sm">
    @foreach ($data as $item)
    <div class="d-flex text-muted pt-3">
      <div class="col-1">
        <img src="{{$item->profile->profileImage()}}" class="rounded-circle" width="50" height="50" object-fit ="cover">
        
      </div>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark"> {{$item->name}} </strong>

          <form action=" {{route('admin.user.changeStatus', $item->id)}} ", method="POST">
            @csrf
            @method('PATCH')
            @if ($item->status == 'active')
              <button class="btn btn-danger" type="submit" name="status" value="block"><i class="fas fa-user-lock"> Block </i></button>
            @else
              <button type="submit" name="status" value="active"><i class="fas fa-user-check"></i> Unblock </i></button>
            @endif
          </form>
        </div>
        <span class="d-block">{{$item->username}} </span>
      </div>
    </div>
    @endforeach
</div>
@endsection
