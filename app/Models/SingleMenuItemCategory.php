<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleMenuItemCategory extends Eloquent
{
    use HasFactory;

    protected $table = 'single_menu_item_category';

    protected $fillable = ['vendor_id', 'single_menu_id', 'item_category_id'];

    public function ItemCategory() {
        return $this->belongsTo('App\Models\ItemCategory');
    }
}
