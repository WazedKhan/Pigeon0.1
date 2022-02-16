@extends('admin.master')
@section('content')
<div class="text-center h2 m-4">
  Report Category({{ $reCat->count() }})
</div>
  <div class="card-deck">
  @foreach ($reCat as $item)

    <div class="card">
      <img class="card-img-top" src="{{ url('/media/complants.png') }}" height="150">
      <div class="card-body">
        <h5 class="card-title">Value: {{ $item->point }}</h5>
        <p class="card-text">{{ $item->name }}</p>
      </div>
    </div>

  @endforeach
</div>
<a class="btn btn-outline-info text-bold m-1" href="#" data-toggle="modal" data-target="#exampleModalCenter">Create New Report</a>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create A New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.report.create') }}" method="post">
          @csrf
          <label for="name">Name of Category</label>
          <input class="form-control" type="text" name="name">

          <label for="point">Value Of The Category</label>
          <input class="form-control" type="number" name="point" id="">
          <button type="submit" class="btn btn-primary m-1">Save</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endsection

