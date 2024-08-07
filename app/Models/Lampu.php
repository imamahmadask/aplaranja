<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampu extends Model
{
    use HasFactory;

    protected $table = 'lampus';

    protected $fillable = [
        'jenis', 'daya', 'merek', 'tiang_id'
    ];
}
