@extends('layout.base')
@section('content')

<div class="float-center">
<form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST">
@csrf
@method('PATCH')

    <div class="form-group">
      <label for="title" class="col-md-4 col-form-label">Title</label>
      <input id="title"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title"
                           value="{{ old('title') ?? $user->profile->title}}"
                           autocomplete="title" autofocus>
    </div>



    <div class="form-group ">
        <label for="details" class="col-md-4 col-form-label">Description</label>

        <input id="details"
                           type="text"
                           class="form-control{{ $errors->has('details') ? ' is-invalid' : '' }}"
                           name="details"
                           value="{{ old('details') ?? $user->profile->details }}"
                           autocomplete="details" autofocus>

        @if ($errors->has('details'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('details') }}</strong>
            </span>
        @endif
    </div>


    <div class="form-group ">
        <label for="url" class="col-md-4 col-form-label">URL</label>

        <input id="url"
               type="text"
               class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
               name="url"
               value="{{ old('url')??$user->profile->url}}"
               autocomplete="url" autofocus>

        @if ($errors->has('url'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="image" class="col-md-4 col-form-label">Profile Image</label>

        <input type="file" class="form-control-file" id="image" name="image">

        @if ($errors->has('image'))
            <strong>{{ $errors->first('image') }}</strong>
        @endif
    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection