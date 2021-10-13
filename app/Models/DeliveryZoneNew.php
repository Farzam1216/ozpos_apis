<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryZoneNew extends Model
{
    use HasFactory;
    use  SpatialTrait;
    protected $spatialFields = [
      'coordinates'
  ];
    protected $fillable = ['name','vendor_id','coordinates','created_at','updated_id'];


}
