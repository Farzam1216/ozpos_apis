<?php
   
   namespace App\Http\Controllers\Api\User;
   
   use App\Http\Controllers\Controller;
   use App\Models\DealsMenu;
   use App\Models\HalfNHalfMenu;
   use App\Models\MenuCategory;
   use App\Models\SingleMenu;
   use App\Models\Slider;
   use App\Models\Vendor;
   use Illuminate\Http\Request;
   
   class VendorController extends Controller
   {
      function apiSlider($vendor_id)
      {
         $Slider = Slider::where('vendor_id', $vendor_id)->get()->makeHidden(['created_at', 'updated_at']);
//         \Log::info(json_encode(['success' => true, 'data' => $Slider], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
         return response(['success' => true, 'data' => $Slider]);
      }
      function apiSingleMenu($vendor_id)
      {
         $SingleMenu = SingleMenu::where([['vendor_id', $vendor_id], ['status', 1]])->get()->makeHidden(['created_at', 'updated_at']);
         return response(['success' => true, 'data' => $SingleMenu]);
      }
      function apiDealsMenu($vendor_id)
      {
         $DealsMenu = DealsMenu::where([['vendor_id', $vendor_id], ['status', 1]])->get()->makeHidden(['created_at', 'updated_at']);
         return response(['success' => true, 'data' => $DealsMenu]);
      }
      function apiHalfnhalfMenu($vendor_id)
      {
         $HalfNHalfMenu = HalfNHalfMenu::where([['vendor_id', $vendor_id], ['status', 1]])->get()->makeHidden(['created_at', 'updated_at']);
         return response(['success' => true, 'data' => $HalfNHalfMenu]);
      }
   }
