<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderSetting
 *
 * @property int $id
 * @property string|null $min_order_value
 * @property string|null $order_assign_manually
 * @property string|null $orderRefresh
 * @property int|null $order_commission
 * @property string|null $order_dashboard_default_time
 * @property string|null $vendor_order_max_time
 * @property string|null $driver_order_max_time
 * @property string|null $delivery_charge_type
 * @property string|null $charges
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereCharges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereDeliveryChargeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereDriverOrderMaxTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereMinOrderValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereOrderAssignManually($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereOrderCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereOrderDashboardDefaultTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereOrderRefresh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderSetting whereVendorOrderMaxTime($value)
 * @mixin \Eloquent
 */
class OrderSetting extends Model
{
    use HasFactory;

    protected $table = 'order_setting';

    protected $fillable = ['vendor_id','free_delivery','free_delivery_distance','free_delivery_amount','min_order_value',  'order_commission','order_assign_manually','orderRefresh','order_dashboard_default_time','vendor_order_max_time','driver_order_max_time','delivery_charge_type','charges'];
}
