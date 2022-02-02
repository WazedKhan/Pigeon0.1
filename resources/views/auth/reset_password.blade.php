@extends('layout.base')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <form action="{{ route('reset.password') }}" method="POST">
          @csrf
          <fieldset >
            <div class="form-group">
              <label for="disabledTextInput">Email</label>
              <input type="email" value="{{ $mail }}" name="mail" class="form-control" placeholder="Enter email">
            </div>
          </fieldset>
          <div class="form-group">
            <label for="exampleInputPassword1">New password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Retype new password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
            <button type="submit" class="btn btn-primary">Sent</button>
          </form>
    </div>
  </div>
@endsection