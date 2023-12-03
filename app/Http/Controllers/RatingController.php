<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Buku;

class RatingController extends Controller
{
    public function ratingBuku(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $existingRating = Rating::where('user_id', Auth::id())
                                ->where('buku_id', $id)
                                ->first();
    
        if ($existingRating) {
    
            $existingRating->update([
                'rating' => $request->rating,
            ]);
    
            return redirect()->back()->with('pesan', 'Rating Anda berhasil diubah :)');
        }
    
        $newRating = new Rating([
            'buku_id' => $id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
        ]);
    
        $newRating->save();
    
        return redirect()->back()->with('pesan', 'Rating Anda telah berhasil dikirim :)');
    }
}
