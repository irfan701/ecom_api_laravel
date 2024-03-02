<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table='products';
    protected $guarded=[];

    function category1()
    {
        return $this->belongsTo(CategoryLevelOne::class,'cat1_id','id');
    }
    function category2()
    {
        return $this->belongsTo(CategoryLevelTwo::class,'cat2_id','id');
    }
    function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
}
