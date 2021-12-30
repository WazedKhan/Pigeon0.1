@extends('layout.base')
@section('content')
    <h1>Lets Find Some Great People</h1>
    <div class="list-group">
        @foreach ($people as $item)
        <div class="list-group-item list-group-item-action list-group-item-primary disabled badge badge-secondary>
            <a href=" {{route('profile.show',$item->id)}} " class="list-group-item list-group-item-action list-group-item-primary disabled badge badge-secondary ">{{$item->name}}
                <div class="text-right"><button type="button" class="btn btn-info">Info</button></div>
            </a>  
        </div>
        @endforeach
    </div>
@endsection