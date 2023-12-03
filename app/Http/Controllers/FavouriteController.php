<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\User;

class FavouriteController extends Controller
{
    public function favouriteBuku($id)
    {
        $userId = Auth::id();
        $user = User::find($userId);
    
        $buku = Buku::findOrFail($id);
    
        if ($user->favourites()->where('buku_id', $buku->id)->exists()) {
            $user->favourites()->detach($buku->id);
            return redirect()->back()->with('pesan', 'Buku berhasil dihapus dari favourites :(');
        } else {
            $user->favourites()->attach($buku->id);
            return redirect()->back()->with('pesan', 'Buku berhasil ditambah kedalam favourites :)');
        }
    }
    
}
