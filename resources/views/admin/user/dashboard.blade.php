@extends('admin.master')
@section('content')
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title text-center">Users</h5>
        <p class="card-text">In previous 
        <form action="{{ route('admin.home') }}" method="get">
          @csrf
          <input type="number" name="search" value="{{ $search }}">
        </form>  
          <h6 class="card-title text-center">days new users are: <strong class="text-primary">{{ $data->count() }}</strong> </h6></p>
  </div>
</div>
@endsection