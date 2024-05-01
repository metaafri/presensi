<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['nik', 'jam_in', 'jam_out', 'picture_in', 'picture_out', 'location_in', 'location_out'];
}
