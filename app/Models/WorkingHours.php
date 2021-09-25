<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WorkingHours
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $day_index
 * @property string $period_list
 * @property string $type
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours whereDayIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours wherePeriodList($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkingHours whereVendorId($value)
 * @mixin \Eloquent
 */
class WorkingHours extends Model
{
    use HasFactory;

    protected $table = 'working_hours';

    protected $fillable = ['vendor_id','day_index','type','period_list','status'];
}
