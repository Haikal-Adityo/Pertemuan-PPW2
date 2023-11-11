<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Buku') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 5%">
        <div class="w-full max-w">

            @if(count($errors) > 0)
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="judul">Judul</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" class="form-control" name="judul" id="judul">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="penulis">Penulis</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" class="form-control" name="penulis" id="penulis">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="harga">Harga</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" class="form-control" name="harga" id="harga">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tgl_terbit">Tanggal Terbit</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date" class="form-control" name="tgl_terbit" id="tgl_terbit">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">Thumbnail</label> 
                    <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                </div>
            
                {{-- GALLERY --}}
                <div class="col-span-full mt-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gallery">Gallery</label>
                    <div class="mt-2 mb-3" id="fileinput_wrapper">
                        
                    </div>
                    <a href="javascript:void(0);" id="tambah" class="btn btn-success mb-4" onclick="addFileInput()">+ Tambah</a>
                    <script type="text/javascript">
                        function addFileInput () {
                            var div = document.getElementById('fileinput_wrapper');
                            div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-2 form-control">';
                        };
                    </script>
                </div>

                <hr>

                <div class="mt-3 flex justify-end">
                    <button type="submit" class="btn btn-primary" style="background-color: #0069D9;"><i class="fa-regular fa-floppy-disk"></i>&nbsp;Simpan</button>
                    <a href="/buku" class="btn btn-danger"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>