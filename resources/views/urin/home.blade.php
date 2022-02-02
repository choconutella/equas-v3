@extends('layouts.app')

@section('content')

<p>Selamat datang di website EQUAS Urin</p>
<p>Terima kasih telah menggunakan layanan website unggah hasil EQUAS.</p>
<p>
    Jika terdapat pertanyaan, silakan hubungi kami melalui email di Sysmex.Urinalysis@sysmex.co.id
    atau telepon ke Sysmex Call Center di (021) 3002 6999 / (021) 2902 3008.
</p>
<p>
File petunjuk pengerjaan material uji dan petunjuk unggah hasil dapat diunduh pada tautan <a href="{{url('storage/urin/Surat_Petunjuk_EQUAS_UFCM.pdf')}}">ini</a>.<br>
Form hasil manual dapat diunduh pada tautan <a href="{{url('storage/urin/Form_Hasil_Manual_EQUAS_UFCM.pdf')}}">ini</a>.
</p>
<p>Terima kasih atas partisipasi Anda.</p>

<p>Silakan mengisi hasil EQUAS Anda di menu <a href="{{route('urin.instrument')}}">MY EQUAS</a>.</p>


@endsection