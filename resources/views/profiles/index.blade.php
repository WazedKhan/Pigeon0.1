@extends('layout.base')

@section('content')

<div class="row">
    <div class="col-5">
        <div class="col-1">
            <img src="/media/photo.jpg" class="rounded-circle" width="250" height="250" object-fit ="cover">
        </div>
    </div>
    <div class="col-7 pt-5">
        <div><h2> {{$user->username}} </h2></div>
        <div class="d-flex">
            <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
            <div class="pr-5"><strong>15</strong> followers</div>
            <div class="pr-5"><strong>98</strong> following</div>
        </div>
        <div class="pt-4"><b> {{ $user->profile->title }} </b></div>
        <div> {{ $user->profile->details }} </div>
        <div><a href="">{{ $user->profile->url }}</a></div>
    </div>
</div>

<div class="container">

</div>

<div class="pt-5">
    @foreach ($user->posts as $item)

    <article class="media content-section">
        <img class="rounded-circle article-img" src="/media/photo.jpg">
        <div class="media-body">
          <div class="article-metadata">
            <a class="mr-2" href="#">{{ $user->username }}</a>
            <small class="text-muted">{{$item->updated_at->format('d/m/y')}}</small>
          </div>
          <p class="article-content">{{ $item->caption }}</p>
          <div>
            <img src="/storage/{{ $item->image }}" class="img-fluid" alt="Responsive image">
          </div>
        </div>
    </article>

    @endforeach
</div>


@section('sidebar')
    @include('layout.sidebar')
@endsection
@endsection