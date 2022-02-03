@extends('layouts.app')

@section('content')

<table class="table table-striped table-hover">
    <tr>
        <th>Serial No.</th>
        <th>Type</th>
        <th>Status</th>
    </tr>
    @foreach ($instruments as $instrument)
        @if ($instrument->isactive=='Y')
            @if ($inst_arr[$instrument->inst_serial_no]=='N')
            <tr onclick="window.location.href='sampleinfo/{{$instrument->inst_type}}/{{$instrument->inst_serial_no}}'">    
                <td>{{$instrument->inst_serial_no}}</td>
                <td>{{$instrument->inst_type}}</td>           
                <td>Not Done</td>
            </tr>
            @else
            <tr>    
                <td>{{$instrument->inst_serial_no}}</td>
                <td>{{$instrument->inst_type}}</td>           
                <td>Done</td>
            </tr>
            @endif 
        @endif
    @endforeach


    <!--
    <tr>
    <td colspan="3" class="text-center"><button type="button" class="btn btn-success" onclick="window.location.href='profile'">+ Add Instrument</button></td>
    </tr>
    -->
</table>

<br>
<br>
<hr>
<br>
<br>
<table class="table table-striped table-hover">
    <tr>
        <th>Periode</th>
        <th>Instrument Type</th>
        <th>Serial No.</th>
        <th>Download</th>
    </tr>
    @foreach ($periodes as $periode)
        @foreach ($instruments as $instrument)
        <tr>
            <td>{{$periode->periode_id}}</td>
            <td>{{$instrument->inst_type}}</td>
            <td>{{$instrument->inst_serial_no}}</td>
            <td>
                <a href="/pdf/urin/{{$periode->periode_id}}_{{Session::get('user_id')}}_{{$instrument->inst_serial_no}}.pdf" target="_blank">PDF</a>
                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <a href="/certificate/urin/{{$periode->periode_id}}_{{Session::get('user_id')}}_{{$instrument->inst_serial_no}}.pdf" target="_blank">Sertifikat</a>
            </td>
        </tr>
        @endforeach
    @endforeach
</table>


@endsection