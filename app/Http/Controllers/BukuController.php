<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//* TAMBAHKAN KODE BERIKUT UNTUK MEMANGGIL MODEL BUKU
use App\Models\Buku;

class BukuController extends Controller
{
    //* FUNGSI INDEX
    public function index() {
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = 1 + ($batas * ($data_buku->currentPage() - 1));
        $jumlah_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku','no', 'jumlah_buku', 'jumlah_harga'));
    }

    // * FUNGSI CREATE
    public function create() {
        return view('buku.create');
    }

    // * FUNGSI EDIT
    public function edit($id) {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    // * FUNGSI UPDATE
    public function update(Request $request, $id){
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);
        
        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
        ]);
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
    }

    // * FUNGSI STORE
    public function store(Request $request) {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
        ]);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
    }

    // * FUNGSI DESTROY
    public function destroy($id) {
    $buku = Buku::find($id);
    $buku->delete();
    return redirect('/buku')->with('pesan', 'Data Buku Berhasil Dihapus');
    }

    // * FUNGSI SEARCH
    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")
            ->paginate($batas);
        $jumlah_buku = Buku::count();
        $no = 1 + ($batas * ($data_buku->currentPage() - 1));
        return view('buku.search', compact('data_buku','no', 'jumlah_buku', 'cari'));
    }

}
