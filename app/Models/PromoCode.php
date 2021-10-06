<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PromoCode
 *
 * @property int $id
 * @property string $name
 * @property string $promo_code
 * @property string|null $image
 * @property int $display_customer_app
 * @property string|null $vendor_id
 * @property string|null $customer_id
 * @property int $isFlat
 * @property string $max_user
 * @property int|null $count_max_user
 * @property int|null $flatDiscount
 * @property string $discountType
 * @property int|null $discount
 * @property string|null $max_disc_amount
 * @property string $min_order_amount
 * @property int $max_count
 * @property int|null $count_max_count
 * @property string $max_order
 * @property int|null $count_max_order
 * @property string $coupen_type
 * @property string $description
 * @property string $start_end_date
 * @property string|null $display_text
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereCountMaxCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereCountMaxOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereCountMaxUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereCoupenType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereDisplayCustomerApp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereDisplayText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereFlatDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereIsFlat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereMaxCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereMaxDiscAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereMaxOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereMaxUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereMinOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode wherePromoCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereStartEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PromoCode whereVendorId($value)
 * @mixin \Eloquent
 */
class PromoCode extends Model
{
    use HasFactory;

    protected $table = 'promo_code';

    protected $fillable = ['name','promo_code','display_customer_app','vendor_id', 'customer_id','isFlat','flatDiscount','discountType','discount','max_disc_amount','min_order_amount','max_user','max_count','max_order','start_end_date','coupen_type','description','display_text','image','status'];

    protected $appends = ['image'];

    public function getImageAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['image'];
    }

//    public function getDiscountAttribute()
//    {
//        if($this->attributes['discount'] == null)
//        {
//            return 0;
//        }
//    }

    protected $casts = [
        'flatDiscount' => 'integer',
        'discount' => 'integer',
    ];
}
