@extends('admin.master')
@section('page_name')
    <h1>New User List</h1>
@endsection
@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    @foreach ($data as $item)
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark"> {{$item->name}} </strong>
          <a href="#">Follow</a>
        </div>
        <span class="d-block">{{$item->username}} </span>
      </div>
    </div>
    @endforeach
</div>
@endsection