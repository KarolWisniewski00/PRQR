<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'name', 'model', 'serial', 'udt', 'instruction_path', 'udt_path', 'photo_path'
    ];
}
