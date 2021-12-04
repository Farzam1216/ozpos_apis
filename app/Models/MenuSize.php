<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;

   /**
    * App\Models\MenuSize
    *
    * @property int $id
    * @property int $vendor_id
    * @property int $menu_id
    * @property int $item_size_id
    * @property int $price
    * @property \Illuminate\Support\Carbon $created_at
    * @property \Illuminate\Support\Carbon|null $updated_at
    * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuAddon[] $GroupMenuAddon
    * @property-read int|null $group_menu_addon_count
    * @property-read \App\Models\ItemSize $ItemSize
    * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuAddon[] $MenuAddon
    * @property-read int|null $menu_addon_count
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize newModelQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize newQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize query()
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize whereCreatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize whereId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize whereItemSizeId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize whereMenuId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize wherePrice($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize whereUpdatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuSize whereVendorId($value)
    * @mixin \Eloquent
    */
   class MenuSize extends Model
   {
      use HasFactory;

      protected $table = 'menu_size';

      protected $fillable = ['vendor_id', 'menu_id', 'item_size_id', 'price', 'display_price', 'display_discount_price'];

      protected $casts = [
          'price' => 'decimal:2',
          'display_price' => 'decimal:2',
          'display_discount_price' => 'decimal:2',
      ];

      public function Menu()
      {
         return $this->belongsTo('App\Models\Menu');
      }

      public function MenuAddon()
      {
         return $this->hasMany('App\Models\MenuAddon');
      }

      public function GroupMenuAddon()
      {
        return $this->hasMany('App\Models\MenuAddon');
      }

      public function ItemSize()
      {
         return $this->belongsTo('App\Models\ItemSize');
      }
   }
