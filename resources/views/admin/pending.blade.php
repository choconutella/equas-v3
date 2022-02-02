@extends('layouts.app')

@section('content')

<table class="table table-striped table-hover">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Serial No.</th>
        <th>Type</th>
    </tr>
    @foreach ($records as $record)
    <tr>
        <td>{{$record->customer_id}}</td>
        <td>{{$record->user_name}}</td>
        <td>{{$record->inst_serial_no}}</td>
        <td>{{$record->inst_type}}</td>
    </tr>
    @endforeach
</table>

@endsection