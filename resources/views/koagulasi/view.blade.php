@extends('layouts.app')

@section('content')

<h6>Instrument Type : {{$instrument_type}}</h6>
<h6>Instrument Serial No. : {{$instrument_id}}</h6>

@if ($sampleinfo->doddimer=='Y')
<!-- ####################################################
        VIEW DDIMER
##################################################### -->  
@if (isset($qc_ddimer)&&isset($result_ddimer))
    <hr>
    <h5>D-Dimer</h5>
    <hr>
    @foreach ($qc_ddimer as $index => $data)
        <div class="row">
            <div class="col-md-12"><h6>INNOVANCE&reg; D-Dimer Control {{$index+1}}</h6></div>
        </div>
        <div class="row">
            <div class="col-md-2">Hasil</div>
            <div class="col-md-1">:</div>
            <div class="col-md-6">{{$data->qc_value}}</div>
        </div>
        <div class="row">
            <div class="col-md-2">Lot No. QC</div>
            <div class="col-md-1">:</div>
            <div class="col-md-6">{{$data->qc_lotno}}</div>
        </div>    
    @endforeach
    <br>
    <div class="row">
        <div class="col-md-2">Tanggal Pengerjaan</div>
        <div class="col-md-1">:</div>
        <div class="col-md-9">{{date('d F Y',strtotime($activity_ddimer))}}</div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12"><h5>Material A</h5></div>
    </div>
    @foreach ($result_ddimer as $index => $data)
        @if ($data->material_type == 'A')
            <div class="row">
                <div class="col-md-2">Hasil Tes {{($index%2)+1}}</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->result_value}}</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-2">dOD</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->dod}}</div>
            </div>
        @endif  
    @endforeach
    <br>
    <div class="row">
        <div class="col-md-12"><h5>Material B</h5></div>
    </div>
    @foreach ($result_ddimer as $index => $data)
        @if ($data->material_type == 'B')
            <div class="row">
                <div class="col-md-2">Hasil Tes {{($index%2)+1}}</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->result_value}}</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-2">dOD</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->dod}}</div>
            </div>
        @endif  
    @endforeach
@endif
@endif


<br>
@if ($sampleinfo->doptaptt == 'Y')
<!--  ############################################
        VIEW PT APTT
################################################## -->   
@if (isset($qc_ptaptt)&&isset($result_ptaptt))
    <hr>
    <h5>PT - APTT</h5>
    <hr>
    <div class="row">
        <div class="col-md-3">Nama Reagensia PT</div>
        <div class="col-md-1">:</div>
        <div class="col-md-8">{{$reagen_pt}}</div>
    </div>
    <div class="row">
        <div class="col-md-3">Nama Reagensia APTT</div>
        <div class="col-md-1">:</div>
        <div class="col-md-8">{{$reagen_aptt}}</div>
    </div>    
    <br>

    <div class="row">
        <div class="col-md-12"><h5>Control Plasma Normal (CPN)</h5></div>
    </div>
    @foreach ($qc_ptaptt as $index => $data)
        @if ($data->control_type == 'CPN')   
            <div class="row">
                <div class="col-md-2">Hasil {{$data->test_name}}</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->qc_value}}</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-2">Lot No.</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->qc_lotno}}</div>
            </div>
        @endif
    @endforeach
    <br>
    <div class="row">
        <div class="col-md-12"><h5>Control Plasma Patologis (CPP)</h5></div>
    </div>
    @foreach ($qc_ptaptt as $index => $data)
        @if ($data->control_type == 'CPP')   
            <div class="row">
                <div class="col-md-2">Hasil {{$data->test_name}}</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->qc_value}}</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-2">Lot No.</div>
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->qc_lotno}}</div>
            </div>
        @endif
    @endforeach
    <br>
    <div class="row">
        <div class="col-md-2">Tanggal Pengerjaan</div>
        <div class="col-md-1">:</div>
        <div class="col-md-9">{{$activity_ptaptt}}</div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12"><h5>Material C</h5></div>
    </div>
    @php
        $count = 1
    @endphp
    @foreach ($result_ptaptt as $index => $data)
        @if ($data->material_type == 'C')
            <div class="row">
                @if ($data->test_name == 'PT')
                <div class="col-md-2">Hasil Tes {{$data->test_name}} &nbsp;&nbsp;&nbsp;&nbsp;- {{$count}}</div>
                @else
                <div class="col-md-2">Hasil Tes {{$data->test_name}} - {{$count}}</div>
                @endif
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->result_value}}</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-2">Ref Range</div>
                <div class="col-md-1">:</div>
                @if ($data->test_name == 'PT')
                <div class="col-md-2">{{$data->pt_refrange}}</div>
                @else
                <div class="col-md-2">{{$data->aptt_refrange}}</div>  
                @endif
            </div>
        @endif  
        @php
            if($index%2<>0){
                $count += 1;
            }
        @endphp
    @endforeach
    <br>
    <div class="row">
        <div class="col-md-12"><h5>Material D</h5></div>
    </div>
    @php
        $count = 1
    @endphp
    @foreach ($result_ptaptt as $index => $data)
        @if ($data->material_type == 'D')
            <div class="row">
                @if ($data->test_name == 'PT')
                <div class="col-md-2">Hasil Tes {{$data->test_name}} &nbsp;&nbsp;&nbsp;&nbsp;- {{$count-2}}</div>
                @else
                <div class="col-md-2">Hasil Tes {{$data->test_name}} - {{$count-2}}</div>
                @endif
                <div class="col-md-1">:</div>
                <div class="col-md-2">{{$data->result_value}}</div>
                <div class="col-md-1">&nbsp;</div>
                <div class="col-md-2">Ref Range</div>
                <div class="col-md-1">:</div>
                @if ($data->test_name == 'PT')
                <div class="col-md-2">{{$data->pt_refrange}}</div>
                @else
                <div class="col-md-2">{{$data->aptt_refrange}}</div>  
                @endif
            </div>
        @endif  
        @php
            if($index%2<>0){
                $count += 1;
            }
        @endphp
    @endforeach
@endif
@endif
<br>
<br>
<br>
@endsection