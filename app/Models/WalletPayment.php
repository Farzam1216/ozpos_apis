<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WalletPayment
 *
 * @property int $id
 * @property int $transaction_id
 * @property string $payment_type
 * @property string|null $payment_token
 * @property string|null $added_by
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment wherePaymentToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletPayment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WalletPayment extends Model
{
    use HasFactory;

    protected $table = 'wallet_payment';

    protected $fillable = ['transaction_id','payment_type','payment_token','added_by'];
}
