<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lampu extends Model
{
    use HasFactory;

    protected $table = 'lampus';

    protected $fillable = [
        'jenis', 'daya', 'merek', 'tiang_id', 'lumen', 'kondisi'
    ];

    public function tiang(): BelongsTo
    {
        return $this->belongsTo(Tiang::class);
    }

}
