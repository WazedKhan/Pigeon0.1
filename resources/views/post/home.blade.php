@extends('layout.base')
@section('content')
@if (session()->has('success'))
    {{session()->get('sucesss')}}
@endif
@foreach ($post as $item)

  <article class="media content-section">
      <div class="media-body">
        <div class="article-metadata">
        
        @if ($item->group_id)
          <img class="rounded article-img" src="{{ url('/storage/'.$item->group->image) }}">
          <a href="{{ route('home.group',$item->group->id) }}"> <strong>{{$item->group->name}}</strong></a>
          <i class="fas fa-caret-right"></i>
        @else
          <img class="rounded-circle article-img" src={{$item->user->profile->profileImage()}}>
        @endif
          <a class="mr-2" href="{{ route('profile.show',$item->user->id) }}"> {{$item->user->name}} </a>
          @if ($item->share_id)
          <p><i class="fas fa-caret-right"></i> shared from 
          <a href="{{ route('profile.show',$item->share->post->user->id) }}">{{ $item->share->post->user->name }}</a>
          </p>
          @endif
          <div>
            <small class="text-muted"> {{$item->updated_at->diffforhumans()}} </small> | </small><span class="badge badge-info text-center">{{$item->emotion}}</span>
          </div>
        </div>
        @if ($item->post_image == '[]')
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
        @if ($item->post_image != '[]')
        @foreach ($item->post_image as $image)
        <div id="myDiv">
            <img src="{{ URL::to('/storage/'.$image->image) }}" class="img-fluid" alt="Responsive image">
        </div> 
        @endforeach
        @endif
        <div class="row pl-3">
          <a href="{{route('post.likers',$item->id)}}"> {{$item->liked->count()}} ????</a>| ???? {{$item->commnet->count()}} | {{ $item->shared->count() }} Share
        </div>
        <hr>



  <div class="d-flex justify-content-around">
    <a class="btn btn-outline-info float-left align-self-center" href="{{ route('post.like', $item->id) }}" role="button">
      <i class="far fa-heart"> Like</i>
    </a>
    <a class="btn btn-outline-secondary float-right align-self-center" href="{{ route('post.share', $item->id) }}" role="button">
      <i class="fas fa-share"></i> Share
    </a>
    <a class="btn btn-outline-secondary float-right align-self-center" href="{{ route('post.comment', $item->id) }}" role="button">
      <i class="far fa-comment-alt"> Comment </i>
    </a>
    <a class="btn btn-outline-secondary float-right align-self-center" href="{{ route('post.detail',$item->id) }}" role="button">
      <i class="far fa-flag"> Report </i>
    </a>
  </div>
</div>

</article>

@endforeach
@endsection
@section('sidebar')
    @include('layout.sidebar')
@endsection
