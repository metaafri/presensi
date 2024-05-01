<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submmission extends Model
{
    use HasFactory;

    protected $fillable = ['nik', 'description', 'status', 'approve', 'approve_at'];
}
