<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable  = [
        'name','slug','sku','category','image','brand','description','long_description','room','content','collection','width','long','deep','weight'
    ];
    public function images(){
        return $this->hasMany(ProductImage::class,'product','id');
    }
}
