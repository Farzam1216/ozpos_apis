<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Eloquent
{
    use HasFactory;

    protected $table = 'addon';

    protected $fillable = ['vendor_id', 'addon_category_id', 'name'];

    public function AddonCategory() {
        return $this->belongsTo('App\Models\AddonCategory');
    }
}
