@extends('layouts.app')

@section('content')

<form method="POST" action="{{route('koagulasi.sampleinfosave')}}">
    {{ csrf_field() }}

    <h6>Instrument Type : {{$instrument_type}}</h6>
    <h6>Instrument Serial No. : {{$instrument_id}}</h6>

    <input type="hidden" name="instrument_type" id="instrument_type" value="{{$instrument_type}}">
    <input type="hidden" name="instrument_id" id="instrument_id" value="{{$instrument_id}}">

    <div>&nbsp;</div>

    <div class="form-group">
        <label for="receive_date">Tanggal Penerimaan Material</label>
        <div class="input-group date">
            <input type="text" class="form-control datepicker" name="receive_date" id="receive_date" required>
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
    <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-2 pt-0">Jenis EQUAS yang Diikuti</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doddimer" id="doddimer" value="Y">
                    <label class="form-check-label" for="doddimer">EQUAS D-Dimer</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="doptaptt" id="doptaptt" value="Y">
                    <label class="form-check-label" for="doddimer">EQUAS PT dan APTT</label>
                </div>
            </div>
        </div>
    </fieldset>

    <button type="submit" class="btn btn-primary">Next</button>
</form>  

<script type="text/javascript">
    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true
    });
</script>

@endsection