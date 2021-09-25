<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Addon
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $addon_category_id
 * @property string $name
 * @property int $is_checked
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AddonCategory $AddonCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Addon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Addon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Addon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Addon whereAddonCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Addon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Addon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Addon whereIsChecked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Addon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Addon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Addon whereVendorId($value)
 * @mixin Eloquent
 */
class Addon extends Eloquent
{
    use HasFactory;

    protected $table = 'addon';

    protected $fillable = ['vendor_id', 'addon_category_id', 'name', 'is_checked'];

    public function AddonCategory() {
        return $this->belongsTo('App\Models\AddonCategory');
    }
}
