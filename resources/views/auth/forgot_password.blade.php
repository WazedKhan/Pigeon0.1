@extends('layout.base')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <form action="{{ route('send.mail') }}" method="POST">
          @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="mail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">Enter your mail address.</small>
            </div>
            <button type="submit" class="btn btn-primary">Sent</button>
          </form>
    </div>
  </div>
@endsection