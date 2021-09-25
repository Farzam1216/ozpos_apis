<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeliveryZone
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $admin_name
 * @property string $email
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereAdminName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryZone whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeliveryZone extends Model
{
    use HasFactory;

    protected $table = 'delivery_zone';

    protected $fillable = ['name','contact','admin_name','email'];
}
