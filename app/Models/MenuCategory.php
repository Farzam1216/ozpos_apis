<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Eloquent
{
    use HasFactory;

    protected $table = 'menu_category';

    protected $fillable = ['vendor_id', 'name', 'status', 'type'];

    public function SingleMenu() {
        return $this->hasMany('App\Models\SingleMenu');
    }

    public function HalfNHalfMenu() {
        return $this->hasMany('App\Models\HalfNHalfMenu');
    }

    public function DealsMenu() {
        return $this->hasMany('App\Models\DealsMenu');
    }
}
