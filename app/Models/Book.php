<?php

namespace App\Models;

use App\Models\Trait\UUIDKey;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';

    public function quote()
    {
        return $this->hasMany(Quote::class, 'id_book');
    }

    public function getCoverImageUrlAttribute()
    {
        return $this->cover_image ?? '';
    }
}
