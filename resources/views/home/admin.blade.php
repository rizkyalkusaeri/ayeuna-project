@extends('home.master')
@section('title')
    Beranda Admin
@endsection
@section('konten')
    <h4>Selamat Datang <b>{{ Auth::user()->name }}</b></h4>
    <h4>Anda tercatat sebagai admin di <b>
            Sistem</b></h4>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>
    <h4 class="font-bold"><b>Update Link Untuk Diakses Relawan Disini</b></h4>

    <form action="{{ route('update_link') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            {{-- <label for="link" class="form-label">Link yang akan diakses oleh relawan</label> --}}
            <input class="form-control" type="text" id="link" name="link" value="{{ $link->link }}" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <br>
    <h4 class="font-bold"><b>Silahkan import data user disini</b></h4>

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            {{-- <label for="file" class="form-label">File excel</label> --}}
            <input class="form-control" type="file" id="file" name="file" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>

    <br>
    <h3 class="font-bold">Data Relawan</h3>
    <div class="container">
        <div class="table-responsive-sm" style="width: 95%">
            <table id="table" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">TPS</th>
                    <th class="text-center">Kelurahan</th>
                    <th class="text-center">Kecamatan</th>
                </thead>
                <tbody>
                    @if (count($data) > 0)
                        @foreach ($data as $dt)
                            <tr>
                                <td>{{ $dt->email }}</td>
                                <td>{{ $dt->name }}</td>
                                <td>{{ $dt->tps }}</td>
                                <td>{{ $dt->kelurahan }}</td>
                                <td>{{ $dt->kecamatan }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data tersedia</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('costum-script')
    <script>
        $('#table').DataTable();
    </script>
@endpush
