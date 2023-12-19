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

                <table class="table table-striped table-bordered table-fixed">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 50px;">No.</th>
                            <th scope="col" style="width: 100%;">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_kategori as $kategori)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>
                                <a href="{{ route('buku.showBuku', $kategori->id) }}">{{ $kategori->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>                
                
                <div>{{ $data_kategori->links('vendor.pagination.bootstrap-5') }}</div>

            </div>
        </div>
    </div>

</x-app-layout>
