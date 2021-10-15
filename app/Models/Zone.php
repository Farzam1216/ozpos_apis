<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Zone extends Model
{
   use HasFactory;
   use SpatialTrait;
   
   protected $spatialFields = [
       'coordinates'
   ];
}
