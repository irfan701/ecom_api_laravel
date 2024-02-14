<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class HomeSeo extends Model
{
    use HasApiTokens;
    use HasFactory;
    protected $table='home_seo';
    protected $guarded=[];
    public $timestamps=false;
}
