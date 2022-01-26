@extends('layout.base')
@section('content')
<div class="list-group">
    <div class="list-group-item list-group-item-action list-group-item-primary active align-content-center">Notifications</div>
    @foreach ($notice as $item)
    <a href=" {{ route('profile.show',$item->data["info"]["id"]) }} " class="list-group-item list-group-item-action list-group-item-primary disabled">
        <div class="row p-1">
            <div class="row-1 aligen-center">
                <strong>{{ $item->data["info"]["name"] }}</strong>
            </div>
            <div class="col-7">
                {{ $item->data["message"] }}
            </div>
            <div class="col-2">
                <i class="fas fa-user-check"></i>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection
