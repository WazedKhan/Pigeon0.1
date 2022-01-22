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
            <small class="text-muted"> {{$item->updated_at->diffforhumans()}} </small> | </small><span class="badge badge-info text-center">{{$item->emotion}}</span>
          </div>

        </div>
        @if ($item->image == 'Null')
          <div class="card bg-dark text-white">
            <img src="/media/blur.jpg" class="card-img " width="20px" alt="...">
            <div class="card-img-overlay">
              <h5 class="card-title text-center text-lg-center colored">
                <a class="article-title text-center" href=" {{ route('post.detail',$item->id) }} ">{{$item->caption}}</a>
              </h5>
            </div>
          </div>
        @else
        <p><a class="article-title" href=" {{ route('post.detail',$item->id) }} ">{{$item->caption}}</a></p>
        @endif
        {{-- <p class="article-content"> <a href=""></a> </strong></p> --}}
        @if ($item->image != 'Null')
        @foreach (explode('|', $item->image) as $image)
        <div class="m-1">
            <img src="{{ URL::to('/storage/media/posts/'.$image)}}" class="img-fluid" alt="Responsive image">
        </div>
        @endforeach
        @endif
        <div class="row pl-3">
          <a href="#"> {{$item->liked->count()}} 💖</a>
        </div>
        <hr>



  <div class="d-flex justify-content-around">
    <a class="btn btn-outline-info float-left align-self-center" href="{{ route('post.like', $item->id) }}" role="button">
      <i class="far fa-heart"> Like</i>
    </a>
    <a class="btn btn-outline-secondary float-right align-self-center" href="{{ route('post.comment', $item->id) }}" role="button">
      <i class="far fa-comment-alt"> Comment </i>
    </a>
  </div>
</div>
</article>

@endforeach
@endsection
@section('sidebar')
    @include('layout.sidebar')
@endsection
