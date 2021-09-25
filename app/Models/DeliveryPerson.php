<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\DeliveryPerson
 *
 * @property int $id
 * @property int|null $otp
 * @property string|null $lat
 * @property string|null $lang
 * @property string $image
 * @property string $first_name
 * @property string $phone_code
 * @property int $is_online
 * @property string $last_name
 * @property int $is_verified
 * @property string $email_id
 * @property string $password
 * @property string $contact
 * @property string|null $full_address
 * @property string|null $vehicle_type
 * @property string|null $vehicle_number
 * @property string|null $licence_number
 * @property string|null $national_identity
 * @property string|null $licence_doc
 * @property int|null $delivery_zone_id
 * @property int $status
 * @property int|null $notification
 * @property string|null $device_token
 * @property int|null $vendor_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read mixed $delivery_zone
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereDeliveryZoneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereDeviceToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereFullAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereIsOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereLicenceDoc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereLicenceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereNationalIdentity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereVehicleNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereVehicleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeliveryPerson whereVendorId($value)
 * @mixin \Eloquent
 */
class DeliveryPerson extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'delivery_person';

    protected $fillable = ['image','vendor_id','device_token','is_online','is_verified','otp','phone_code','first_name','last_name','delivery_zone_id','email_id','contact','full_address','password','vehicle_type','vehicle_number','licence_number','national_identity','licence_doc','lat','lang','status'];

    protected $appends = ['image','deliveryzone'];

    public function getImageAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['image'];
    }

    public function getDeliveryZoneAttribute()
    {
        if (isset($this->attributes['delivery_zone_id']))
        {
            $driver = DeliveryZone::find($this->attributes['delivery_zone_id']);
            if($driver)
            {
                return $driver->name;
            }
            else
            {
                return null;
            }
        }
        else
        {
            return null;
        }
    }
}
