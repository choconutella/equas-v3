@extends('layouts.app')

@section('content')

<form method="POST" action="{{route('urin.qcsave')}}">
    {{ csrf_field() }}
    <h6>Instrument Type : {{$instrument_type}}</h6>
    <h6>Instrument Serial No. : {{$instrument_id}}</h6>

    <input type="hidden" name="instrument_type" id="instrument_type" value="{{$instrument_type}}">
    <input type="hidden" name="instrument_id" id="instrument_id" value="{{$instrument_id}}">
    <br>
    <br>
    <h5>Quality Control</h5>
    <hr>
    <br>
    <br>
    <div class="md-form form-group form-inline">
        <label for="lotno" class="col-md-1 col-form-label"><strong>No. Lot</strong></label>
        <input type="text" class="form-control col-md-3" id="lotno" name="lotno" placeholder="" required>
    </div>
    <br>
    <br>
    <table class="table table-stripped col-md-5">
        @for ($i = 1; $i <= 2; $i++)
        <tr>
            <th colspan="3" class="text-center">Level {{$i}}</th>
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