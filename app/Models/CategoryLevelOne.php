<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLevelOne extends Model
{
    use HasFactory;
    protected $table='category_level_one';
    protected $guarded=[];
    public $timestamps=false;
}
