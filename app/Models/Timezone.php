<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Timezone
 *
 * @property string $CountryCode
 * @property string $Coordinates
 * @property string $TimeZone
 * @property string $Comments
 * @property string $UTC_offset
 * @property string $UTC_DST_offset
 * @property string|null $Notes
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereCoordinates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereUTCDSTOffset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timezone whereUTCOffset($value)
 * @mixin \Eloquent
 */
class Timezone extends Model
{
    use HasFactory;

    protected $table = 'timezones';
}
