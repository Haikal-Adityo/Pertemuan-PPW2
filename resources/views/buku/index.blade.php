<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv" crossorigin="anonymous">
    <title>Buku</title>
    <script>
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    </script>
    <style>
        .alert {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 99;
        }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 5%">
        @if(Session::has('pesan'))
            <div class="alert alert-success fade show" id="success-alert" role="alert">{{ Session::get('pesan') }}</div>
        @endif

        @if(count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li style="list-style: none;">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="card">
            <div class="card-header text-center" style="background-color: #0B5ED7; color: white"><h2>Daftar Buku</h2></div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <a style="left: right; margin-bottom: 16px" href="{{ route('buku.create') }}">
                        <button class="btn btn-success"><i class="fa-solid fa-plus"></i>&nbsp;Tambah Buku</button>
                    </a>
                    <form action="{{ route('buku.search') }}" method="get">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="kata" class="form-control" placeholder="Cari..." aria-label="Cari" style="border-radius: 8px 0 0 8px">
                            <button type="submit" class="btn btn-primary" style="border-radius: 0 8px 8px 0">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    
                </div>
                <table class="table table-striped table-bordered">
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
                                <td>{{ ++$no }}</td>
                                <td>{{ $buku->judul }}</td>
                                <td>{{ $buku->penulis }}</td>
                                <td>{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                                <td>{{ ($buku->tgl_terbit)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group" style="overflow-x: auto;">
                                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Edit</a>
                                        &nbsp;
                                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger" onClick="return confirm('Are you sure?')"><i class="fas fa-trash"></i>&nbsp;Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>{{ $data_buku->links('vendor.pagination.bootstrap-5') }}</div>
                <div><strong>Jumlah Buku : {{ $jumlah_buku }}</strong></div>
                <div><strong>Jumlah Harga Buku : {{ "Rp ".number_format($jumlah_harga, 0, ',', '.') }}</strong></div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>