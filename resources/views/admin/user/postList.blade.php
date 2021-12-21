@extends('admin.master')
@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    {{-- @foreach ($data as $item) --}}
    <div class="d-flex text-muted pt-3">
      <div class="col-1">
        {{-- @dd($user->profile->profileImage()) --}}
        {{-- <img src="{{$item->profile->profileImage()}}" class="rounded-circle" width="50" height="50" object-fit ="cover"> --}}
      </div>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          {{-- <strong class="text-gray-dark"> {{$item->name}} </strong> --}}
          <a href="#">Edit</a>
        </div>
        <span class="d-block">{{$item->username}} </span>
      </div>
    </div>
    {{-- @endforeach --}}
</div>
@endsection