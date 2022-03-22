<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendorTable extends Model
{
    use HasFactory;
    public function booktables() {
      return $this->hasMany('App\Models\booktable');
    }
}
