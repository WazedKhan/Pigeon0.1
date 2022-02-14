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
      <hr>
        <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-info btn-lg-sm btn-block m-1" href="{{ route('home.group',$group->id) }}">Home</a>
          <a class="btn btn-secondary btn-lg-sm btn-block m-1" href="{{ route('join.group.approved.members',$group->id) }}">Members</a>
          <a class="btn btn-secondary btn-lg-sm btn-block m-1" href="http://">Media</a>
          <a class="btn btn-secondary btn-lg-sm btn-warning m-1" href="{{ route('join.group.request',$group->id) }}">Joinig Requests</a>
          @if ($group->privacy=='private')
            <a class="btn btn-secondary btn-lg-sm btn-block m-1" href="#">Post Requests</a>
          @endif
        </div>
    </div>
</div>
<p class="text-secondary">To Approve Click on the name or ignore</p>

<div class="list-group">
    @foreach ($request_list as $item)
        <a href="{{ route('join.group.request.approved',$item->id) }}" class="list-group-item list-group-item-action list-group-item-primary disabled m-1">
            <img class="rounded-circle badge-dark" src="{{$item->user->profile->profileImage()}}" height="50" width="50">
            {{ $item->user->name }}
        </a>
    @endforeach
</div>
@endsection