<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 5%">
        <div class="card">
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
                    <button type="submit" class="btn btn-primary" style="background-color: #0069D9;"><i class="fa-regular fa-floppy-disk"></i>&nbsp;Simpan</button>
                    <a href="/buku" class="btn btn-danger"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>