@extends('home.master')
@section('title')
    Beranda Admin
@endsection
@section('konten')
    <h4>Selamat Datang <b>{{ Auth::user()->name }}</b></h4>
    <h6>Anda tercatat sebagai admin di <b>
            Sistem</b></h6>

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
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <hr>
    <br>
    <h4 class="font-bold"><b>Silahkan import data user disini</b></h4>

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            {{-- <label for="file" class="form-label">File excel</label> --}}
            <input class="form-control" type="file" id="file" name="file" required>
        </div>

        <button type="submit" class="btn btn-primary">Import</button>
    </form>

    <hr>
    <br>
    <h3 class="font-bold">Data Relawan</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
        Tambah Data
    </button>

    <br>
    <div class="container">
        <div class="table-responsive-sm" style="width: 95%">
            <table id="table" class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <th class="text-center">NIK</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">TPS</th>
                    <th class="text-center">Kelurahan</th>
                    <th class="text-center">Kecamatan</th>
                    <th class="text-center">Aksi</th>
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
                                <td>
                                    <!-- Delete Button -->
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="setDeleteAction('{{ route('destroy', $dt->id) }}')">
                                        Hapus
                                    </button>
                                </td>
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

    <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="tps" class="form-label">TPS</label>
                            <input type="text" class="form-control" id="tps" name="tps" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('costum-script')
    <script>
        $('#table').DataTable();

        function setDeleteAction(actionUrl) {
            document.getElementById('deleteForm').action = actionUrl;
        }
    </script>
@endpush
