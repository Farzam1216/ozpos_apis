<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $vendor_logo
 * @property string $email_id
 * @property string $image
 * @property string|null $password
 * @property string|null $contact
 * @property string|null $cuisine_id
 * @property string|null $address
 * @property string|null $lat
 * @property string|null $lang
 * @property string|null $map_address
 * @property string|null $min_order_amount
 * @property string|null $for_two_person
 * @property string|null $avg_delivery_time
 * @property string|null $license_number
 * @property string|null $admin_comission_type
 * @property string|null $admin_comission_value
 * @property string|null $vendor_type
 * @property string|null $time_slot
 * @property string|null $tax
 * @property string|null $delivery_type_timeSlot
 * @property int $isExplorer
 * @property int $isTop
 * @property int|null $vendor_own_driver
 * @property string|null $payment_option
 * @property int|null $status
 * @property string|null $vendor_language
 * @property string|null $connector_type
 * @property string|null $connector_descriptor
 * @property string|null $connector_port
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $cuisine
 * @property-read mixed $rate
 * @property-read mixed $review
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor getByDistance($lat, $lang, $radius)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAdminComissionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAdminComissionValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAvgDeliveryTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereConnectorDescriptor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereConnectorPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereConnectorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCuisineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereDeliveryTypeTimeSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereEmailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereForTwoPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereIsExplorer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereIsTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMapAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereMinOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor wherePaymentOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereTimeSlot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorOwnDriver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorType($value)
 * @mixin \Eloquent
 */
class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendor';

    protected $fillable = ['name','vendor_own_driver','vendor_language','image','vendor_logo','user_id','email_id','password','contact','cuisine_id','address','lat','lang','map_address','min_order_amount','for_two_person','avg_delivery_time','license_number','admin_comission_type','admin_comission_value','vendor_type','time_slot','tax_type','tax','delivery_type_timeSlot','status','isExplorer','isTop','connector_type','connector_descriptor','connector_port','map_api_key', 'vendor_status', 'delivery_status', 'pickup_status','close_time','start_time'];

    protected $appends = ['image','cuisine','vendor_logo','rate','review'];

    public function getImageAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['image'];
    }

    public function getCuisineAttribute()
    {
        // if ($this->cuisine_id != null)
        // {
            $cuisineIds = explode(",",$this->cuisine_id);
            $cuisine = [];
            foreach ($cuisineIds as $id)
            {
                array_push($cuisine, Cuisine::where('id',$id)->first(['name','image']));
            }
            return $cuisine;
        // }
    }

    public function getVendorLogoAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['vendor_logo'];
    }

    public function getRateAttribute()
    {
        $review = Review::where('vendor_id',$this->attributes['id'])->get();
        if (count($review) > 0) {
            $totalRate = 0;
            foreach ($review as $r)
            {
                $totalRate = $totalRate + $r->rate;
            }
            return round($totalRate / count($review), 1);
        }
        else
        {
            return 0;
        }
    }

    public function getReviewAttribute()
    {
        return Review::where('vendor_id',$this->attributes['id'])->count();
    }

    public function scopeGetByDistance($query, $lat, $lang, $radius)
    {
//        $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lang ) - radians(' . $lang . ') ) + sin( radians(' . $lat . ') ) * sin( radians(lat) ) ) ) AS distance FROM vendor HAVING distance < ' . $radius . ' ORDER BY distance'));
//        if (!empty($results))
//        {
//            $ids = [];
//            //Extract the id's
//            foreach ($results as $q)
//            {
//                array_push($ids, $q->id);
//            }
//            return $query->whereIn('id', $ids);
//        }
//        return $query->whereIn('id', []);
    }
}
