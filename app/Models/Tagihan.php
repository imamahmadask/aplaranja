<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $fillable = [
        'panel_id',
        'idpel',
        'nama',
        'alamat',
        'tarif',
        'daya',
        'blth',
        'bulan',
        'tahun',
        'pemkwh',
        'rptag',
        'materai',
        'admin',
        'total'
    ];

    public function panel(): BelongsTo
    {
        return $this->belongsTo(Panel::class);
    }
}
