@extends('layout.base')
@section('content')
<div class="list-group">
    <div class="list-group-item list-group-item-action list-group-item-primary active">Follower List</div>
    {{-- @foreach ($user as $follower) --}}
    <a href=" # " class="list-group-item list-group-item-action list-group-item-primary disabled">
        <div class="row">
            <div class="row-1 m-0 aligen-center">
                <img src="#" width="30" height="30" class="rounded-circle d-inline-block align-top" alt="">
                <strong>#</strong>
            </div>
            <div class="col-2">
                👥
            </div>
        </div>
    </a>
    {{-- @endforeach --}}
</div>
@endsection
