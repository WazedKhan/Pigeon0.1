@extends('admin.master')
@section('content')
<div class="text-black-50 m-1">
    <h4>Report List</h4> 
    <button type="button" class="btn btn-primary p-2" role="button" 
        data-toggle="modal" data-target="#exampleModalCenter">
        Create A New Issue
</div>
    </button>
    <table class="table">
        <thead>
            <tr>
                <th> Report </th>
                <th> Created By </th>
                <th> Created For </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reports as $item)
            <tr>
                <td> {{ $item->report }} </td>
                <td> {{ $item->user->name }} </td>
                <td> Post </td>
            </tr>
            @endforeach
        </tbody>
    </table>













{{-- modal --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Generate A New Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action=" {{route('admin.report_create')}} " method="POST">
                @csrf
                <div class="form-group">
                  <label for="message-text" class="col-form-label"></label>
                  <textarea class="form-control" name="report" id="message-text"></textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection

