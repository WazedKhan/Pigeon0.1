@extends('admin.master')
@section('content')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    @foreach ($posts as $item)
    <div class="d-flex text-muted pt-3">
        @if ($item->image == Null)
        <div class="col-1">
            <img src="/storage/{{ $item->image }}" class="img-responsive img-rounded" width="60" height="90" object-fit ="cover">
        </div>
        @endif
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <p class="m-0 m"> <strong>Caption: </strong>{{$item->caption}}</p>
        <p class="m-0 m"> <strong>User Name: </strong>{{$item->user->username}}</p>
        @if ($item->share_id)
        <p class="text-dark m-0"> <strong>
          Owner username: </strong>{{$item->share->post->user->username}} 
          Post ID: {{$item->share->post_id}}
        </p>
        @else
        <p class="badge badge-info"><strong>Not Shared</strong></p>
        @endif
        <p class="text-danger m-0"> <strong>Number of reports: </strong>  
          <a class="badge badge-danger" href="{{ route('admin.report.post.list',$item->id) }}">{{ $item->report->count() }}</a>
        </p>
        <p class="m-0"> <strong>Created At: </strong>{{$item->created_at}} </p>
        <p class="m-0"> <strong>Updated At: </strong>{{$item->user->updated_at}} </p>
        <span class="d-block">{{ $item->username }} </span>
        <a class="btn btn-danger" href="{{ route('admin.posts.delete',$item->id) }}">Delete</a>
      </div>
    </div>
    @endforeach
</div>


@endsection
