@extends('layout.base')
@section('content')
@if(session()->has('Block'))
  <p class="alert alert-danger">
      {{session()->get('Block')}}
  </p>
@endif
<form action="{{route("signin")}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      <small id="emailHelp" class="form-text text-muted"><a href="{{ url('/reset/Password') }}">Forgot Password</a></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="hidden" name="_token" value="{{Session::token()}}">
  </form>
  <div class=" pt-3">
    <small class="text-muted">
        Need An Account? <a class="ml-2" href="{{route('register')}}">Register</a>
    </small>
</div>
@endsection
