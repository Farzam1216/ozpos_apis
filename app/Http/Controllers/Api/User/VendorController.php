<?php
   
   namespace App\Http\Controllers\Api\User;
   
   use App\Http\Controllers\Controller;
   use App\Models\Slider;
   use App\Models\Vendor;
   use Illuminate\Http\Request;
   
   class VendorController extends Controller
   {
      function apiSlider($vendor_id)
      {
         $Slider = Slider::where('vendor_id', $vendor_id)->get()->makeHidden(['created_at', 'updated_at']);
         \Log::info(json_encode(['success' => true, 'data' => $Slider], JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));
         return response(['success' => true, 'data' => $Slider]);
      }
   }
