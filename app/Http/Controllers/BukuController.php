<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//* TAMBAHKAN KODE BERIKUT UNTUK MEMANGGIL MODEL BUKU
use App\Models\Buku;

class BukuController extends Controller
{
    //* FUNGSI INDEX
    public function index() {
        $data_buku = Buku::all();
        $count = Buku::count(); 
        $total = Buku::sum('harga');
        $no = 0;
        return view('buku.index', compact('data_buku','no', 'count', 'total'));
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
        $buku = Buku::find($id);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
        ]);
        return redirect('/buku');
    }


    // * FUNGSI STORE
    public function store(Request $request) {
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();
        return redirect('/buku');
    }

     // * FUNGSI DESTROY
     public function destroy($id) {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku');
     }

}
