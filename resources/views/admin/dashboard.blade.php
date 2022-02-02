@extends('layouts.app')

@section('content')

<table class="table table-striped table-hover">
    <tr>
        <th>Status</th>
        <th>Count</th>
    </tr>
    @if(Request::is('equas/admin/urin'))
    @if ($pending=='N/A')
    <tr>
    @else
    <tr onclick="window.location.href='urin/pending'">
    @endif
    @elseif(Request::is('equas/admin/koagulasi'))
    @if ($pending=='N/A')
    <tr>
    @else
    <tr onclick="window.location.href='koagulasi/pending'">
    @endif
    @endif
        <td>Pending</td>
        <td>{{$pending}}</td>
    </tr>
    <tr>
        <td>Completed</td>
        <td>{{$completed}}</td>
    </tr>
    <tr>
        <td>Total</td>
        <td>{{$total}}</td>
    </tr>
</table>

@endsection