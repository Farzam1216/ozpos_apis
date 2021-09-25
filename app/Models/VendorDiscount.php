<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VendorDiscount
 *
 * @property int $id
 * @property string $image
 * @property int $vendor_id
 * @property string $type
 * @property int $discount
 * @property string $min_item_amount
 * @property string $max_discount_amount
 * @property string $start_end_date
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount query()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereMaxDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereMinItemAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereStartEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorDiscount whereVendorId($value)
 * @mixin \Eloquent
 */
class VendorDiscount extends Model
{
    use HasFactory;

    protected $table = 'vendor_discount';

    protected $fillable = ['image','vendor_id','type','discount','min_item_amount','max_discount_amount','start_end_date','description'];
}
