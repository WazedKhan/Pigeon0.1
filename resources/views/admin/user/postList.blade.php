@extends('admin.master')
@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    @foreach ($posts as $item)
    <div class="d-flex text-muted pt-3">
      <div class="col-1">
        {{-- @dd($user->profile->profileImage()) --}}
        <img src="/storage/{{ $item->image }}" class="img-responsive img-rounded" width="60" height="90" object-fit ="cover">
      </div>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark"><span>Post Caption: </span> {{$item->caption}} </strong>
          <a href="#">Action</a>
        </div>
        <p class="m-0 m"> <strong>User Name: </strong>{{$item->user->username}}</p>
        <p class="m-0"> <strong>Created At: </strong>{{$item->created_at}} </p>
        <p class="m-0"> <strong>Updated At: </strong>{{$item->user->updated_at}} </p>
        <span class="d-block">{{$item->username}} </span>
      </div>
    </div>
    @endforeach
</div>
@endsection