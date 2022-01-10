@extends('layout.base')
<div class="row pl-5 m-lg-4">
    <div class="col-2">
        <div class="list-group">
            @foreach ($user as $item)
            <a href="{{ route('chat.user', $item->id) }}" name="id" value="{{ $item->id }}" class="list-group-item list-group-item-action list-group-item-primary m-md-1">
                <img src="{{ $item->profile->profileImage()}} "width="30" height="30" class="rounded-circle d-inline-block align-top" alt="Profile Photo">
                {{$item->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="col-8">
        <div class="list-group">
            <div class="card">
                @if ($chat!=null)
                <h3 class="card-header"> <strong>{{$chat->name ?? " "}}</strong></h3>
                <div class="card-body">

                   
                     {{ $chat->text }}
                    
                  
                </div>
                <form action="{{ route('chat.text', $chat) }}" method="post">
                    @csrf
                    <div class="row p-md-0">
                      <div class="col">
                        <div class="card-footer">
                            <input type="text" name="text" class="form-control" placeholder="Your Message">
                        </div>                      
                    </div>
                    </div>
                  </form>
                @endif
            </div>
        </div>
    </div>
  </div>