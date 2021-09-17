<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealsItems extends Eloquent
{
    use HasFactory;

    protected $table = 'deals_items';

    protected $fillable = ['vendor_id', 'menu_category_id', 'item_category_id', 'deals_menu_id', 'name'];

    public function ItemCategory() {
        return $this->belongsTo('App\Models\ItemCategory');
    }
}
