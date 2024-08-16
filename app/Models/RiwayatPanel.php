<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPanel extends Model
{
    use HasFactory;

    protected $table = 'riwayat_panels';

    protected $fillable = [
        'tanggal', 'jenis', 'kerusakan', 'perbaikan', 'keterangan', 'panel_id', 'regu_id', 'alat', 'bahan'
    ];

    public function regu() :BelongsTo
    {
        return $this->belongsTo(Regu::class);
    }

    public function panel() :BelongsTo
    {
        return $this->belongsTo(Panel::class);
    }
}
