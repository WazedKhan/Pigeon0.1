@extends('layout.base')
@section('content')
@if (session()->has('success'))
    {{session()->get('sucesss')}}
@endif
@foreach ($post as $item)

  <article class="media content-section">
      <div class="media-body">
        <div class="article-metadata">
          <a class="mr-2" href="{{ route('profile.show',$item->user->id) }}"> {{$item->user->name}} </a>
          <div>
            <small class="text-muted"> {{$item->updated_at->format('d-m-y')}} </small>
          </div>

        </div>
        <p><a class="article-title" href=" {{ route('post.detail',$item->id) }} ">{{$item->caption}}</a></p>

        {{-- <p class="article-content"> <a href=""></a> </strong></p> --}}

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