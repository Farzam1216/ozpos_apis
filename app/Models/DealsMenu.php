<?php

   namespace App\Models;

   use Eloquent;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;

   /**
    * App\Models\DealsMenu
    *
    * @property int $id
    * @property int $vendor_id
    * @property int $menu_category_id
    * @property string $name
    * @property string $description
    * @property int $price
    * @property int $status
    * @property \Illuminate\Support\Carbon $created_at
    * @property \Illuminate\Support\Carbon|null $updated_at
    * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DealsItems[] $DealsItems
    * @property-read int|null $deals_items_count
    * @property-read \App\Models\MenuCategory $MenuCategory
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu newModelQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu newQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu query()
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereCreatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereDescription($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereMenuCategoryId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereName($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu wherePrice($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereStatus($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereUpdatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|DealsMenu whereVendorId($value)
    * @mixin Eloquent
    */
   class DealsMenu extends Eloquent
   {
      use HasFactory;

      protected $table = 'deals_menu';

      protected $fillable = ['vendor_id', 'menu_category_id', 'name', 'image', 'description', 'price', 'display_price', 'display_discount_price', 'status'];

      protected $casts = [
          'price' => 'decimal:2',
      ];

      protected $appends = ['image'];

      public function getImageAttribute()
      {
         return url('images/upload') . '/' . $this->attributes['image'];
      }

      public function MenuCategory()
      {
         return $this->belongsTo('App\Models\MenuCategory');
      }

      public function DealsItems()
      {
         return $this->hasMany('App\Models\DealsItems');
      }
   }
