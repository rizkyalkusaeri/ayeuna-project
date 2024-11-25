@extends('home.master')
@section('title')
    Beranda
@endsection
@section('konten')
    <h4>Selamat Datang <b>{{ Auth::user()->name }}</b></h4>
    <h4>Anda tercatat sebagai relawan di <b>TPS : {{ Auth::user()->tps }}, {{ Auth::user()->kelurahan }},
            {{ Auth::user()->kecamatan }}</b></h4>
    <br>

    <h3 class="font-bold">Panduan Pengisian Rekapitulasi</h3>
    <ul class="list-group">
        <li class="list-group-item">Langkah 1: Anda harus melakukan absen di pagi hari dengan mengisi link berikut <a
                href="{{ route('go_absen') }}" target="__blank"><b>Klik disini</b></a> </li>
        <li class="list-group-item">Langkah 2: Anda harus mengisi Pengisian Hasil Suara pada link berikut <a
                href="{{ route('go_isi') }}" target="__blank"><b>Klik disini</b></a></li>
        <li class="list-group-item">Langkah 3: Selesai</li>
    </ul>
@endsection
