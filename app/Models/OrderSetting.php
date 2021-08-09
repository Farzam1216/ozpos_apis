<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSetting extends Model
{
    use HasFactory;

    protected $table = 'order_setting';

    protected $fillable = ['min_order_value','order_commission','order_assign_manually','orderRefresh','order_dashboard_default_time','vendor_order_max_time','driver_order_max_time','delivery_charge_type','charges','delivery_charge_type'];
}
