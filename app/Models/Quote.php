<?php

namespace App\Models;

use App\Models\Trait\UUIDKey;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quote';

    public function novel()
    {
        return $this->belongsTo(Book::class, 'id_book');
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_quote');
    }
}
