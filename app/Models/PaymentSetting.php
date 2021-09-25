<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentSetting
 *
 * @property int $id
 * @property int $cod
 * @property int|null $stripe
 * @property int|null $razorpay
 * @property int|null $paypal
 * @property int|null $flutterwave
 * @property int|null $wallet
 * @property string|null $stripe_publish_key
 * @property string|null $stripe_secret_key
 * @property string|null $paypal_production
 * @property string|null $paypal_sendbox
 * @property string|null $paypal_client_id
 * @property string|null $paypal_secret_key
 * @property string|null $razorpay_publish_key
 * @property string|null $public_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereCod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereFlutterwave($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypalClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypalProduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypalSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePaypalSendbox($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting wherePublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereRazorpay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereRazorpayPublishKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereStripe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereStripePublishKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereStripeSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentSetting whereWallet($value)
 * @mixin \Eloquent
 */
class PaymentSetting extends Model
{
    use HasFactory;

    protected $table = 'payment_setting';

    protected $fillable = ['cod','stripe','razorpay','paypal','flutterwave','wallet','paypal_client_id','paypal_secret_key','stripe_publish_key','public_key','stripe_secret_key','paypal_production','paypal_sendbox','razorpay_publish_key'];
}
