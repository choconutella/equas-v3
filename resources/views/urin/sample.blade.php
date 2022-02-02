@extends('layouts.main')
@section('breadcrumbs')
<div class="section-header">
    <h1>Urinalysis</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Home</a></div>
      <div class="breadcrumb-item">Form</div>
    </div>
</div>
@endsection
@section('content')
<div class="section-body">
    <h2 class="section-title">Form Sample Info</h2>
    <p class="section-lead">Sysmex Equas</p>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Form</h4>
                    <div class="card-header-action">
                        <a href="{{url('sample_info')}}" class="btn btn-primary btn-sm"><i class="fa fa-backward"></i> back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('sample_info')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="name">Nama Instansi</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Jenis Alat</label>
                                <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">UF-500i</option>
                                    <option value="2">UF-500i</option>
                                    <option value="3">UF-500i</option>
                                </select>
                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="serial number">Serial Number</label>
                                <input id="" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input id="" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Kalibrasi Terakhir</label>
                                <input id="" type="date" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Tanggal Terima Bahan</label>
                                <input id="" type="date" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label>Kondisi Bahan</label>
                                <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Tidak Baik</option>
                                    <option value="3">Perlu Perbaikan</option>
                                </select>
                                @error('level')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Tanggal Pengujian</label>
                                <input id="" type="date" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Pelaksana Uji</label>
                                <input id="" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="email">Dokter Penanggung Jawab</label>
                                <input id="" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection