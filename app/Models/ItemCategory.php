<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Eloquent
{
    use HasFactory;

    protected $table = 'item_category';

    protected $fillable = ['vendor_id', 'name'];
}
