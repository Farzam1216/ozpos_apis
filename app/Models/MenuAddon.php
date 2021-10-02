<?php
   
   namespace App\Models;
   
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;
   
   /**
    * App\Models\MenuAddon
    *
    * @property int $id
    * @property int $vendor_id
    * @property int|null $menu_id
    * @property int|null $menu_size_id
    * @property int $addon_category_id
    * @property int $addon_id
    * @property int $price
    * @property \Illuminate\Support\Carbon $created_at
    * @property \Illuminate\Support\Carbon|null $updated_at
    * @property-read \App\Models\Addon $Addon
    * @property-read \App\Models\AddonCategory $AddonCategory
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon newModelQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon newQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon query()
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereAddonCategoryId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereAddonId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereCreatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereMenuId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereMenuSizeId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon wherePrice($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereUpdatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|MenuAddon whereVendorId($value)
    * @mixin \Eloquent
    */
   class MenuAddon extends Model
   {
      use HasFactory;
      
      protected $table = 'menu_addon';
      
      protected $fillable = ['vendor_id', 'menu_id', 'menu_size_id', 'addon_category_id', 'addon_id', 'price'];
      
      protected $casts = [
         'price' => 'decimal:2',
      ];

      public function Addon()
      {
         return $this->belongsTo('App\Models\Addon');
      }
      
      public function AddonCategory()
      {
         return $this->belongsTo('App\Models\AddonCategory');
      }
   }
