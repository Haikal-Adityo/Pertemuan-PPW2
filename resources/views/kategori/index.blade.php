<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kategori') }}
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
                <div class="d-flex justify-content-between">
                    <a style="left: right; margin-bottom: 16px" href="{{ route('kategori.create') }}">
                        @if(Auth::user()->level == 'admin')
                        <button class="btn btn-success"><i class="fa-solid fa-plus"></i>&nbsp;Tambah Kategori</button>
                        @endif
                    </a>
                </div>

                <table class="table table-striped table-bordered table-fixed">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;">No.</th>
                            <th scope="col" style="width: 80%;">Name</th>
                            @if(Auth::user()->level == 'admin')
                                <th scope="col" style="width: 20%;">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_kategori as $kategori)
                        <tr>
                            
                            <td>{{ ++$no }}</td>
                            <td>{{ $kategori->name }}</td>
                            @if(Auth::user()->level == 'admin')
                                <td>
                                    <div class="btn-group" role="group" style="overflow-x: auto;">
                                        <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-primary mr-3"><i class="fa-regular fa-pen-to-square"></i>&nbsp;Edit</a>
                                        &nbsp;
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger" onClick="return confirm('Are you sure?')"><i class="fas fa-trash"></i>&nbsp;Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>                
                
                <div>{{ $data_kategori->links('vendor.pagination.bootstrap-5') }}</div>

            </div>
        </div>
    </div>

</x-app-layout>