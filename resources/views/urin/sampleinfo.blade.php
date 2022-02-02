@extends('layouts.app')

@section('content')

<form method="POST" action="{{route('urin.sampleinfosave')}}">
    {{ csrf_field() }}

    <h6>Instrument Type : {{$instrument_type}}</h6>
    <h6>Instrument Serial No. : {{$instrument_id}}</h6>

    <input type="hidden" name="instrument_type" id="instrument_type" value="{{$instrument_type}}">
    <input type="hidden" name="instrument_id" id="instrument_id" value="{{$instrument_id}}">

    <div>&nbsp;</div>

    <div class="form-group">
        <label for="kalibrasi">Tanggal Kalibrasi Terakhir</label>
        <div class="input-group date">
            <input type="text" class="form-control datepicker" name="kalibrasi" id="kalibrasi" placeholder="Kalibrasi Terakhir">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="receive_date">Tanggal Penerimaan Material</label>
        <div class="input-group date">
            <input type="text" class="form-control datepicker" name="receive_date" id="receive_date" placeholder="Tanggal Terima Bahan">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Kondisi Material Saat Diterima</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="gridCheck1" value="Baik">
                    <label class="form-check-label" for="gridCheck1">Baik (2-8 &#8451;)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="gridCheck2" value="Tidak Baik">
                    <label class="form-check-label" for="gridCheck2">Suhu tidak (2-8 &#8451;)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="gridCheck3" value="Telat Diterima">
                    <label class="form-check-label" for="gridCheck3">Terlambat diterima</label>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group">
        <label for="testing_date">Tanggal Pengujian</label>
        <div class="input-group date">
            <input type="text" class="form-control datepicker" name="testing_date" id="testing_date" placeholder="Tanggal Uji">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="clinician">Dokter Penanggungjawab</label>
        <input type="text" class="form-control" id="clinician" name="clinician" placeholder="Dokter">
    </div>

    <button type="submit" class="btn btn-primary">Next</button>
</form>  

<script type="text/javascript">
    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true
    });
</script>

@endsection