@extends('admin.master')
@section('content')
<h4>Report List</h4>
    <table class="table">
        <thead>
            <tr>
                <th> Content </th>
                <th>Post Title</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list_ as $item)
            <tr>
                <td> {{$item->report->content->count()}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection