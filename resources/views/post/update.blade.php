@extends('layout.base')
@section('content')
<form action=" {{ route('post.update', $post->id) }} " method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <div class="form-group">
        <label for="caption" class="col-md-4 col-form-label">Select Audience </label>
        <select class="custom-select" id="postType" name="type">
          <option value="public" selected>Public</option>
          <option value="logged">Logged In</option>
        </select>
          

        @if ($errors->has('type'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('type') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        <label for="caption" class="col-md-4 col-form-label">Caption</label>
        <input id="caption"
                             type="text"
                             class="form-control{{ $errors->has('caption') ? ' is-invalid' : '' }}"
                             name="caption"
                             value="{{ old('caption') ?? $post->caption}}"
                             autocomplete="caption" autofocus>
    </div>

    <div class="form-group">
        <label for="image" class="col-md-4 col-form-label">Post Image</label>
        <input type="file" class="form-control" name="image[]" placeholder="address" multiple>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-primary pt-1 mt-3">Submit</button>
    </div>
</form>
@endsection