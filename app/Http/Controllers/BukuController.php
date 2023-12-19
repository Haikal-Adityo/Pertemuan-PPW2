<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
//* TAMBAHKAN KODE BERIKUT UNTUK MEMANGGIL MODEL BUKU
use App\Models\Buku;
use Intervention\Image\Facades\Image;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
// use Image;

class BukuController extends Controller
{
    public function __construct(){
        $this->middleware("auth");
    }

    //* FUNGSI INDEX
    public function index() {
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $jumlah_harga = Buku::sum('harga');
        return view('buku.index', compact('data_buku','no', 'jumlah_buku', 'jumlah_harga'));
    }

    public function list()
    {
        $batas = 5;
        $data_buku = Buku::with('ratings')->orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
    
        return view('buku.list', compact('data_buku', 'no'));
    }    
    
    public function listSearch(Request $request){
        $request->validate([
            'kata' => 'required|string',
        ]);
    
        $batas = 5;
        $cari = $request->kata;
        
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")
                         ->orWhere('penulis', 'like', "%".$cari."%")
                         ->paginate($batas);
    
        $jumlah_buku = Buku::count();
        $no = $batas * ($data_buku->currentPage() - 1);
        
        return view('buku.list-search', compact('data_buku', 'no', 'jumlah_buku', 'cari'));
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
            'thumbnail' => 'image|mimes:jpeg,jpg,png,webp|max:2048'
        ]);

        $buku = Buku::find($id);

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit
        ]);
        
        if($request->file('thumbnail')) {
            $fileName = time().'-'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240,320)
                ->save();

            $buku->update([
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath
            ]);
        };

        if($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'.$filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
                
            }
        };

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Diubah');
    }

    // * FUNGSI STORE
    public function store(Request $request) {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
        ]);

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;

        // * HANDLE THUMBNAIL
        if ($request->file('thumbnail')) {
            $thumbnailFileName = time() . '-' . $request->thumbnail->getClientOriginalName();
            $thumbnailFilePath = $request->file('thumbnail')->storeAs('uploads', $thumbnailFileName, 'public');

            Image::make(storage_path() . '/app/public/uploads/' . $thumbnailFileName)
                ->fit(240, 320)
                ->save();

            $buku->filename = $thumbnailFileName;
            $buku->filepath = '/storage/' . $thumbnailFilePath;
        }

        $buku->save();

        // * HANDLE GALLERY
        if ($request->file('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryFileName = time() . '_' . $file->getClientOriginalName();
                $galleryFilePath = $file->storeAs('uploads', $galleryFileName, 'public');

                $gallery = new Gallery;
                $gallery->nama_galeri = $galleryFileName;
                $gallery->path = '/storage/' . $galleryFilePath;
                $gallery->foto = $galleryFileName;
                $gallery->buku_id = $buku->id;
                $gallery->save();
            }
        }

        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
    }


    // * FUNGSI DESTROY
    public function destroy($id) {
        $buku = Buku::find($id);
    
        if (!$buku) {
            return redirect('/buku')->with('error', 'Data Buku tidak ditemukan');
        }
    
        $buku->delete();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil Dihapus');
    }
    
    public function destroyImage($buku_id, $image_id) {
        $buku = Buku::find($buku_id);
        $image = Gallery::find($image_id);
    
        if ($image && $buku && $image->buku_id === $buku->id) {
            $image->delete();
            return back()->with('pesan', 'Image deleted successfully');
        } else {
            return back()->with('error', 'Image not found or does not belong to the book');
        }
    }
    

    // * FUNGSI SEARCH
    public function search(Request $request){
        $request->validate([
            'kata' => 'required|string',
        ]);
    
        $batas = 5;
        $cari = $request->kata;
        
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")
                         ->orWhere('penulis', 'like', "%".$cari."%")
                         ->paginate($batas);
    
        $jumlah_buku = Buku::count();
        $no = $batas * ($data_buku->currentPage() - 1);
        
        return view('buku.search', compact('data_buku', 'no', 'jumlah_buku', 'cari'));
    }

    public function detailBuku($id) {
        $buku = Buku::find($id);
        $galeris = $buku->galleries()->orderBy('id', 'desc')->paginate(8);

        $rating = Rating::where('buku_id', $id)->avg('rating');
        $existingRating = Rating::where('user_id', Auth::id())
                            ->where('buku_id', $id)
                            ->first();

        return view('buku.detail', compact('buku', 'galeris', 'rating', 'existingRating'));
    }

    public function showFavouriteBuku()
    {
        $userId = Auth::id();
        $user = User::find($userId);

        $batas = 5;

        $favouriteBooks = $user->favourites()->paginate($batas);
        $no = $batas * ($favouriteBooks->currentPage() - 1);

        return view('buku.favourite', compact('favouriteBooks', 'no'));
    }

    public function showBukuPopuler()
    {
        $batas = 10;
    
        $data_buku = Buku::with('ratings')
            ->select('buku.*', DB::raw('AVG(rating.rating) as avg_rating'))
            ->leftJoin('rating', 'buku.id', '=', 'rating.buku_id')
            ->groupBy('id', 'judul', 'penulis', 'buku_seo', 'harga', 'tgl_terbit', 'created_at', 'updated_at', 'foto', 'filename', 'filepath')
            ->orderBy('avg_rating', 'desc')
            ->paginate($batas);
    
        $no = $batas * ($data_buku->currentPage() - 1);
    
        return view('buku.populer', compact('data_buku', 'no'));
    }

    public function attachKategorisForm($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return redirect('/buku')->with('error', 'Data Buku tidak ditemukan');
        }

        $data_kategori = Kategori::all();

        return view('buku.attachKategori', compact('buku', 'data_kategori'));
    }
    
    public function attachKategoris($bukuId, Request $request)
    {
        try {
            $buku = Buku::findOrFail($bukuId);

            $request->validate([
                'kategori_ids' => 'required|array',
                'kategori_ids.*' => 'exists:kategori,id',
            ]);

            $buku->kategori()->sync($request->input('kategori_ids'));

            return redirect()->route('buku.index')->with('pesan', 'Kategori berhasil ditambahkan ke Buku');
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/buku')->with('error', 'Data Buku tidak ditemukan');
            } catch (\Exception $e) {
            return redirect('/buku')->with('error', 'Terjadi kesalahan saat menambahkan kategori');
        }
    }

    public function detachKategori($id, $kategori_id)
    {
        try {
            $buku = Buku::find($id);
            $kategori = Kategori::find($kategori_id);

            if (!$buku || !$kategori) {
                return redirect()->back()->with('error', 'Invalid Buku or Kategori.');
            }

            $buku->kategori()->detach($kategori->id);

            return redirect()->back()->with('pesan', 'Kategori Berhasil Dilepas dari Buku');
        } catch (\Exception $e) {
            // Handle other exceptions if necessary
            return redirect()->back()->with('error', 'Terjadi kesalahan saat melepaskan kategori');
        }
    
    }
    public function listKategori()
    {
        $batas = 5;
        $data_kategori = Kategori::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_kategori->currentPage() - 1);
        return view('buku.kategori', compact('data_kategori', 'no'));
    }

    public function showBuku($id)
    {
        $kategori = Kategori::findOrFail($id);
        $bukuList = $kategori->buku;

        return view('buku.bukuKategori', compact('bukuList', 'kategori'));
    }

}
