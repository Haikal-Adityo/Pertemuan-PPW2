<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Buku Create</title>
</head>
<body>
    @section('content')
    <div class="container">
        <h2>Tambah Buku</h2>
        <form method="POST" action="{{ route('buku.store') }}">
        @csrf
            <div class="form-group">
                <label for="inputJudul">Judul</label> 
                <input type="text" class="form-control" name="judul" id="inputJudul">
            </div>
            <div class="form-group">
                <label for="inputPenulis">Penulis</label> 
                <input type="text" class="form-control" name="penulis" id="inputPenulis">
            </div>
            <div class="form-group">
                <label for="inputHarga">Harga</label> 
                <input type="text" class="form-control" name="harga" id="inputHarga">
            </div>
            <div class="form-group">
                <label for="inputTgl_terbit">Tanggal Terbit</label> 
                <input type="date" class="form-control" name="tgl_terbit" id="inputTgl_terbit">
            </div> 
            &nbsp;
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/buku" class="btn btn-danger">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>