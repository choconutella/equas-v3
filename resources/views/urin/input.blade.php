@extends('layouts.app')

@section('content')

<form method="POST" action="{{route('urin.inputsave')}}">
    {{ csrf_field() }}
    <h6>Instrument Type : {{$instrument_type}}</h6>
    <h6>Instrument Serial No. : {{$instrument_id}}</h6>

    <input type="hidden" name="instrument_type" id="instrument_type" value="{{$instrument_type}}">
    <input type="hidden" name="instrument_id" id="instrument_id" value="{{$instrument_id}}">
    <input type="hidden" name="page" value="{{$page}}">

    <br>
    <br>

    @if ($page=='1')
        <div class="col-md-4"><img src="{{url('storage/img/u-material-a.jpg')}}" width="230"></div>                
    @elseif ($page=='2')
        <div class="col-md-4"><img src="{{url('storage/img/u-material-b.jpg')}}" width="230"></div>  
    @endif

    <br>
    <br>

    <table class="table table-stripped col-md-8">
        @for ($i = 1; $i <= 5; $i++)
        <tr>
            <th colspan="3" class="text-center">Uji ke-{{$i}}</th>
        </tr>
            @foreach ($tests['names'] as $key=>$test)
            <tr>
                <td>{{$test}} ({{$tests['units'][$key]}})<input type="hidden" name="test[]" value="{{$test}}"></td>
                <td><input type="text" class="form-control" id="result" name="result[]" maxlength="6" required><td>
            </tr>
            @endforeach 
        @endfor
    </table>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>  

@endsection