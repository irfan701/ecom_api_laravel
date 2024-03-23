<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    protected $table='product_details';
    protected $guarded=[];
    public $timestamps=false;

    function products(){
        return $this->hasOne(Products::class,'product_id','id');
    }
}
