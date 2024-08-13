<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Regu extends Model
{
    use HasFactory;

    protected $table = 'regus';

    protected $fillable = [
        'kode', 'nama', 'jml_anggota'
    ];

    public function riwayatPanel(): HasMany
    {
        return $this->hasMany(RiwayatPanel::class);
    }

    public function riwayatTiang(): HasMany
    {
        return $this->hasMany(RiwayatTiang::class);
    }
}
