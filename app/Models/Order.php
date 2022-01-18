<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;

   /**
    * App\Models\Order
    *
    * @property int $id
    * @property string $order_id
    * @property int $vendor_id
    * @property int $user_id
    * @property int|null $delivery_person_id
    * @property string $date
    * @property string $time
    * @property string $payment_type
    * @property string|null $payment_token
    * @property string $payment_status
    * @property int $amount
    * @property int|null $admin_commission
    * @property int|null $vendor_amount
    * @property string $delivery_type
    * @property int|null $promocode_id
    * @property int|null $promocode_price
    * @property int|null $vendor_discount_id
    * @property int|null $vendor_discount_price
    * @property int|null $address_id
    * @property int|null $delivery_charge
    * @property string $order_status
    * @property string|null $cancel_by
    * @property string|null $cancel_reason
    * @property string|null $tax
    * @property string|null $order_start_time
    * @property string|null $order_end_time
    * @property int $printable
    * @property \Illuminate\Support\Carbon|null $created_at
    * @property \Illuminate\Support\Carbon|null $updated_at
    * @property-read mixed $order_items
    * @property-read mixed $user_address
    * @property-read mixed $user
    * @property-read mixed $vendor
    * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|Order query()
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddressId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereAdminCommission($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereCancelBy($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereCancelReason($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereDate($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCharge($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryPersonId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryType($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderEndTime($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderStartTime($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderStatus($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentStatus($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentToken($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentType($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order wherePrintable($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order wherePromocodeId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order wherePromocodePrice($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereTax($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereTime($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereVendorAmount($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereVendorDiscountId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereVendorDiscountPrice($value)
    * @method static \Illuminate\Database\Eloquent\Builder|Order whereVendorId($value)
    * @mixin \Eloquent
    */
   class Order extends Model
   {
      use HasFactory;

      protected $table = 'order';

      protected $fillable = ['order_id', 'tax', 'vendor_id', 'user_id', 'payment_token', 'delivery_person_id', 'date', 'time', 'amount', 'payment_type', 'payment_status', 'vendor_discount', 'promocode_id', 'promocode_price', 'address_id', 'order_status', 'delivery_charge', 'order_start_time', 'order_end_time', 'delivery_type', 'admin_commission', 'vendor_amount', 'printable', 'order_data', 'sub_total', 'delivery_time', 'table_no'];

      protected $appends = ['vendor', 'user', 'orderItems', 'user_address'];

      public function getVendorAttribute()
      {
         return Vendor::find($this->vendor_id);
      }

      public function getUserAttribute()
      {
         return User::find($this->user_id);
      }

      public function getOrderItemsAttribute()
      {
         $OrderItems = [];
         $OrderData = json_decode($this->attributes['order_data']);

         foreach ($OrderData->cart as $item) {
            if ($item->category === 'SINGLE')
               array_push($OrderItems, array('id' => null, 'orderId' => $this->attributes['id'], 'item' => null, 'item_name' => $item->menu[0]->name, 'price' => $item->menu[0]->total_amount, 'qty' => $item->quantity, 'custimization' => [], 'created_at' => null, 'updated_at' => null));
            else
               array_push($OrderItems, array('id' => null, 'orderId' => $this->attributes['id'], 'item' => null, 'item_name' => $item->menu_category->name, 'price' => $item->total_amount, 'qty' => $item->quantity, 'custimization' => [], 'created_at' => null, 'updated_at' => null));
         }

         return $OrderItems;
//      order_data
         //  return OrderChild::where('order_id',$this->attributes['id'])->get();
//      return [];
      }

      public function getUserAddressAttribute()
      {
         return UserAddress::where('id', $this->attributes['address_id'])->first(['lat', 'lang', 'address']);
      }

      public function userAddress()
      {
         return $this->belongsTo(UserAddress::class,'address_id','id');
      }
   }
