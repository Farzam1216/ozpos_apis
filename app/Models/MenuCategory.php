<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuCategory
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $name
 * @property int $status
 * @property string $type
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DealsMenu[] $DealsMenu
 * @property-read int|null $deals_menu_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HalfNHalfMenu[] $HalfNHalfMenu
 * @property-read int|null $half_n_half_menu_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SingleMenu[] $SingleMenu
 * @property-read int|null $single_menu_count
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuCategory whereVendorId($value)
 * @mixin Eloquent
 */
class MenuCategory extends Eloquent
{
    use HasFactory;

    protected $table = 'menu_category';

    protected $fillable = ['vendor_id', 'name', 'status', 'type'];

    public function SingleMenu() {
        return $this->hasMany('App\Models\SingleMenu');
    }

    public function HalfNHalfMenu() {
        return $this->hasMany('App\Models\HalfNHalfMenu');
    }

    public function DealsMenu() {
        return $this->hasMany('App\Models\DealsMenu');
    }
}
