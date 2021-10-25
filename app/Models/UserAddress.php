<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserAddress
 *
 * @property int $id
 * @property int $user_id
 * @property string $lat
 * @property string $lang
 * @property string $address
 * @property string|null $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUserId($value)
 * @mixin \Eloquent
 */
class UserAddress extends Model
{
    use HasFactory;

    protected $table = 'user_address';

    protected $fillable = ['user_id','lat','lang','zone_id','address','type','selected'];

    public function user()
    {
        return $this->hasMany(User::class,'user_id','id');
    }
    public function order()
    {
       return $this->hasMany(Order::class,'address_id','id');
    }
}
