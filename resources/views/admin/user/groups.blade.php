@extends('admin.master')
@section('content')
<h1 class="text-center text-info">Groups({{ $groups->count() }})</h1>
    <div class="list-group">
        @foreach ($groups as $item)
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $item->name }}</h5>
                <small>{{ $item->created_at->diffforhumans() }}</small>
            </div>
            <p class="mb-1">Admin: {{ $item->user->username }}</p>
            <small>Members: {{ $item->group_member->count() }}</small>
        </a>
        @endforeach
    </div>
@endsection