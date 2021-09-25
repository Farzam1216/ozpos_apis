<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GeneralSetting
 *
 * @property int $id
 * @property string|null $cancel_reason
 * @property string|null $company_white_logo
 * @property string|null $company_black_logo
 * @property string|null $favicon
 * @property string|null $business_name
 * @property string|null $contact_person_name
 * @property string|null $contact
 * @property string|null $business_address
 * @property string|null $country
 * @property string|null $tax_id
 * @property string|null $timezone
 * @property string|null $currency
 * @property string|null $currency_symbol
 * @property string|null $help_line_no
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int|null $business_availability
 * @property string|null $message
 * @property int|null $isItemTax
 * @property string|null $item_tax
 * @property string|null $tax_type
 * @property string|null $vendor_name
 * @property string|null $driver_name
 * @property int|null $isPickup
 * @property int|null $isSameDayDelivery
 * @property string|null $vendor_distance
 * @property int|null $customer_notification
 * @property string|null $customer_app_id
 * @property string|null $customer_auth_key
 * @property string|null $customer_api_key
 * @property int|null $driver_notification
 * @property string|null $driver_app_id
 * @property string|null $driver_auth_key
 * @property string|null $driver_api_key
 * @property int|null $vendor_notification
 * @property string|null $vendor_app_id
 * @property string|null $vendor_auth_key
 * @property string|null $vendor_api_key
 * @property string|null $privacy_policy
 * @property string|null $terms_and_condition
 * @property string|null $help
 * @property string|null $about_us
 * @property string|null $site_color #6777EF
 * @property int|null $settlement_days
 * @property int|null $is_driver_accept_multipleorder
 * @property int|null $driver_accept_multiple_order_count
 * @property int|null $driver_assign_km
 * @property string|null $driver_vehical_type
 * @property string|null $driver_earning
 * @property string|null $company_details
 * @property string|null $twilio_acc_id
 * @property int|null $verification
 * @property int|null $verification_email
 * @property int|null $verification_phone
 * @property string|null $twilio_auth_token
 * @property string|null $twilio_phone_no
 * @property string|null $radius
 * @property int|null $driver_auto_refrese
 * @property string|null $mail_mailer
 * @property string|null $mail_host
 * @property string|null $mail_port
 * @property string|null $mail_username
 * @property string|null $mail_password
 * @property string|null $mail_encryption
 * @property string|null $mail_from_address
 * @property int|null $customer_mail
 * @property int|null $vendor_mail
 * @property int|null $driver_mail
 * @property string|null $ios_customer_version
 * @property string|null $ios_vendor_version
 * @property string|null $ios_driver_version
 * @property string|null $ios_customer_app_url
 * @property string|null $ios_vendor_app_url
 * @property string|null $ios_driver_app_url
 * @property string|null $android_customer_version
 * @property string|null $android_vendor_version
 * @property string|null $android_driver_version
 * @property string|null $android_customer_app_url
 * @property string|null $android_vendor_app_url
 * @property string|null $android_driver_app_url
 * @property string|null $map_key
 * @property string|null $license_code
 * @property string|null $client_name
 * @property int|null $license_verify
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $black_logo
 * @property-read mixed $white_logo
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereAboutUs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereAndroidCustomerAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereAndroidCustomerVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereAndroidDriverAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereAndroidDriverVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereAndroidVendorAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereAndroidVendorVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereBusinessAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereBusinessAvailability($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereBusinessName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCompanyBlackLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCompanyDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCompanyWhiteLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereContactPersonName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCurrencySymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCustomerApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCustomerAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCustomerAuthKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCustomerMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereCustomerNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverAcceptMultipleOrderCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverAssignKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverAuthKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverAutoRefrese($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverEarning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereDriverVehicalType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereFavicon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereHelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereHelpLineNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIosCustomerAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIosCustomerVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIosDriverAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIosDriverVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIosVendorAppUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIosVendorVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIsDriverAcceptMultipleorder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIsItemTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIsPickup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereIsSameDayDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereItemTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereLicenseCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereLicenseVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMailEncryption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMailFromAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMailHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMailMailer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMailPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMailPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMailUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMapKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting wherePrivacyPolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereRadius($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereSettlementDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereSiteColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTaxType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTermsAndCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTwilioAccId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTwilioAuthToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereTwilioPhoneNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVendorApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVendorAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVendorAuthKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVendorDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVendorMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVendorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVendorNotification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVerification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVerificationEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting whereVerificationPhone($value)
 * @mixin \Eloquent
 */
class GeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'general_setting';

    protected $fillable = ['business_name','cancel_reason','company_white_logo','company_black_logo','favicon','contact_person_name','contact','business_address','country','tax_id','timezone','customer_notification','customer_app_id','customer_auth_key',
    'customer_api_key','vendor_notification','vendor_app_id','vendor_auth_key','vendor_api_key',
    'driver_notification','driver_app_id','driver_auth_key','driver_api_key','currency',
    'currency_symbol','help_line_no','start_time','end_time','business_availability','message',
    'isItemTax','item_tax','tax_type','vendor_name','driver_name','isPickup',
    'isSameDayDelivery','vendor_distance','privacy_policy', 'company_details',
    'terms_and_condition','help','about_us','site_color',
    'is_driver_accept_multipleorder','driver_accept_multiple_order_count',
    'driver_vehical_type','driver_earning','driver_assign_km','settlement_days',
    'verification','verification_phone','verification_email',
    'twilio_acc_id','twilio_auth_token','twilio_phone_no','radius',
    'driver_auto_refrese','mail_mailer','mail_host','mail_username','mail_password',
    'mail_encryption','mail_from_address','mail_port','customer_mail','vendor_mail',
    'driver_mail','ios_customer_version','ios_vendor_version','ios_driver_version',
    'ios_customer_app_url','ios_vendor_app_url','ios_driver_app_url','android_customer_version',
    'android_vendor_version','android_driver_version','android_customer_app_url','android_vendor_app_url'
    ,'android_driver_app_url','map_key','client_name'];

    protected $appends = ['whitelogo','blacklogo'];

    public function getWhiteLogoAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['company_white_logo'];
    }

    public function getBlackLogoAttribute()
    {
        return url('images/upload') . '/'.$this->attributes['company_black_logo'];
    }
}
