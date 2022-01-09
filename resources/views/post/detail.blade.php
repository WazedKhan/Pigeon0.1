@extends('layout.base')
@section('content')
<article class="media content-section">
  <div class="media-body">
    @if ($post->image == 'Null')
          <div class="card bg-dark text-white">
            <img src="/media/blur.jpg" class="card-img " width="20px" alt="...">
            <div class="card-img-overlay">
              <h5 class="card-title text-center text-lg-center colored">
                <a class="article-title text-center" href=" {{ route('post.detail',$post->id) }} ">{{$post->caption}}</a>
              </h5>
            </div>
          </div>
        @else
        <p><a class="article-title" href=" {{ route('post.detail',$post->id) }} ">{{$post->caption}}</a></p>
        @endif
        {{-- <p class="article-content"> <a href=""></a> </strong></p> --}}
        @if ($post->image != 'Null')
          <div>
            <img src="/storage/{{ $post->image }}" class="img-fluid" alt="Responsive image">
          </div>
        @endif
  </div>
</article>
@endsection

@section('sidebar')

<div class="media-body">
  <div class="article-metadata">
    <img src=" {{$post->user->profile->profileImage()}} " class="rounded-circle" width="60" height="60" alt="Profile Image">
    <a class="mr-2 " href="{{ route('profile.show',$post->user->profile->id) }}"> <h3>{{$post->user->name}}</h3> </a>
    <small class="text-muted float-right "> {{$post->updated_at->format('d-m-y')}} </small> <span class="badge badge-primary"> Feeling {{$post->emotion}}</span>
    @if (Auth::user()->id == $post->user->id)      
      <a href=" {{ route('post.updateView', $post->id) }} " class="badge badge-dark">Edit</a>
      <a href=" {{ route('post.delete', $post->id) }} " class="badge badge-danger">Delete</a>    
    @endif
    <div class="row pl-">
      <a href="{{route('post.likers',$post->id)}}"> {{$post->liked->count()}} 💖</a> |       
      <a href="http://"> 💬{{$comments->count()}} Comments </a> 
    </div>
  </div>

  <div class="d-flex justify-content-around">
    <a class="btn btn-outline-info float-left align-self-center" href="{{ route('post.like', $post->id) }}" role="button">
      <i class="far fa-heart"> Like</i>
    </a>

    <a class="btn btn-outline-secondary float-right align-self-center" href="{{ route('post.comment', $post->id) }}" role="button">
      <i class="far fa-comment-alt"> Comment </i>
    </a>
  </div>
  @foreach ($comments as $comment)
      <ul class="list-group m-1">
        <li class="list-group-item "> 
          <a href="{{ route('profile.show',$post->user->profile->id) }}"> 
            <small><strong>{{$comment->user->name}}:</strong></small> 
          </a> {{$comment->comment}} 
        </li>
      </ul>
  @endforeach
  <ul class="list-group m-1">
    <li class="list-group-item "> <a href="{{ route('post.comment', $post->id) }}">Reply</a></li>
  </ul>
</div>

@endsection


{{-- Modal --}}
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <form action=" {{route('post.report',$post->id)}} " method="POST"> --}}
          @csrf

          @foreach ($report as $item)
          <div class="form-check">
            <input class="form-check-input" type="radio" name="report" value="1" value=" {{$item->id}} " checked>
            <label class="form-check-label" for="flexRadioDefault2">
              {{$item->report}}
            </label>
          </div> 
          @endforeach

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Report</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>