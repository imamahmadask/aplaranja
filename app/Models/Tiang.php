<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tiang extends Model
{
    use HasFactory;

    protected $table = 'tiangs';

    protected $fillable = [
        'kode', 'kategori', 'jenis', 'lengan', 'tahun_pengadaan', 'jaringan',
        'lat', 'long', 'panel_id', 'lampu', 'posisi_tiang'
    ];

    public function panel(): BelongsTo
    {
        return $this->belongsTo(Panel::class);
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(RiwayatTiang::class);
    }
}
