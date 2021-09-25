<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Refund
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property string $refund_reason
 * @property string $refund_status
 * @property string|null $payment_type
 * @property string|null $payment_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $order
 * @property-read mixed $user
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund query()
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund wherePaymentToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereRefundStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Refund whereUserId($value)
 * @mixin \Eloquent
 */
class Refund extends Model
{
    use HasFactory;

    protected $table = 'refaund';

    protected $fillable = ['order_id','user_id','refund_reason','refund_status','payment_type','payment_token'];

    protected $appends = ['order','user'];

    public function getOrderAttribute()
    {
        return Order::where('id',$this->attributes['order_id'])->first(['id','order_id','amount'])->makeHidden(['vendor','user','orderItems','user_address']);
    }

    public function getUserAttribute()
    {
        return User::where('id',$this->attributes['user_id'])->first(['id','name'])->makeHidden(['image']);
    }
}
