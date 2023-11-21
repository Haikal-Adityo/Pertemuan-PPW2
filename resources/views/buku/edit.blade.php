<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 5%">
        <div class="w-full max-w">

            @if(count($errors) > 0)
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li style="margin-left: 16px">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="inputJudul">Judul</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" class="form-control" name="judul" id="inputJudul" value="{{ $buku->judul }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="inputPenulis">Penulis</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" class="form-control" name="penulis" id="inputPenulis" value="{{ $buku->penulis }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="inputHarga">Harga</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" class="form-control" name="harga" id="inputHarga" value="{{ $buku->harga }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="inputTgl_terbit">Tanggal Terbit</label> 
                    @php
                        $formattedDate = date('Y-m-d', strtotime(str_replace('/', '-', $buku->tgl_terbit)));
                    @endphp
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="date" class="form-control" name="tgl_terbit" id="inputTgl_terbit" value="{{ $formattedDate }}">
                </div>

                {{-- THUMBNAIL --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">Thumbnail</label> 
                    {{-- @if ( $buku->filepath )
                    <div class="relative h-20 w-20 mt-3 mb-3">
                        <img
                            class="h-full w-full object-cover object-center"
                            src="{{ asset($buku->filepath) }}"
                            alt="thumbnail"
                        />
                    </div>
                    @endif  --}}
                    <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPEG or JPG (MAX 2048kb).</p>
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
                    <button type="submit" class="btn btn-primary ml-3" style="background-color: #0069D9;"><i class="fa-regular fa-floppy-disk"></i>&nbsp;Simpan</button>
                    <a href="/buku" class="btn btn-danger ml-3"><i class="fa-solid fa-ban"></i>&nbsp;Batal</a>
                </div>
            </form>

            @if($buku->galleries()->count() > 0)
                <p class="block text-gray-700 text-xl font-bold mb-2">Image Gallery</p>
                <div class="gallery_items flex flex-wrap">
                    @foreach($buku->galleries()->get() as $gallery)
                        <div class="gallery_item m-3 relative">
                            <img
                            class="object-cover object-center"
                            src="{{ asset($gallery->path) }}"
                            alt=""
                            width="200"
                            />
                            <form action="{{ route('buku.destroyImage', [$buku->id, $gallery->id]) }}" method="POST" class="absolute top-1 right-1">
                                @csrf
                                <button class="btn btn-danger mt-1 mb-1" onClick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif         
           
        </div>
    </div>
</x-app-layout>