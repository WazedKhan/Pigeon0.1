@extends('admin.master')
@section('content')
    
    @if ($total >= 100)
        <h4 class="text-danger">Total Value violates the safe value 
            <span class="badge badge-secondary badge-pill">Total : {{ $total }}</span>
        </h4>
    @else
        <h4 class="text-info">Total Value doesn't violates the safe value 
            <span class="badge badge-secondary badge-pill">Total : {{ $total }}</span>
        </h4>
    @endif
    <ul class="list-group">
        @foreach ($report as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Repoted by: {{ $item->user->username }}</strong>
            {{ $item->report_category->name }}
            <span class="badge badge-secondary badge-pill">Value: {{ $item->report_category->point }}</span>
        </li>
        @endforeach
    </ul>
@endsection