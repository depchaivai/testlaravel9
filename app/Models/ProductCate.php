<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCate extends Model
{
    use HasFactory;
    protected $table = 'product_cate';
    public $timestamps = false;
    protected $fillable  = [
        'product_id','cate_id'
    ];
}
