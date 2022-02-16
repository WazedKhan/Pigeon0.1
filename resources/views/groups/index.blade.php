@extends('layout.base')
@section('content')
@php $count = 0 @endphp

  <div class="row">
    <div class="card-deck">
      @foreach ($groups as $item)
        @php $count+=1 @endphp

        @if (!$item->group_member->contains('user_id',Auth::user()->id))
          <div class="card m-1" style="width: 18rem;">
            <img class="card-img-top" src="{{ url('/storage/'.$item->image) }}" alt="Card image cap" height="150">
            <div class="card-header">
              <a href="{{ route('home.group',$item->id) }}"><strong>{{ $item->name }}</strong> </a>
              <p>
                {{ $item->group_member->count() }} members <i class="fa-thin fa-period"></i>
              </p>
            </div>
            <div class="card-body">
              @if ($item->user_id == Auth::user()->id)
                <a class="form-control btn btn-warning" href="{{ route('home.group',$item->id) }}">Manage</a>
              @else
                <a class="form-control btn btn-warning" href="{{ route('groups.join',$item->id) }}">Join</a>
              @endif
            </div>
          </div>
        
          @if ($count/3==1)
            <div class="w-100"></div>
            @php $count = 0 @endphp
          @endif
        @endif
      @endforeach
    </div>
  </div>
@endsection

@section('sidebar')
  <a class="form-control btn btn-info" href="{{ route('create.group') }}">Create a group</a>
  <h3>Groups you manage</h3>
  <ul class="list-group list-group-flush">
    @foreach ($myGroup as $item)
      <a href="{{ route('home.group',$item->id) }}">
        <li class="list-group-item list-group-item-action">
          <img class="rounded" src="{{ url('/storage/'.$item->image) }}" height="50" width="50">
          {{ $item->name}}
        </li>
      </a>
    @endforeach
  </ul>
  <h3>Groups you've joined</h3>
  <ul class="list-group list-group-flush">
    @foreach ($joinedGroup as $item)
      <a href="{{ route('home.group',$item->group_id) }}">
        <li class="list-group-item list-group-item-action">
          <img class="rounded" src="{{ url('/storage/'.$item->group->image) }}" height="50" width="50">
          {{ $item->group->name}}
        </li>
      </a>
    @endforeach
  </ul>


  {{-- <div class="media-body" style=" box-shadow: 25rem border-block-color: #131111; ">
    <div class="pt-1">
      <form action="#" method="post">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2" type="submit">Search</button>
      </form>
    </div>
  </div> --}}
@endsection