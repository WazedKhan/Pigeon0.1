@extends('layout.base')
@section('content')
@foreach ($user as $item)

<div class="row g-0 bg-light position-relative">
    <div class="col-md-6 mb-md-0 p-md-4">
      <img src="{{ $item->profile->profileImage()}}" class="w-100" alt="...">
    </div>
    <div class="col-md-6 p-4 ps-md-0">
      <h5 class="mt-0"> {{$item->name}} </h5>
      <p> {{$item->profile->details }} </p>
      <a href=" {{route('profile.show', $item->id)}} " class="stretched-link">Visit Profile</a>
    </div>
</div>
@endforeach

@endsection

@section('sidebar')
    @include('layout.sidebar')
@endsection