@extends('base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="/svg/freeCodeCampLogo.svg" class="rounded-circle">
        </div>
        <div class="col-9 pt-5">
            <div><h2>Username</h2></div>
            <div class="d-flex">
                <div class="pr-5"><strong>0</strong> posts</div>
                <div class="pr-5"><strong>15</strong> followers</div>
                <div class="pr-5"><strong>98</strong> following</div>
            </div>
            <div class="pt-4"><b> Name </b></div>
            <div> Description </div>
            <div><a href="#"> link </a></div>
        </div>
    </div>
    <div class="pt-5">
        <article class="media content-section">
            <img class="rounded-circle article-img" src="#">
            <div class="media-body">
              <div class="article-metadata">
                <a class="mr-2" href="#">UserName</a>
                <small class="text-muted">Date</small>
              </div>
              <h2><a class="article-title" href="#">Title</a></h2>
              <p class="article-content">Description</p>
            </div>
        </article>
    </div>

</div>
@section('sidebar')
    @include('layout.sidebar')
@endsection
@endsection