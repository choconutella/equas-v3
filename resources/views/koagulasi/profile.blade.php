@extends('layouts.app')

@section('content')

<form method="POST" action="{{route('koagulasi.profilesave')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="custid">ID Customer</label>
        <input type="text" class="form-control" id="custid" name="custid" placeholder="ID Customer" value="{{$user_id}}" disabled>
    </div>
    <div class="form-group">
        <label for="custname">Nama Customer</label>
        <input type="text" class="form-control" id="custname" name="custname" placeholder="Nama Customer" value="{{$user_name}}" disabled>
    </div>
    <div class="form-group">
        <label for="address">Alamat</label>
        <textarea class="form-control" id="address" name="address" rows="3">{{$profile['address']}}</textarea>
    </div>
    <div class="form-group">
        <label for="pjlab">Penanggungjawab Lab</label>
    <input type="text" class="form-control" id="pjlab" name="pjlab" placeholder="Penanggungjawab Lab" value="{{$profile['pj_lab']}}">
    </div>
    <div class="form-group">
        <label for="email_pjlab">Email Penanggungjawab Lab</label>
        <input type="email" class="form-control" id="email_pjlab" name="email_pjlab" aria-describedby="emailHelp" value="{{$profile['email_pj_lab']}}" placeholder="Email Penganggungjawab Lab">
    </div>
    <div class="form-group">
        <label for="kalab">Kepala Lab</label>
        <input type="text" class="form-control" id="kalab" name="kalab" placeholder="Kepala Lab" value="{{$profile['ka_lab']}}">
    </div>
    <div class="form-group">
        <label for="email_pjlab">Email Kepala Lab</label>
        <input type="email" class="form-control" id="email_kalab" name="email_kalab" aria-describedby="emailHelp" value="{{$profile['email_ka_lab']}}" placeholder="Email Kepala Lab">
    </div>
    <div class="form-group">
        <label for="hp">No. HP</label>
        <input type="text" class="form-control" id="hp" name="hp" placeholder="No. Handphone" value="{{$profile['hp']}}">
    </div>
    <div class="form-group">
        <label for="telp">No. Telepon Lab</label>
        <input type="text" class="form-control" id="telp" name="telp" placeholder="No. Telepon Lab" value="{{$profile['telp']}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>  

@endsection