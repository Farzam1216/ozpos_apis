<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SingleMenu
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $menu_category_id
 * @property int $menu_id
 * @property int $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Menu $Menu
 * @property-read \App\Models\MenuCategory $MenuCategory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SingleMenuItemCategory[] $SingleMenuItemCategory
 * @property-read int|null $single_menu_item_category_count
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu whereMenuCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenu whereVendorId($value)
 * @mixin Eloquent
 */
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
