<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSize extends Model
{
    use HasFactory;

    protected $table = 'menu_size';

    protected $fillable = ['vendor_id','menu_id','item_size_id','price'];

    public function MenuAddon() {
        return $this->hasMany('App\Models\MenuAddon');
    }

    public function AddonCategory() {
        return $this->hasMany('App\Models\MenuAddon')->groupBy('addon_category_id');
    }

    public function ItemSize() {
        return $this->belongsTo('App\Models\ItemSize');
    }
}
