<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLevelThree extends Model
{
    use HasFactory;
    protected $table='category_level_three';
    protected $guarded=[];
    public $timestamps=false;
}
