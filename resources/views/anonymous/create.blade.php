@extends('layout.base')
@section('content')
<form action=" {{ route('anonymous.store') }} " method="POST">
    @csrf
    <div class="row">
        <div class="col-12">

            <div class="row">
                <h1>Add Anonymous</h1>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label">Post Title</label>
                <input id="title" type="text" class="form-control" name="title" >
            </div>

            <div class="row">
                <label for="details" class="col-md-4 col-form-label">Post Details</label>
                <input id="details" type="text" class="form-control" name="details" >

            <div class="row pt-4">
                <button class="btn btn-primary">Add New Post</button>
            </div>

        </div>
    </div>
</form>
@endsection