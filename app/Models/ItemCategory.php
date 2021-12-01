<?php
   
   namespace App\Models;
   
   use Eloquent;
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;
   
   /**
    * App\Models\ItemCategory
    *
    * @property int $id
    * @property int $vendor_id
    * @property string $name
    * @property \Illuminate\Support\Carbon $created_at
    * @property \Illuminate\Support\Carbon|null $updated_at
    * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SingleMenuItemCategory[] $SingleMenuItemCategory
    * @property-read int|null $single_menu_item_category_count
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory newModelQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory newQuery()
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory query()
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereCreatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereId($value)
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereName($value)
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereUpdatedAt($value)
    * @method static \Illuminate\Database\Eloquent\Builder|ItemCategory whereVendorId($value)
    * @mixin Eloquent
    */
   class ItemCategory extends Eloquent
   {
      use HasFactory;
      
      protected $table = 'item_category';
      
      protected $fillable = ['vendor_id', 'name', 'image'];
      
      protected $appends = ['image'];
      
      public function getImageAttribute()
      {
         return url('images/upload') . '/' . $this->attributes['image'];
      }
      
      public function SingleMenuItemCategory()
      {
         return $this->hasMany('App\Models\SingleMenuItemCategory');
      }
   }
