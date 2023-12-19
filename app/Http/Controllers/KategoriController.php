<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $batas = 5;
        $data_kategori = Kategori::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_kategori->currentPage() - 1);
        return view('kategori.index', compact('data_kategori', 'no'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kategori,name|max:255',
        ]);

        Kategori::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('kategori.index')->with('pesan', 'Kategori berhasil dibuat');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data Kategori tidak ditemukan');
        }

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data Kategori tidak ditemukan');
        }

        $request->validate([
            'name' => 'required|unique:kategori,name,' . $kategori->id . '|max:255',
        ]);

        $kategori->update([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('kategori.index')->with('pesan', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data Kategori tidak ditemukan');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')->with('pesan', 'Kategori berhasil dihapus');
    }

}

