<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collection';
    protected $fillable = ['image','name','e_name'];
    public function products(){
        return $this->hasMany(Product::class,'collection','id');
    }
}
