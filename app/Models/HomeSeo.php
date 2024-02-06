<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSeo extends Model
{
    use HasFactory;
    protected $table='home_seo';
    protected $guarded=[];
    public $timestamps=false;
}
