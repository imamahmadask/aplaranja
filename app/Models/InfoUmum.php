<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoUmum extends Model
{
    use HasFactory;

    protected $table = 'info_umums';

    protected $fillable = [
        'nama', 'deskripsi', 'gambar'
    ];
}
