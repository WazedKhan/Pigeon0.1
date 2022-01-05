@extends('layout.base')
@section('content')
    <h1>Lets Find Some Great People</h1>
    <div class="list-group">
        @foreach ($people as $item)
        <a href=" {{route('profile.show',$item->id)}} ">
            <div class="list-group-item list-group-item-action list-group-item-primary disabled">
                <img src="{{ $item->profile->profileImage()}} " width="30" height="30" class="rounded d-inline-block align-top" alt="Profile Photo">
                {{$item->name}}
                <div class="float-right"><i class="fas fa-user-clock"></i></div>
            </div>
        </a>
        @endforeach
    </div>
@endsection