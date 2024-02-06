<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryTwo extends Model
{
    use HasFactory;
    protected $table='sub_category_two';
    protected $guarded=[];
    public $timestamps=false;
}
