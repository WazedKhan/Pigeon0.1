@extends('layout.base')
@section('content')
<div class="row row-cols-1">
<div class="card mb-3">
  <img class="card-img-top border border-light" src="{{ url('/storage/'.$group->image) }}" width="100" height="150">
  <div class="card-body">
    <h5 class="card-title">{{ $group->name }}</h5>
    @if(!$group->group_member->contains('user_id',Auth::user()->id) && Auth::user()->id != $group->user_id)
    <p class="card-text float-right">
      <a class="btn btn-outline-info " href="{{ route('groups.join',$group->id) }}">Join</a>
    </p>
    @endif
    <p class="card-text"> <i class="fas fa-globe-asia"></i>
       {{ $group->privacy }} group . 
       {{ $group->group_member->count() }} members
    </p>

    <hr>
    <p class="card-text">{{ $group->about }}</p>
  </div>
</div>
</div>




@if($group->group_member->contains('user_id',Auth::user()->id) || Auth::user()->id == $group->user_id)
  <button type="button" class="alert alert-secondary form-control" data-toggle="modal" data-target="#exampleModalCenter">
          <input class="form-control rounded-pill" placeholder="Write something...">
          <hr>
  </button> 
@endif

@foreach ($post as $item)

  <article class="media content-section">
      <div class="media-body">
        <div class="article-metadata">
        <img class="rounded article-img" src="{{ url('/storage/'.$group->image) }}">
        <strong>{{ $group->name }} </strong> <i class="fas fa-caret-right"></i> 
          <a class="mr-2" href="{{ route('profile.show',$item->user->id) }}"> 
          @if ($item->user->id == $group->user_id)
            Admin  
          @else
            {{$item->user->name}}
          @endif
          </a>
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
          <a href="{{route('post.likers',$item->id)}}"> {{$item->liked->count()}} 💖</a>| 💬 {{$item->commnet->count()}}
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


<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center"> Create Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('create.post.group',$group_id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-check">
              <input type="checkbox" class="form-check-input" name="emotion" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Detect Emotion</label>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Caption</label>
              <input type="text" name="caption" class="form-control">
            </div>

            <label class="form-label" for="customFile">Image</label>
            <input type="file" class="form-control"  name="image[]" placeholder="address" multiple />

            <div class="form-controll m-1">
              <button class="form-controll btn badge-primary" type="submit">Post</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>


@endsection

@section('sidebar')
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-action active">Active item</button>
      <button type="button" class="list-group-item list-group-item-action">Item</button>
      <button type="button" class="list-group-item list-group-item-action disabled">Disabled item</button>
    </div>
@endsection