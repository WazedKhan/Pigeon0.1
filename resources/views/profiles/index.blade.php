@extends('layout.base')

@section('content')
@if($user->status != 'block')
<div class="row">
    <div class="col-5">
        <div class="col-1">
            {{-- @dd($user->profile->profileImage()) --}}
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle border border-secondary" width="250" height="250" object-fit ="cover">
        </div>
    </div>
    <div class="col-7 pt-5">
        <div class="container">
            <div class="row justify-content">
                <div><h2> {{$user->username}} </h2></div>
                @if (Auth::user()->id != $user->id)

                    @if (Auth::user()->profile->followers->contains($user->id))
                        <div class="col-auto">
                            <a class="btn btn-info m-1" href="{{ route('unfollow',$user->id) }}">Unfollw</a>
                        </div>
                    @else
                        <div class="col-auto">
                            <a class="btn btn-info m-1" href="{{ route('follow',$user->id) }}">Follow </a>
                        </div>
                    @endif

                @endif
            </div>
        </div>
        <div class="d-flex pt-2">
            <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
            <div class="pr-5"><strong> <a href=" {{route('profile.followers', $user->id,)}} "> {{ $user->following->count() }} </strong> followers</a></div>
            <div class="pr-5"><strong> {{ $user->profile->followers->count() }} </strong> following</div>
        </div>
        <div class="pt-4"><b> {{ $user->profile->title }} </b></div>
        <div> {{ $user->profile->details }} </div>
        <div><a href="">{{ $user->profile->url }}</a></div>
        @can('update', $user->profile)
        <div class="float-right ">
            <a href=" {{route('profile.edit', $user->id)}} "  role="button" aria-pressed="true">
                <i class="fas fa-user-edit"> Edit Profile</i>
            </a>
        </div>
        @endcan
    </div>
</div>

<div class="container">

</div>

<div class="pt-5">
    @foreach ($user->posts as $item)

    <article class="media content-section">
        <img class="rounded-circle article-img" src={{$user->profile->profileImage()}}>
        <div class="media-body">
          <div class="article-metadata">
            <a class="mr-2" href="#">{{ $user->username }}</a>
            <small class="text-muted">{{$item->updated_at->format('d/m/y')}}</small>
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
        @if ($item->image != '[]')
        @foreach ($item->post_image as $images)
        <div class="m-1">
            <img src="{{ url('storage/'.$images->image) }}" class="img-fluid">
        </div>
        @endforeach
        @endif
        </div>
    </article>

    @endforeach
</div>

@else
    <H1>Profile Has been Banned</H1>
@endif
@section('sidebar')
    @include('layout.sidebar')
@endsection
@endsection
