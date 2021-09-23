<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HalfNHalfMenu extends Eloquent
{
    use HasFactory;

    protected $table = 'half_n_half_menu';

    protected $fillable = ['vendor_id', 'menu_category_id', 'item_category_id', 'name', 'image', 'description', 'status'];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['image'];
    }

    public function MenuCategory() {
        return $this->belongsTo('App\Models\MenuCategory');
    }

    public function ItemCategory() {
        return $this->belongsTo('App\Models\ItemCategory');
    }
}
