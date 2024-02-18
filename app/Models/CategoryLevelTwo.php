<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLevelTwo extends Model
{
    use HasFactory;
    protected $table='category_level_two';
    protected $guarded=[];
    public $timestamps=false;
}
