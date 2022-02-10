@extends('layout.base')
@section('content')
@php $count = 0 @endphp

  <div class="row">
    <div class="card-deck">
      @foreach ($groups as $item)
        @php $count+=1 @endphp

          <div class="card m-1" style="width: 18rem;">
            <img class="card-img-top" src="{{ url('/storage/'.$item->image) }}" alt="Card image cap" height="150">
            <div class="card-header">
              <strong>{{ $item->name }}</strong> 
              <p>
                {{ $item->group_member->count() }} members <i class="fa-thin fa-period"></i>
              </p>
            </div>
            <div class="card-body">
              <a class="form-control btn btn-warning" href="{{ route('groups.join',$item->id) }}">Join</a>
            </div>
          </div>
        
          @if ($count/3==1)
          {{-- {{ $count }} --}}
            <div class="w-100"></div>
            @php $count = 0 @endphp
          @endif
      @endforeach
    </div>
  </div>
@endsection
@section('sidebar')
  <a class="form-control btn btn-info" href="{{ route('create.group') }}">Create a group</a>
  <div class="list-group pt-1">
    <a href="#" class="list-group-item list-group-item-action active">Active item</a>
    <a href="#" class="list-group-item list-group-item-action">Item</a>
    <a href="#" class="list-group-item list-group-item-action disabled">Disabled item</a>
  </div>


  <div class="media-body" style=" box-shadow: 25rem border-block-color: #131111; ">
    <div class="pt-1">
      <form action="#" method="post">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2" type="submit">Search</button>
      </form>
    </div>
  </div>
@endsection