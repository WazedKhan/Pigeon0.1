@extends('base')
@section('content')
<div class="content-section">
    <form method="POST">
        @csrf
        <fieldset class="form-group">
            <legend class="border-bottom mb-4">Blog Post</legend>
            {{ form|crispy }}
        </fieldset>
        <div class="form-group">
            <button class="btn btn-outline-info" type="submit">Post</button>
        </div>
    </form>
</div>
@endsection