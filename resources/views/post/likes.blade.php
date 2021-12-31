@extends('layout.base')
@section('content')
    @foreach ($like_list as $user)
        <div class="row-12 m-3">
            <list class="row-6">
                <img src="{{ $user->profile->profileImage()}}" width="300" height="300" class="rounded d-inline-block align-top" alt="Profile Photo">
                <a href="{{route('profile.show',$user->id)}}"> {{$user->name}} </a>
            </list>
        </div>
    @endforeach
@endsection