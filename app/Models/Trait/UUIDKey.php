<?php

namespace App\Models\Trait;

use Illuminate\Support\Str;

trait UUIDKey
{

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->id = (string) Str::orderedUuid();
        });
    }
}
