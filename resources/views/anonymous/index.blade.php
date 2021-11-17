@extends('layout.base')
@section('content')
<div class="card bg-dark text-white">
  <img class="card-img" src="/media/ano.jpg" alt="Card image">
  <div class="card-img-overlay">
  </div>
  <div class="alert alert-danger" role="alert">
    <center>The Chances of this post are correct is less than 20% so don't deliver it without your own research, please.</center>
  </div>
</div>
<div class="d-flex justify-content-between align-items-baseline">
    <a href=" {{ route('anonymous.create') }} " type="button">Add New Post</a>
</div>
@foreach ($data as $item)
<article class="media content-section">
    <img class="rounded-circle article-img" src="/media/anon.png">
    <div class="media-body">
      <div class="article-metadata">
        <a class="mr-2" href="#"> Anonymous </a>
        <small class="text-muted"> {{ $item->updated_at }} </small>
      </div>
      <h2><a class="article-title" href="#"> {{ $item->title }} </a></h2>
      <p class="article-content"> {{ $item->details }} </p>
    </div>
</article>
@endforeach
@endsection
@section('sidebar')
<div class="card" style="width: 18rem;">
  <img src="/media/pigeon.jpg" class="card-img-top" alt="pigeon">
  <div class="card-body">
    <h5 class="card-title">Pigeon</h5>
    <p class="card-text">Pigeon is a secure social networking platform. We care about your privacy.</p>
    <a href="#" class="btn btn-primary">Join Now</a>
  </div>
</div>

@endsection