<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tiang extends Model
{
    use HasFactory;

    protected $table = 'tiangs';

    protected $fillable = [
        'kode', 'kategori', 'jenis', 'lengan', 'tahun_pengadaan', 'jaringan',
        'kordinat', 'panel_id', 'lampu',
    ];

    public function panel(): BelongsTo
    {
        return $this->belongsTo(Panel::class);
    }
}
