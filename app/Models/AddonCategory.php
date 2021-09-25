<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AddonCategory
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $name
 * @property int $min
 * @property int $max
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddonCategory whereVendorId($value)
 * @mixin Eloquent
 */
class AddonCategory extends Eloquent
{
    use HasFactory;

    protected $table = 'addon_category';

    protected $fillable = ['vendor_id', 'name', 'min', 'max'];
}
