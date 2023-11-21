<x-app-layout>

    <head>
        <link href="path/to/lightbox.css" rel="stylesheet" />
    </head>

    <section id="album" class="py-1 text-center bg-light">
        <div class="container">
            <h1 class="text-3xl font-semibold mb-4">Buku: {{ $buku->judul }}</h1>
            <hr class="mb-4">
    
            <div class="flex flex-wrap -mx-4">
                @forelse ($galeris as $gallery)
                    <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 px-4 mb-8">
                        <div class="bg-white rounded-lg overflow-hidden shadow-md">
                            <a href="{{ asset($gallery->path) }}" data-lightbox="image-1" data-title="{{ $gallery->keterangan }}">
                                <img src="{{ asset($gallery->path) }}" alt="{{ $gallery->nama_galeri }}" class="mx-auto">
                            </a>                            
                            <div class="p-4">
                                <h5 class="text-lg font-semibold mb-2">{{ $gallery->nama_galeri }}</h5>
                                <p class="text-gray-600">{{ $gallery->keterangan }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full px-4 mb-8">
                        <p class="text-center text-gray-600">No images found.</p>
                    </div>
                @endforelse
            </div>
    
            <div class="mt-2">{{ $galeris->links('vendor.pagination.bootstrap-5') }}</div>
        </div>
    </section>    
    
</x-app-layout>