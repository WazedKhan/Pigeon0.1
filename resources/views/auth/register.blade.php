@extends('layout.base')
@section('content')
<div class="content-section">
    <form action=" {{route('create.user')}} " method="POST">
        @csrf
        <fieldset class="form-group">
            <legend class="border-bottom mb-4">Join Today</legend>
            
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg">UserName</label>
                <input name="username" type="username" id="form3Example3cg" class="form-control form-control-lg" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg">Name</label>
                <input name="name"type="name" id="form3Example3cg" class="form-control form-control-lg" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg">Email</label>
                <input name="email" type="email" id="form3Example3cg" class="form-control form-control-lg" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4cg">Password</label>
                <input name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                <input type="password" id="form3Example4cdg" class="form-control form-control-lg" />
              </div>

            
        </fieldset>
        <div class="form-group">
            <button class="btn btn-outline-info" type="submit">Sign Up</button>
            <input type="hidden" name="_token" value="{{Session::token()}}">
        </div>
    </form>
    <div class="border-top pt-3">
        <small class="text-muted">
            Already Have An Account? <a class="ml-2" href="{{route('login')}}">Sign In</a>
        </small>
    </div>
</div>
@endsection