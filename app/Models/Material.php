<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = "Material";
    public $timestamps = false;
    protected $fillable  = [
        'name','slug','type','image','eng_name'
    ];
    public function type(){
        return $this->hasOne(Materialtype::class,'id','type');
    }
}
