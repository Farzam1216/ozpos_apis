<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SingleMenuItemCategory
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $single_menu_id
 * @property int $item_category_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ItemCategory $ItemCategory
 * @property-read \App\Models\SingleMenu $SingleMenu
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory whereItemCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory whereSingleMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SingleMenuItemCategory whereVendorId($value)
 * @mixin Eloquent
 */
class SingleMenuItemCategory extends Eloquent
{
    use HasFactory;

    protected $table = 'single_menu_item_category';

    protected $fillable = ['vendor_id', 'single_menu_id', 'item_category_id'];

    public function ItemCategory() {
        return $this->belongsTo('App\Models\ItemCategory');
    }

    public function SingleMenu() {
        return $this->belongsTo('App\Models\SingleMenu');
    }
}
