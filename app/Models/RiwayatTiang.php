<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatTiang extends Model
{
    use HasFactory;

    protected $table = 'riwayat_tiangs';

    protected $fillable = [
        'tanggal', 'jenis', 'kerusakan', 'perbaikan', 'keterangan', 'tiang_id', 'regu_id'
    ];

    public function regu() :BelongsTo
    {
        return $this->belongsTo(Regu::class);
    }

    public function tiang() :BelongsTo
    {
        return $this->belongsTo(Tiang::class);
    }
}
