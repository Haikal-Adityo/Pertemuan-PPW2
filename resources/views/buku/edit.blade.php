<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Buku Edit</title>
</head>
<body>
    {{-- @extends('layouts.master') --}}

    @section('content')
    <div class="container">
        <h4>Edit Buku</h4>
        <form method="POST" action="{{ route('buku.update', $buku->id) }}">
        @csrf
            <div class="mb-3">Judul <input type="text" name="judul" value="{{ $buku->judul }}"></div>
            <div class="mb-3">Penulis <input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
            <div class="mb-3">Harga <input type="text" name="harga" value="{{ $buku->harga }}"></div>
            <div class="mb-3">Tgl. Terbit <input type="text" name="tgl_terbit" value="{{ $buku->tgl_terbit }}"></div>

            <div><button type="submit">Simpan</button></div>
            <a href="/buku">Batal</a>
        </form>
    </div>
</body>
</html>