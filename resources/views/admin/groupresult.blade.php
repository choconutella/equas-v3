@extends('layouts.app')

@section('content')

<form method="POST" action={{route('admin.update_groupresult')}}>
    {{ csrf_field() }}

    <h6>Periode : {{$periode->periode_id}}</h6>

    <input type="hidden" name="periode" id="periode" value="{{$periode->periode_id}}">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Instrument</th>
                <th scope="col">Tests</th>
                <th scope="col">Reagen</th>
                <th scope="col">Material</th>
                <th scope="col">Mean</th>
                <th scope="col">Median</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $row)
            <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$row->inst_type}}</td>
                <td>{{$row->test_name}}</td>
                <td>{{$row->reagen_name}}</td>
                <td>{{$row->material_type}}</td>
                <td>{{round($row->mean,2)}}</td>
                <td>
                    <input type="hidden" name="grp_id[]" value="{{$row->id}}" />
                    <input type="text" class="form-control" name="median[]" id="median" />
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>  

@endsection