@extends('layout.base')
@section('content')
{{-- @dd($user) --}}
    <div class="list-group">
        <div class="list-group-item list-group-item-action list-group-item-primary active">Follower List</div>
        @foreach ($user as $follower)
        <a href=" {{route('profile.show', $follower->id)}} " class="list-group-item list-group-item-action list-group-item-primary disabled">
            <div class="row">
                <div class="row-1 m-0 aligen-center">
                    <img src="{{ $follower->profile->profileImage()}}" width="30" height="30" class="rounded-circle d-inline-block align-top" alt="">
                    <strong> {{ $follower->name }}</strong>
                </div>
                <div class="col-2">
                    👥
                </div>
            </div>
        </a>
        @endforeach
    </div>
@endsection