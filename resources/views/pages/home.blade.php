@extends('base')
@section('content')
<article class="media content-section">
    <div class="media-body">
      <div class="article-metadata">
        <a class="mr-2" href="#"> {{$user->name}} </a>
        <small class="text-muted">Posted Date</small>
      </div>
      <h2><a class="article-title" href="#">Post Title</a></h2>
      <p class="article-content">Post Content</p>
    </div>
</article>
@endsection
@section('sidebar')
    @include('layout.sidebar')
@endsection