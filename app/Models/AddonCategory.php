<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonCategory extends Eloquent
{
    use HasFactory;

    protected $table = 'addon_category';

    protected $fillable = ['vendor_id', 'name', 'min', 'max'];
}
