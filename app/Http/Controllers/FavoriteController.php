<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Buku;
use App\Models\User;

class FavoriteController extends Controller
{
    public function favoriteBuku($id)
    {
        $userId = Auth::id();
        $buku = Buku::findOrFail($id);
    
        $user = User::find($userId);
    
        if ($user->favorites()->toggle($buku)) {
            return redirect()->back()->with('pesan', 'Book added to favorites.');
        } else {
            return redirect()->back()->with('pesan', 'Book removed from favorites.');
        }
    }
    

}
