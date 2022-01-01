@extends('layout.base')
@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    @foreach ($like_list as $item)
    <div class="d-flex text-muted">
      <div class="col-1">
        {{-- @dd($user->profile->profileImage()) --}}
        <img src="{{$item->profile->profileImage()}}" class="rounded" width="50" height="50" object-fit ="cover">
      </div>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100 m-2 pl-1">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark"> {{$item->name}} </strong>
          <a href="#"> <button class="btn btn-outline-dark"><i class="fas fa-user-plus">Follow</i></button></a>
        </div>
        <span class="d-block">{{$item->username}} </span>
      </div>
    </div>
    @endforeach
</div>
@endsection