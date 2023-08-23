<?php

namespace App\Models;

use App\Models\Trait\UUIDKey;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dosen extends Authenticatable
{
    protected $table = 'dosen';

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getNamaGelarAttribute()
    {
        $nama = "";
        if ($this->gelar_depan) $nama .= $this->gelar_depan . " ";
        $nama .= $this->nama;
        if ($this->gelar_belakang) $nama .= ", " . $this->gelar_belakang;
        return $nama;
    }
}
