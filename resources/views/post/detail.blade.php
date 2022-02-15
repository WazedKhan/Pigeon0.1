@extends('layout.base')
@section('content')

<article class="media content-section">
  <div class="media-body">
    
    <div>
      @if ($post->share_id)
        @if ($post->share->post->group_id)
          <img class="rounded article-img" src="{{ url('/storage/'.$post->share->post->group->image) }}">
          <a href="{{ route('home.group',$post->share->post->group->id) }}"> <strong>{{$post->share->post->user->name}}</strong></a>
          <i class="fas fa-caret-right"></i>
          <a href="{{ route('profile.show',$post->share->post->user->id) }}"><strong>{{ $post->share->post->user->name }}</strong></a>
          <text-sc>Owner</text-sc>
        @else
          <img class="rounded-circle article-img" width="70" height="70" src={{$post->share->post->user->profile->profileImage()}}>
          <a href="{{ route('profile.show',$post->share->post->user->id) }}"><strong>{{ $post->share->post->user->name }}</strong></a>
          <text-sc>Owner</text-sc>
          <h5 class="card-title text-center text-lg-center colored">
            <a class="article-title text-center" href=" {{ route('post.detail',$post->share->post->id) }} ">View Original Post</a>
          </h5>
        @endif
      @endif
    </div>
    <hr>
    @if ($image == '[]')
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
        @if ($post->image != 'Null')

          @foreach ($image as $images)
            <div class="m-1">
                <img src="{{ url('storage/'.$images->image) }}" class="img-fluid" alt="Responsive image">
                @if (Auth::user()->id == $images->user_id && !$post->share_id)
                <a class="btn btn-outline-danger m-1" href="{{ route('post.image.delete',$images->id) }}">Delete Image</a>
                @endif
            </div>
          @endforeach

        @endif
  </div>
</article>
@endsection

@section('sidebar')

<div class="media-body">
  <div class="article-metadata">
    @if ($post->group_id)
    <div class="card">
      <div class="card-body">
        <img class="rounded article-img" src="{{ url('/storage/'.$post->group->image) }}">
        <a href="{{ route('home.group',$post->group->id) }}"> <strong>{{$post->group->name}}</strong></a>
      </div>
    </div>
    @endif
    <hr>
    <a class="mr-2 " href="{{ route('profile.show',$post->user->profile->id) }}"> 
      <img src=" {{$post->user->profile->profileImage()}} " class="rounded-circle" width="60" height="60" alt="Profile Image">
      <h3>{{$post->user->name}}</h3> 
    </a>
    <small class="text-muted float-right "> {{$post->updated_at->diffforhumans()}} </small> <span class="badge badge-primary"> Feeling {{$post->emotion}} </span>
    @if (Auth::user()->id == $post->user->id)
      @if (!$post->share_id)
      <a href=" {{ route('post.updateView', $post->id) }} " class="badge badge-dark">Edit</a>
      @endif
      <a href=" {{ route('post.delete', $post->id) }} " class="badge badge-danger">Delete</a>
    @endif
    <div class="row pl-3">
      <a href="{{route('post.likers',$post->id)}}">{{$post->liked->count()}} 💖</a> |
       💬 {{$comments->count()}} Comments | {{ $report->count() }} Reports  | 
      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61fde7493d91fa1c"></script>
      <div class="addthis_inline_share_toolbox"></div>
    </div>
  </div>

  <div class="d-flex justify-content-around">
    <a class="btn btn-outline-info float-left align-self-center" href="{{ route('post.like', $post->id) }}" role="button">
      <i class="far fa-heart"> Like</i>
    </a>

    <a class="btn btn-outline-secondary float-right align-self-center" href="{{ route('post.share', $post->id) }}" role="button">
      <i class="fas fa-share"></i> Share
    </a>

    <a class="btn btn-outline-secondary float-right align-self-center" href="#" role="button" data-toggle="modal" data-target="#exampleModalCenter">
      <i class="far fa-flag"> Report </i>
    </a>
  </div>
  <ul class="list-group mt-2">
    <form action=" {{route('post.comment.make', $post->id)}} " method="POST">
      @csrf
      <div class="form-group">
        <input type="text" name="comment" class="form-control" placeholder="Write a public comment…">
      </div>
    </form>
  </ul>
  <small><span>comments..</span></small>
  @foreach ($comments as $comment)
      <ul class="list-group m-1">
        <li class="list-group-item ">
          @if ($comment->user->id == Auth::user()->id)
            <a  href="#" role="button" data-toggle="modal" data-target="#exampleModalCenter2">
              <i class="fas fa-edit"></i>
            </a>|
            <a href="{{ route('post.comment.delete',$comment->id) }}"><i class="fas fa-trash-alt"></i></a>|
          @endif
          <a href="{{ route('profile.show',$post->user->profile->id) }}">
            <small><strong>{{$comment->user->name}}:</strong></small>
          </a> {{$comment->comment}} <small class="text-muted float-right "> {{ $comment->updated_at->diffforhumans()}} </small>
        </li>
      </ul>
  @endforeach
</div>



{{-- Modal --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalCenterTitle">Submit Your Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('post.report',$post->id) }}" method="post">
          @csrf
          @foreach ($recat as $item)
          <div class="form-check">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="report_id" id="exampleRadios2" value="{{ $item->id }}">
              <label class="form-check-label" for="exampleRadios2">
                {{ $item->name }}
              </label>
            </div>
          </div>
          @endforeach
          <button type="submit" class="form-control btn btn-primary">Submit</button>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

{{-- Modal Comment --}}
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalCenterTitle2">Update Comment</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        {{-- <form action="{{ route('post.comment.edit',$comment->id) }}" method="post">
          @csrf

          <input class="form-control m-1" name="comment" type="text" value="{{ $comment->comment }}">
          <button type="submit" class="form-control btn btn-primary m-1">Submit</button>
        </form> --}}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

@endsection


