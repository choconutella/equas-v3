@extends('layouts.app')

@section('content')

<form method="POST" action={{route('koagulasi.inputsave')}}>
    {{ csrf_field() }}

    <h6>Instrument Type : {{$instrument_type}}</h6>
    <h6>Instrument Serial No. : {{$instrument_id}}</h6>

    <input type="hidden" name="instrument_type" id="instrument_type" value="{{$instrument_type}}">
    <input type="hidden" name="instrument_id" id="instrument_id" value="{{$instrument_id}}">
    <input type="hidden" name="test" id="test" value="{{$test}}">


    <!--  
        FORM INPUT EQUAS DDIMER
    -->
    @if($test=='ddimer')
    <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Tanggal Pengerjaan Material</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="radio1" value="21-02-2022">
                    <label class="form-check-label" for="radio1">21-Februari-2022</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="radio2" value="22-02-2022">
                    <label class="form-check-label" for="radio2">22-Februari-2022</label>
                </div>
            </div>
        </div>
    </fieldset>
    <h5>Material A</h5>
    <input type="hidden" name="material[]" value="A">
    <div class="form-row">
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="result">Hasil Tes 1 (mg/L FEU)</label>
                <input type="text" class="form-control" id="result" name="result[]" placeholder="Hasil">
            </div>
        </div>
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="dod">dOD</label>
                <input type="text" class="form-control" id="dod" name="dod[]" placeholder="dOD">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="result">Hasil Tes 2 (mg/L FEU)</label>
                <input type="text" class="form-control" id="result" name="result[]" placeholder="Hasil">
            </div>
        </div>
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="dod">dOD</label>
                <input type="text" class="form-control" id="dod" name="dod[]" placeholder="dOD">
            </div>
        </div>
    </div>
    <h5>Material B</h5>
    <input type="hidden" name="material[]" value="B">
    <div class="form-row">
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="result">Hasil Tes 1 (mg/L FEU)</label>
                <input type="text" class="form-control" id="result" name="result[]" placeholder="Hasil">
            </div>
        </div>
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="dod">dOD</label>
                <input type="text" class="form-control" id="dod" name="dod[]" placeholder="dOD">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="result">Hasil Tes 2 (mg/L FEU)</label>
                <input type="text" class="form-control" id="result" name="result[]" placeholder="Hasil">
            </div>
        </div>
        <div class="col-md-6">
            <div class="md-form form-group">
                <label for="dod">dOD</label>
                <input type="text" class="form-control" id="dod" name="dod[]" placeholder="dOD">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="pelaksana">Nama Pelaksana</label>
        <input type="text" class="form-control" id="pelaksana" name="pelaksana"  placeholder="Nama">
    </div>
    @endif
    <!--  
        END FORM INPUT EQUAS DDIMER
    -->

    <!--  
        FORM INPUT EQUAS PT-APTT
    -->
    @if($test=='ptaptt')
    <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Tanggal Pengerjaan Material</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="radio1" value="21-02-2022">
                    <label class="form-check-label" for="radio1">21-Februari-2022</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="radio2" value="22-02-2022">
                    <label class="form-check-label" for="radio2">22-Februari-2022</label>
                </div>
            </div>
        </div>
    </fieldset>
    <h4>Material C</h4>
    <input type="hidden" name="material[]" value="C">
    <div class="form-row">
        <div class="col-md-2">
            <h5>Hasil 1</h5>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">PT</label>
                <input type="hidden" name="param[]" value="PT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil PT" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">APTT</label>
                <input type="hidden" name="param[]" value="APTT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil APTT" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-2">
            <h5>Hasil 2</h5>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">PT</label>
                <input type="hidden" name="param[]" value="PT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil PT" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">APTT</label>
                <input type="hidden" name="param[]" value="APTT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil APTT" required>
            </div>
        </div>
    </div>
    <h4>Material D</h4>
    <input type="hidden" name="material[]" value="D">
    <div class="form-row">
        <div class="col-md-2">
            <h5>Hasil 1</h5>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">PT</label>
                <input type="hidden" name="param[]" value="PT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil PT" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">APTT</label>
                <input type="hidden" name="param[]" value="APTT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil APTT" required>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-2">
            <h5>Hasil 2</h5>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">PT</label>
                <input type="hidden" name="param[]" value="PT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil PT" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-group form-group form-inline">
                <label for="hasil" class="col-md-2 col-form-label">APTT</label>
                <input type="hidden" name="param[]" value="APTT">
                <input type="text" class="form-control" id="hasil" name="hasil[]" placeholder="Hasil APTT" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="ptrr">Nilai Normal PT di Lab (sec)</label>
        <input type="text" class="form-control" id="ptrr" name="ptrr"  placeholder="Nilai Normal PT" required>
    </div>
    <div class="form-group">
        <label for="apttrr">Nilai Normal APTT di Lab (sec)</label>
        <input type="text" class="form-control" id="apttrr" name="apttrr"  placeholder="Nilai Normal APTT" required>
    </div>
    <div class="form-group">
        <label for="pelaksana">Nama Pelaksana</label>
        <input type="text" class="form-control" id="pelaksana" name="pelaksana"  placeholder="Nama Pelaksana" required>
    </div>
    @endif
    <!--  
        FORM INPUT EQUAS PT-APTT
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