@extends('layouts.app')

@section('content')

<table class="table table-striped table-hover">
    <tr>
        <th>Serial No.</th>
        <th>Type</th>
        <th>Status</th>
    </tr>
    @if (Session::get('periode')=='N/A')
        <tr>
            <td colspan="3" class="text-center">Next periode of EQUAS not started</td>
        </tr>
    @else
    @foreach ($instruments as $instrument)
        @if ($inst_arr[$instrument->inst_serial_no]=='N')
            <tr onclick="window.location.href='sampleinfo/{{$instrument->inst_type}}/{{$instrument->inst_serial_no}}'">    
                <td>{{$instrument->inst_serial_no}}</td>
                <td>{{$instrument->inst_type}}</td>
                <td>Not Done</td>
            </tr>
        @else
            <tr onclick="window.location.href='view/{{$instrument->inst_type}}/{{$instrument->inst_serial_no}}'">    
                <td>{{$instrument->inst_serial_no}}</td>
                <td>{{$instrument->inst_type}}</td>
                <td>Done</td>
            </tr>
        @endif
        
    @endforeach
    @endif
    
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
            @if ($periode->isactive=='N')
                <tr>
                    <td>{{$periode->periode_id}}</td>
                    <td>{{$instrument->inst_type}}</td>
                    <td>{{$instrument->inst_serial_no}}</td>
                    <td>
                        <a href="/pdf/koagulasi/{{$periode->periode_id}}_{{Session::get('user_id')}}_{{$instrument->inst_serial_no}}.pdf" target="_blank">PDF</a>
                        &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                        <a href="/certificate/koagulasi/{{$periode->periode_id}}_{{Session::get('user_id')}}_{{$instrument->inst_serial_no}}.pdf" target="_blank">Sertifikat</a>
                    </td>
                </tr>
            @endif
        
        @endforeach
    @endforeach
</table>


@endsection