<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'id',
        'nama_galeri',
        'path',
        'foto',
        'buku_id',
    ];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }

    use HasFactory;
}
