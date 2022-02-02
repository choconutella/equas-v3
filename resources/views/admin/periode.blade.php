@extends('layouts.app')

@section('content')

<!-- DISPLAY PERIODE MENU -->
@if (\Request::is('*/manage/periode'))
<div class="list-group">
    <a href="{{route('admin.periode_create')}}" class="list-group-item list-group-item-action">Create New Periode</a>
    <a href="{{route('admin.periode_close',['step'=>0])}}" class="list-group-item list-group-item-action">Close Current Periode</a>
</div>

@elseif (\Request::is('*/manage/periode/create')) 

<div>This is page for create new periode</div>

@elseif (\Request::is('*/manage/periode/close*'))
<div class="list-group">

    @if ($step==0)
    <a href="{{route('admin.periode_close',['step'=>$step+1])}}" class="list-group-item list-group-item-action">Calculate Group Result</a>
    <li class="list-group-item list-group-item-action">Calculate Indices</li> 
    <li class="list-group-item list-group-item-action">Close Current Result</li>
    @endif
    
    @if ($step==1)
    <li  class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">Group Result Calculate <a href="{{route('admin.groupresult')}}">Update Median</a></li>
    <a href="{{route('admin.periode_close',['step'=>$step+1])}}" class="list-group-item list-group-item-action">Calculate Indices</a> 
    <li class="list-group-item list-group-item-action">Close Current Result</li>
    @endif
    
    @if ($step==2)
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">Calculate Group Result <span class="badge badge-success badge-pill">OK</span></li>
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">Calculate Indices <span class="badge badge-success badge-pill">OK</span></li> 
    <a href="{{route('admin.periode_close',['step'=>$step+1])}}" class="list-group-item list-group-item-action">Close Current Result</a> 
    @endif

    @if ($step==3)
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">Calculate Group Result <span class="badge badge-success badge-pill">OK</span></li>
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">Calculate Indices <span class="badge badge-success badge-pill">OK</span></li> 
    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">Close Current Result <span class="badge badge-success badge-pill">OK</span></a> 
    @endif

</div>
@endif


@endsection