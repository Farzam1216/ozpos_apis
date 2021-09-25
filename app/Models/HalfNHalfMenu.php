<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HalfNHalfMenu
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $menu_category_id
 * @property int $item_category_id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property int $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ItemCategory $ItemCategory
 * @property-read \App\Models\MenuCategory $MenuCategory
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereItemCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereMenuCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HalfNHalfMenu whereVendorId($value)
 * @mixin Eloquent
 */
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
