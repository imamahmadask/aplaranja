<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Panel extends Model
{
    use HasFactory;

    protected $table = 'panels';

    protected $fillable = [
        'kode', 'kwh', 'idpel', 'jaringan', 'saklar', 'lat', 'long', 'kondisi_jaringan', 'jalan_id'
    ];

    public function jalan(): BelongsTo
    {
        return $this->belongsTo(Jalan::class);
    }

    public function tiang(): HasMany
    {
        return $this->hasMany(Tiang::class);
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(RiwayatPanel::class);
    }
}
