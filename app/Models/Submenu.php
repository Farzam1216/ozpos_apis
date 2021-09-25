<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Submenu
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $menu_id
 * @property string $name
 * @property string|null $image
 * @property string $price
 * @property string $description
 * @property string $type
 * @property string $qty_reset
 * @property int $status
 * @property int|null $item_reset_value
 * @property int $is_excel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereIsExcel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereItemResetValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereQtyReset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submenu whereVendorId($value)
 * @mixin \Eloquent
 */
class Submenu extends Model
{
    use HasFactory;

    protected $table = 'submenu';

    protected $fillable = ['vendor_id','item_reset_value','menu_id','is_excel','name','image','price','description','type','qty_reset','status'];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['image'];
    }
}
