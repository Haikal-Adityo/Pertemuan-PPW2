<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Buku</title>
</head>
<body style="padding: 16px">
    <a style="float: right;" href="{{ route('buku.create') }}">
        <button class="btn btn-warning">+ Tambah Buku</button>
    </a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tgl. Terbit</th>
                <th>Aksi</th>   
            </tr>
        </thead>
        <tbody>
           @foreach($data_buku as $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ ($buku->tgl_terbit)->format('d/m/Y') }}</td>
                    <td>
                        <div class="btn-group" role="group" style="overflow-x: auto;">
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary">Edit</a>
                            &nbsp;
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger" onClick="return confirm('Are you sure?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                    
                </tr>
           @endforeach
        </tbody>
   </table>
   <h4>Jumlah data yang dimiliki = {{ $count }}</h4>
   <h4>Total harga semua buku = {{ "Rp ".number_format($total, 2, ',', '.') }}</h4>
</body>
</html>