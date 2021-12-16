<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property int|null $price
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuAddon[] $GroupMenuAddon
 * @property-read int|null $group_menu_addon_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuAddon[] $MenuAddon
 * @property-read int|null $menu_addon_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuSize[] $MenuSize
 * @property-read int|null $menu_size_count
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereVendorId($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
  use HasFactory;

  protected $table = 'menu';

  protected $fillable = ['vendor_id', 'name', 'image', 'description', 'price', 'display_price', 'display_discount_price'];

  protected $casts = [
    'price' => 'decimal:2',
    'display_price' => 'decimal:2',
    'display_discount_price' => 'decimal:2',
  ];

  protected $appends = ['image', 'is_added'];

  public function getIsAddedAttribute()
  {
    return false;
  }

  public function getImageAttribute()
  {
    return url('images/upload') . '/' . $this->attributes['image'];
  }

  public function MenuSize()
  {
    return $this->hasMany('App\Models\MenuSize');
  }

  public function MenuAddon()
  {
    return $this->hasMany('App\Models\MenuAddon');
  }

  public function GroupMenuAddon()
  {
    // return $this->hasMany('App\Models\MenuAddon');
      return $this->hasMany('App\Models\MenuAddon')->groupBy('addon_category_id');
  }

  public function SingleMenu()
  {
    return $this->hasMany('App\Models\SingleMenu');
  }
}
