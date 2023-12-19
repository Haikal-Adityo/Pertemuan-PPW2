<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Kategori') }}
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

            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('kategori.update', $kategori->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label> 
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" class="form-control" name="name" id="name" value="{{ $kategori->name }}">
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