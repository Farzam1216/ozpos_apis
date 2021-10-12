<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DealsItems
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $menu_category_id
 * @property int $item_category_id
 * @property int $deals_menu_id
 * @property string $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ItemCategory $ItemCategory
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereDealsMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereItemCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereMenuCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DealsItems whereVendorId($value)
 * @mixin Eloquent
 */
class DealsItems extends Eloquent
{
    use HasFactory;

    protected $table = 'deals_items';
    protected $primaryKey = 'id';

    protected $fillable = ['vendor_id', 'menu_category_id', 'item_category_id', 'item_size_id', 'deals_menu_id', 'name'];

    public function ItemCategory() {
        return $this->belongsTo('App\Models\ItemCategory');
    }

    public function ItemSize() {
        return $this->belongsTo('App\Models\ItemSize');
    }
}
