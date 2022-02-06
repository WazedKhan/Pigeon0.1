@extends('layout.base')
@section('content')
<article class="media content-section">
  <div class="media-body">
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
                @if (Auth::user()->id == $images->user_id)
                <a class="btn btn-outline-danger m-1" href="{{ route('post.image.delete',$images->id) }}">Delete</a>
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
    <img src=" {{$post->user->profile->profileImage()}} " class="rounded-circle" width="60" height="60" alt="Profile Image">
    <a class="mr-2 " href="{{ route('profile.show',$post->user->profile->id) }}"> <h3>{{$post->user->name}}</h3> </a>
    <small class="text-muted float-right "> {{$post->updated_at->diffforhumans()}} </small> <span class="badge badge-primary"> Feeling {{$post->emotion}} </span>
    @if (Auth::user()->id == $post->user->id)
      <a href=" {{ route('post.updateView', $post->id) }} " class="badge badge-dark">Edit</a>
      <a href=" {{ route('post.delete', $post->id) }} " class="badge badge-danger">Delete</a>
    @endif
    <div class="row pl-3">
      <a href="{{route('post.likers',$post->id)}}">{{$post->liked->count()}} 💖</a> |
       💬 {{$comments->count()}} Comments | {{ $report->count() }} Reports  | Share
      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61fde7493d91fa1c"></script>
      <div class="addthis_inline_share_toolbox"></div>
    </div>
  </div>

  <div class="d-flex justify-content-around">
    <a class="btn btn-outline-info float-left align-self-center" href="{{ route('post.like', $post->id) }}" role="button">
      <i class="far fa-heart"> Like</i>
    </a>

    <a class="btn btn-outline-secondary float-right align-self-center" href="{{ route('post.comment', $post->id) }}" role="button">
      <i class="far fa-comment-alt"> Comment </i>
    </a>

    <a class="btn btn-outline-secondary float-right align-self-center" href="#" role="button" data-toggle="modal" data-target="#exampleModalCenter">
      <i class="far fa-flag"> Report </i>
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



{{-- Modal --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalCenterTitle">Submit Your Report</h5>
        <div>
          <p>You can make report only once on this post and can't remove once submitted</p>
        </div>
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


@endsection


