<?php

namespace App\Models;

use App\Models\Quote;
use App\Models\Mahasiswa;
use App\Models\Trait\UUIDKey;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
    public function quote()
    {
        return $this->belongsTo(Quote::class, 'id_book');
    }
}
