<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderChild
 *
 * @property int $id
 * @property int $order_id
 * @property int $item
 * @property int $price
 * @property int $qty
 * @property string|null $custimization
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $item_name
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild whereCustimization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild whereItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild whereQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderChild whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrderChild extends Model
{
    use HasFactory;

        protected $table = 'order_child';

    protected $fillable = ['order_id','item','price','qty','custimization'];

    protected $appends = ['itemName','custimization'];

    public function getItemNameAttribute()
    {
        if($this->attributes['item'] != null)
        {
            return Submenu::where('id',$this->attributes['item'])->first()->name;
        }
        else
        {
            return null;
        }
    }

    public function getCustimizationAttribute()
    {
        if($this->attributes['custimization'] != null)
        {
            $array = json_decode($this->attributes['custimization']);
            if(!is_array($array))
            {
                $array = json_decode($array);
                if(!is_array($array))
                {
                    $array = json_decode($array);
                }
            }
            return $array;
        }
        else
        {
            return null;
        }
    }
}
