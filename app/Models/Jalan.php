<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jalan extends Model
{
    use HasFactory;

    protected $table = 'jalans';

    protected $fillable = [
        'kode', 'nama', 'panjang', 'lebar'
    ];

    public function panel(): HasMany
    {
        return $this->hasMany(Panel::class);
    }
}
