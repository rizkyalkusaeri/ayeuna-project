<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi NIK - Perhitungan Suara Arfi Yena</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container form-sign"><br>
        <div class="col-md-4 col-md-offset-4">
            <h3 class="text-center"><b>Verifikasi NIK</b><br>Perhitungan Suara Arfi Yena</h3>
            <hr>
            @if (session('error'))
                <div class="alert alert-danger">
                    <b>Opps!</b> {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('actionlogin') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control"
                        placeholder="Masukkan NIK anda untuk verifikasi" required="">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Log In</button>
                <hr>
            </form>
        </div>
    </div>
</body>

</html>
