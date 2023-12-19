<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Attach/Detach Kategori to Buku') }}
        </h2>
    </x-slot>

    <div class="container" style="margin-top: 5%">

        <form action="{{ route('buku.attachKategoris', $buku->id) }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="kategori_ids" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Kategori</label>
                <select name="kategori_ids[]" id="kategori_ids" class="form-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple>
                    @foreach($data_kategori as $kategori)
                        <option value="{{ $kategori->id }}" {{ optional($buku->kategoris)->contains('id', $kategori->id) ? 'selected' : '' }}>
                            {{ $kategori->name }}
                        </option>
                    @endforeach
                </select>
                
            </div>
            <button type="submit" class="btn btn-primary ml-3" style="background-color: #0069D9;">
                <i class="fa-regular fa-floppy-disk"></i>&nbsp;Save Changes
            </button>
        </form>

        <div class="mt-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Attached Kategori</h3>
            @forelse($buku->kategori as $attachedKategori)
                <span class="inline-block bg-gray-200 dark:bg-gray-700 rounded-full px-3 py-1 text-sm font-semibold text-gray-800 dark:text-gray-200 mr-2 mb-2">
                    {{ $attachedKategori->name }}
                    <a href="{{ route('buku.detachKategori', ['id' => $buku->id, 'kategori_id' => $attachedKategori->id]) }}"
                       class="text-red-600 dark:text-red-400 ml-1 hover:underline"
                       onclick="return confirm('Are you sure you want to detach this kategori?')"
                    >
                        Detach
                    </a>
                </span>
            @empty
                <p class="text-gray-500 dark:text-gray-400">No kategori attached.</p>
            @endforelse
        </div>

    </div>

</x-app-layout>
