<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialtype extends Model
{
    use HasFactory;
    protected $table = "Material_type";
    public $timestamps = false;
    protected $fillable = [
        'name', 'slug', 'eng_name',
    ];
}
