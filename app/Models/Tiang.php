<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiang extends Model
{
    use HasFactory;

    protected $table = 'tiangs';

    protected $fillable = [
        'kode', 'kategori', 'jenis', 'lengan', 'tahun', 'bahan', 'panel_id'
    ];
}
