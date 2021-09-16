<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealsMenu extends Eloquent
{
    use HasFactory;

    protected $table = 'deals_menu';

    protected $fillable = ['vendor_id', 'menu_category_id', 'name', 'description', 'price', 'status'];

    public function MenuCategory() {
        return $this->belongsTo('App\Models\MenuCategory');
    }
}
