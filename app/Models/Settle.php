<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Settle
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $order_id
 * @property int|null $driver_id
 * @property int|null $driver_earning
 * @property int $payment
 * @property int $admin_earning
 * @property int $vendor_earning
 * @property int $vendor_status
 * @property int|null $driver_status
 * @property string|null $payment_token
 * @property string|null $payment_type
 * @property string|null $driver_payment_type
 * @property string|null $driver_payment_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Settle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereAdminEarning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereDriverEarning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereDriverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereDriverPaymentToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereDriverPaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereDriverStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle wherePaymentToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereVendorEarning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereVendorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settle whereVendorStatus($value)
 * @mixin \Eloquent
 */
class Settle extends Model
{
    use HasFactory;

    protected $table = 'settlements';

    protected $fillable = ['vendor_id','order_id','payment','payment_token','payment_type','admin_earning','vendor_earning','driver_earning','driver_id','driver_status','vendor_status','driver_payment_token','driver_payment_type'];
}
