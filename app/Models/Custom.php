<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use HasFactory;

    protected $table = 'custom'; // ✅ tambahkan ini

    protected $fillable = [
        'photo_id', 'sticker_used', 'shape_used', 'color_frame'
    ];

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
