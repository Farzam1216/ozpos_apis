<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = ['vendor_id','name','image','description','price'];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['image'];
    }

    public function MenuSize() {
        return $this->hasMany('App\Models\MenuSize');
    }

    public function MenuAddon() {
        return $this->hasMany('App\Models\MenuAddon');
    }

    public function GroupMenuAddon() {
       return $this->hasMany('App\Models\MenuAddon');
//       return $this->hasMany('App\Models\MenuAddon')->groupBy('addon_category_id');
    }
}
