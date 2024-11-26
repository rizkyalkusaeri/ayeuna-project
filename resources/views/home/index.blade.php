@extends('home.master')
@section('title')
    Beranda
@endsection
@section('konten')
    <h4>Selamat Datang <b>{{ Auth::user()->name }}</b></h4>
    {{-- <h6>Anda tercatat sebagai relawan di <b>TPS : {{ Auth::user()->tps }}, {{ Auth::user()->kelurahan }},
            {{ Auth::user()->kecamatan }}</b></h6> --}}
    <h6>Anda tercatat sebagai relawan Arfi-Yena</h6>
    <br>

    <h3 class="font-bold">Anda akan diarahkan ke link dalam detik ke <div id="timer"></div>
    </h3>
@endsection
@push('costum-script')
    <script>
        $(document).ready(function() {
            // Redirect after 3 seconds (3000 milliseconds)
            setTimeout(function() {
                window.location.href = "{{ route('go_link') }}";
            }, 5000);

            var count = 5; // Starting number
            $("#timer").text(count); // Initialize the display

            // Countdown function
            var interval = setInterval(function() {
                count--;
                if (count > 0) {
                    $("#timer").text(count); // Update the display
                } else {
                    $("#timer").text("Go!"); // Final message
                    clearInterval(interval); // Stop the countdown
                }
            }, 1000); // Update every second
        });
    </script>
@endpush
