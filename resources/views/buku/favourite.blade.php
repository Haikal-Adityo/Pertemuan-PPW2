<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku Favorit') }}
        </h2>
    </x-slot>

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
            <div class="card-body">

                <table class="table table-striped table-bordered table-fixed">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;">No.</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Penulis</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($favouriteBooks as $buku)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                <a href="{{ route('buku.detail', $buku->id) }}">
                                    <div class="flex items-center">
                                        @if ($buku->filepath)
                                            <div class="relative h-10 w-10">
                                                <img
                                                    class="h-full w-full rounded-full object-cover object-center"
                                                    src="{{ asset($buku->filepath) }}"
                                                    alt="thumbnail"
                                                />
                                            </div>
                                        @endif
                                        <span class="ml-2">{{ $buku->judul }}</span>
                                    </div>
                                </a>
                            </td>
                            <td>{{ $buku->penulis }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>                
                
                <div>{{ $favouriteBooks->links('vendor.pagination.bootstrap-5') }}</div>

            </div>
        </div>
    </div>

</x-app-layout>
