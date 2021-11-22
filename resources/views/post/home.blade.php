@extends('layout.base')
@section('content')
@foreach ($post as $item)

  <article class="media content-section">
      <div class="media-body">
        <div class="article-metadata">
          <a class="mr-2" href="#"> {{$item->user->name}} </a>
          <div>
            <small class="text-muted"> {{$item->updated_at->format('d-m-y')}} </small>
          </div>

        </div>
        <p class="article-content"> <strong>{{$item->caption}}</strong></p>
        <div>
          <img src="/storage/{{ $item->image }}" class="img-fluid" alt="Responsive image">
        </div>
      </div>
  </article>

@endforeach
@endsection
@section('sidebar')
    @include('layout.sidebar')
@endsection