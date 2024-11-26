@extends('home.master')
@section('title')
    Beranda
@endsection
@section('konten')
    <h4>Selamat Datang <b>{{ Auth::user()->name }}</b></h4>
    <h4>Anda tercatat sebagai relawan di <b>TPS : {{ Auth::user()->tps }}, {{ Auth::user()->kelurahan }},
            {{ Auth::user()->kecamatan }}</b></h4>
    <br>

    <h3 class="font-bold">Anda akan diarahkan ke link dalam waktu 3 detik</h3>

@endsection
@push('costum-script')
    <script>
        $(document).ready(function() {
            // Redirect after 3 seconds (3000 milliseconds)
            setTimeout(function() {
                window.location.href = "{{ route('go_link') }}";
            }, 3000);
        });
    </script>
@endpush
