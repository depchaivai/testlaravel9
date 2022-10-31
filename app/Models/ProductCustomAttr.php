<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomAttr extends Model
{
    use HasFactory;
    protected $table = 'product_custom_attributes';
    public $timestamps = false;
}
