<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Buku Edit</title>
</head>
<body class="container" style="margin-top: 16px">
    <div class="card">
        <div class="card-header text-center" style="background-color: #0B5ED7; color: white"><h2>Edit Buku</h2></div>
        <div class="card-body">
            @if(count($errors) > 0)
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li style="margin-left: 16px">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form method="POST" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            <div class="form-group">
                <label for="inputJudul">Judul</label> 
                <input type="text" class="form-control" name="judul" id="inputJudul" value="{{ $buku->judul }}">
            </div>
            <div class="form-group">
                <label for="inputPenulis">Penulis</label> 
                <input type="text" class="form-control" name="penulis" id="inputPenulis" value="{{ $buku->penulis }}">
            </div>
            <div class="form-group">
                <label for="inputHarga">Harga</label> 
                <input type="text" class="form-control" name="harga" id="inputHarga" value="{{ $buku->harga }}">
            </div>
            <div class="form-group">
                <label for="inputTgl_terbit">Tanggal Terbit</label> 
                @php
                    $formattedDate = date('Y-m-d', strtotime(str_replace('/', '-', $buku->tgl_terbit)));
                @endphp
                <input type="date" class="form-control" name="tgl_terbit" id="inputTgl_terbit" value="{{ $formattedDate }}">
            </div>
            
            &nbsp;
            <div>
                <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i>&nbsp;Simpan</button>
                <a href="/buku" class="btn btn-danger"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
            </div>
        </div>
    </div>
</body>
</html>