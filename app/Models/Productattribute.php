<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productattribute extends Model
{
    use HasFactory;
    protected $table = "Product_attributes";
    public $timestamps = false;
    protected $fillable  = [
        'material_id', 'product_id'
    ];
}
