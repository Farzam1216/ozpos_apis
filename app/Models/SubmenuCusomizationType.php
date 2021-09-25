<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubmenuCusomizationType
 *
 * @property int $id
 * @property string $name
 * @property int $vendor_id
 * @property int $submenu_id
 * @property int $menu_id
 * @property string $type
 * @property int $min_item_selection
 * @property int $max_item_selection
 * @property string|null $custimazation_item
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereCustimazationItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereMaxItemSelection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereMinItemSelection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereSubmenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmenuCusomizationType whereVendorId($value)
 * @mixin \Eloquent
 */
class SubmenuCusomizationType extends Model
{
    use HasFactory;

    protected $table = 'submenu_cutsomization_type';

    protected $fillable = ['name','vendor_id','custimazation_item','menu_id','submenu_id','type','min_item_selection','max_item_selection'];
}
