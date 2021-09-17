<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleMenu extends Eloquent
{
    use HasFactory;

    protected $table = 'single_menu';

    protected $fillable = ['vendor_id', 'menu_category_id', 'menu_id', 'status'];

    public function MenuCategory() {
        return $this->belongsTo('App\Models\MenuCategory');
    }

    public function Menu() {
        return $this->belongsTo('App\Models\Menu');
    }

    public function SingleMenuItemCategory() {
        return $this->hasMany('App\Models\SingleMenuItemCategory');
    }
}
