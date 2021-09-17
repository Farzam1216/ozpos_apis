<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAddon extends Model
{
    use HasFactory;

    protected $table = 'menu_addon';

    protected $fillable = ['vendor_id','menu_id','menu_size_id','addon_category_id','addon_id','price'];

    public function Addon() {
        return $this->belongsTo('App\Models\Addon');
    }

    public function AddonCategory() {
        return $this->belongsTo('App\Models\AddonCategory');
    }
}
