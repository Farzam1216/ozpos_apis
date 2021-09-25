<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VendorBankDetail
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $bank_name
 * @property string $branch_name
 * @property string $account_number
 * @property string $ifsc_code
 * @property string $clabe
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereClabe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereIfscCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VendorBankDetail whereVendorId($value)
 * @mixin \Eloquent
 */
class VendorBankDetail extends Model
{
    use HasFactory;

    protected $table = 'vendor_bank_details';

    protected $fillable = ['vendor_id','bank_name','clabe','branch_name','account_number','ifsc_code'];
}
