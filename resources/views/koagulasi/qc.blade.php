@extends('layouts.app')

@section('content')

<form method="POST" action="{{route('koagulasi.qcsave')}}">
    {{ csrf_field() }}

    <h6>Instrument Type : {{$instrument_type}}</h6>
    <h6>Instrument Serial No. : {{$instrument_id}}</h6>

    <input type="hidden" name="instrument_type" id="instrument_type" value="{{$instrument_type}}">
    <input type="hidden" name="instrument_id" id="instrument_id" value="{{$instrument_id}}">
    <input type="hidden" name="test" id="test" value="{{$test}}">


<!--  
        FORM QC DDIMER
-->
    @if($test=='ddimer')
    <h5>INNOVANCE&reg; D-Dimer Control 1</h5>
    <div class="form-row">
        <div class="col-md-12">
            <div class="md-form form-group">
                <label for="resul1">Hasil (mg/L FEU)</label>
                <input type="text" class="form-control" id="result1" name="result[]" placeholder="Hasil">
            </div>
        </div>
        <div class="col-md-12">
            <div class="md-form form-group">
                <label for="lotno1">Lot No. QC</label>
                <input type="text" class="form-control" id="lotno1" name="lotno[]" placeholder="Lot No. QC">
            </div>
        </div>
    </div>
    <h5>INNOVANCE&reg; D-Dimer Control 2</h5>
    <div class="form-row">
        <div class="col-md-12">
            <div class="md-form form-group">
                <label for="resul2">Hasil (mg/L FEU)</label>
                <input type="text" class="form-control" id="result2" name="result[]" placeholder="Hasil">
                
            </div>
        </div>
        <div class="col-md-12">
            <div class="md-form form-group">
                <label for="lotno2">Lot No. QC</label>
                <input type="text" class="form-control" id="lotno2" name="lotno[]" placeholder="Lot No. QC">
            </div>
        </div>
    </div>
    @endif

<!--  
        END FORM QC DDIMER
-->

<!--  
        FORM QC PT-APTT
-->
    @if($test=='ptaptt')
    <div class="form-row">
        <div class="md-col-6">
            <div class="form-group">
                <label for="ptreagenname">Nama Reagensia PT</label>
                <input type="text" class="form-control" id="ptreagenname" name="ptreagenname"  placeholder="" value="Dade Innovin" readonly>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="md-col-6">
            <div class="form-group">
                <label for="apttreagenname">Nama Reagensia APTT</label>
                <select class="form-control" name="apttreagenname" id="apttreagenname">
                    <option value="Actin FS">Actin FS</option>
                    <option value="Actin FSL">Actin FSL</option>
                    <option value="Pathromtin SL">Pathromtin SL</option>
                </select>
            </div>
        </div>
    </div>
    <h4>Control Plasma Normal (CPN)</h4>
    <input type="hidden" name="control[]" value="CPN" >
    <h5>PT</h5>
    <input type="hidden" name="param[]" value="PT" >
    <div class="form-row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="hasil">Hasil (sec)</label>
                <input type="text" class="form-control" id="hasil" name="hasil[]"  placeholder="Hasil" required>
            </div>
        </div>
    </div>
    
    <h5>APTT</h5>
    <input type="hidden" name="param[]" value="APTT" >
    <div class="form-row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="hasil">Hasil (sec)</label>
                <input type="text" class="form-control" id="hasil" name="hasil[]"  placeholder="Hasil" required>
            </div>
        </div>
    </div>
    
    <div class="md-col-12">
        <div class="form-group">
            <label for="lotno"><h5>Lot No. CPN</h5></label>
            <input type="text" class="form-control" id="lotno" name="lotno[]"  placeholder="Lot No. CPN" required>
        </div>
    </div>
    <h4>Control Plasma Patologis (CPP atau Ci-Trol 2)</h4>
    <p><small>*jika tidak menggunakan Control Plasma Patologis (CPP / Ci-Trol 2), harap dikosongkan</small></p>
    <input type="hidden" name="control[]" value="CPP" >
    <h5>PT</h5>
    <input type="hidden" name="param[]" value="PT" >
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="hasil">Hasil (sec)</label>
                <input type="text" class="form-control" id="hasil" name="hasil[]"  placeholder="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lotno1">Lot No. CPP / Ci-Trol 2</label>
                <input type="text" class="form-control" id="lotno1" name="lotno[]"  placeholder="">
            </div>
        </div>
    </div>
    <h5>APTT</h5>
    <input type="hidden" name="param[]" value="APTT" >
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="hasil">Hasil (sec)</label>
                <input type="text" class="form-control" id="hasil" name="hasil[]"  placeholder="" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="lotno2">Lot No. CPP / Ci-Trol 2</label>
                <input type="text" class="form-control" id="lotno2" name="lotno[]"  placeholder="">
            </div>
        </div>
    </div>
    @endif
<!--  
        END FORM QC PT-APTT
-->
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>  

<script type="text/javascript">
    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true
    });
</script>

@endsection