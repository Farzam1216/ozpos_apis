<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryZoneArea
 *
 * @property int $id
 * @property string $name
 * @property string|null $vendor_id
 * @property string $location
 * @property int $radius
 * @property string $lat
 * @property string $lang
 * @property int $delivery_zone_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereDeliveryZoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereRadius($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZoneArea whereVendorId($value)
 * @mixin \Eloquent
 */
class DeliveryZoneArea extends Model
{
    use HasFactory;

    protected $table = 'delivery_zone_area';

    protected $fillable = ['name','vendor_id','radius','lat','lang','location','delivery_zone_id'];
}
