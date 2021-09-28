<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ItemSize
 *
 * @property int $id
 * @property int $vendor_id
 * @property string $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize query()
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ItemSize whereVendorId($value)
 * @mixin \Eloquent
 */
class ItemSize extends Model
{
    use HasFactory;

    protected $table = 'item_size';

    protected $fillable = ['vendor_id','name'];
   
   public function MenuSize() {
      return $this->hasMany('App\Models\MenuSize');
   }
}
