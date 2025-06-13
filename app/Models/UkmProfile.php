<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkmProfile extends Model
{
    /** @use HasFactory<\Database\Factories\UkmProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'logo',
        'kontak',
    ];
}
