<?php
   
   namespace App\Http\Controllers\Api\Vendor;
   
   use App\Http\Controllers\Controller;
   use App\Models\MenuCategory;
   use App\Models\Vendor;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Illuminate\Support\Facades\Validator;
   
   class VendorSettingApiController extends Controller
   {
      public function status_get()
      {
         $User = Auth::user();
         $Vendor = Vendor::select('id', 'vendor_status', 'delivery_status', 'pickup_status')->where('user_id', $User->id)->first()->makeHidden('image', 'vendor_logo', 'cuisine', 'rate', 'review');
         
         if (!$Vendor)
            return response(['success' => false, 'msg' => 'vendor not found.']);
         
         return response(['success' => true, 'data' => $Vendor]);
      }
      
      public function status_update(Request $request)
      {
         $validator = Validator::make($request->all(), [
             'vendor_status' => 'bail|required|int',
             'delivery_status' => 'bail|required|int',
             'pickup_status' => 'bail|required|int',
         ]);
         
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
         
         $User = Auth::user();
         $Vendor = Vendor::where('user_id', $User->id)->first();
         
         if (!$Vendor)
            return response(['success' => false, 'msg' => 'vendor not found.']);
         
         $data = $request->all();
         $Vendor->update($data);
   
         return response(['success' => true, 'msg' => 'status updated...']);
      }
   }
