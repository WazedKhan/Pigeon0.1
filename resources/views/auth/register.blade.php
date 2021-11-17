@extends('layout.base')
@section('content')
<div class="content-section">
    <form action="" method="POST">
        @csrf
        <fieldset class="form-group">
            <legend class="border-bottom mb-4">Join Today</legend>
            
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg">UserName</label>
                <input type="username" id="form3Example3cg" class="form-control form-control-lg" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg">Name</label>
                <input type="name" id="form3Example3cg" class="form-control form-control-lg" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example3cg">Email</label>
                <input type="email" id="form3Example3cg" class="form-control form-control-lg" />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4cg">Password</label>
                <input type="password" id="form3Example4cg" class="form-control form-control-lg" />
              </div>

              <div class="form-outline mb-4">
                <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                <input type="password" id="form3Example4cdg" class="form-control form-control-lg" />
              </div>

            
        </fieldset>
        <div class="form-group">
            <button class="btn btn-outline-info" type="submit">Sign Up</button>
        </div>
    </form>
    <div class="border-top pt-3">
        <small class="text-muted">
            Already Have An Account? <a class="ml-2" href="#">Sign In</a>
        </small>
    </div>
</div>
@endsection