<?php

   namespace App\Http\Controllers\Api\User;

   use App\Http\Controllers\Auth\LoginController;
   use App\Http\Controllers\Controller;
   use App\Models\Banner;
   use App\Models\DeliveryZoneNew;
   use App\Models\GeneralSetting;
   use App\Models\UserAddress;
   use App\Models\Vendor;
   use Grimzy\LaravelMysqlSpatial\Types\Point;
   use Illuminate\Http\Request;

   class HomeController extends Controller
   {
      public function apiBanner()
      {
         $banners = Banner::where('status', 1)->orderBy('id', 'DESC')->get();
         return response(['success' => true, 'data' => $banners]);
      }

      public function getNearBy()
      {
         $User = auth()->user();
         $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();

         $Point = new Point($UserAddress->lat, $UserAddress->lang);
         $DeliveryZoneNew = DeliveryZoneNew::select('vendor_id')->contains('coordinates', $Point)->first();
         if (!$DeliveryZoneNew)
            return response(['success' => false, 'data' => []]);

         $radius = GeneralSetting::first()->radius;
         // $vendors = Vendor::where('status', 1)->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
         $vendors = Vendor::where('status', 1)->whereIn('id', $DeliveryZoneNew)->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
         foreach ($vendors as $vendor) {
            $googleApiKey = 'AIzaSyCDcZlGMIvPlbwuDgQzlEkdhjVQVPnne4c';
            $googleUrl = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&destinations="' . $UserAddress->lat . ',' . $UserAddress->lang . '"&origins="' . $vendor->lat . ',' . $vendor->lang . '"&key=' . $googleApiKey . '';
            $googleDistance =
                file_get_contents(
                    $googleUrl,
                );
            $googleDistance = json_decode($googleDistance);

            $vendor['distance'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->distance->text : 'no route found';
            $vendor['duration'] = ($googleDistance->status == "OK") ? $googleDistance->rows[0]->elements[0]->duration->text : 'no route found';

            if (auth('api')->user() != null) {
               $user = auth('api')->user();
               $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
            } else {
               $vendor['like'] = false;
            }
         }
         \Log::critical($vendors);
         return response(['success' => true, 'data' => $vendors]);
      }

      public function apiTopRest()
      {
         $User = auth()->user();
         $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
         $vendors = Vendor::where([['isTop', '1'], ['status', 1]])->orderBy('id', 'DESC')->get(['id', 'image', 'name', 'lat', 'lang', 'vendor_type', 'cuisine_id'])->makeHidden(['vendor_logo']);
         foreach ($vendors as $vendor) {
            $lat1 = $vendor->lat;
            $lon1 = $vendor->lang;
            $lat2 = $UserAddress->lat;
            $lon2 = $UserAddress->lang;
            $unit = 'K';
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
               $distance = 0;
            } else {
               $theta = $lon1 - $lon2;
               $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
               $dist = acos($dist);
               $dist = rad2deg($dist);
               $miles = $dist * 60 * 1.1515;
               $unit = strtoupper($unit);
               if ($unit == "K") {
                  $distance = $miles * 1.609344;
               } else if ($unit == "N") {
                  $distance = $miles * 0.8684;
               } else {
                  $distance = $miles;
               }
            }
            $vendor['distance'] = round($distance);
            if (auth('api')->user() != null) {
               $user = auth('api')->user();
               $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
            } else {
               $vendor['like'] = false;
            }
         }
         return response(['success' => true, 'data' => $vendors]);
      }

      public function apiVegRest()
      {
         $User = auth()->user();
         $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
         $vendors = Vendor::where([['vendor_type', 'veg'], ['status', 1]])->orderBy('id', 'DESC')->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
         foreach ($vendors as $vendor) {
            $lat1 = $vendor->lat;
            $lon1 = $vendor->lang;
            $lat2 = $UserAddress->lat;
            $lon2 = $UserAddress->lang;
            $unit = 'K';
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
               $distance = 0;
            } else {
               $theta = $lon1 - $lon2;
               $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
               $dist = acos($dist);
               $dist = rad2deg($dist);
               $miles = $dist * 60 * 1.1515;
               $unit = strtoupper($unit);
               if ($unit == "K") {
                  $distance = $miles * 1.609344;
               } else if ($unit == "N") {
                  $distance = $miles * 0.8684;
               } else {
                  $distance = $miles;
               }
            }
            $vendor['distance'] = round($distance);
            if (auth('api')->user() != null) {
               $user = auth('api')->user();
               $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
            } else {
               $vendor['like'] = false;
            }
         }
         return response(['success' => true, 'data' => $vendors]);
      }

      public function apiNonVegRest()
      {
         $User = auth()->user();
         $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
         $vendors = Vendor::where([['vendor_type', 'non_veg'], ['status', 1]])->orderBy('id', 'DESC')->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
         foreach ($vendors as $vendor) {
            $lat1 = $vendor->lat;
            $lon1 = $vendor->lang;
            $lat2 = $UserAddress->lat;
            $lon2 = $UserAddress->lang;
            $unit = 'K';
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
               $distance = 0;
            } else {
               $theta = $lon1 - $lon2;
               $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
               $dist = acos($dist);
               $dist = rad2deg($dist);
               $miles = $dist * 60 * 1.1515;
               $unit = strtoupper($unit);
               if ($unit == "K") {
                  $distance = $miles * 1.609344;
               } else if ($unit == "N") {
                  $distance = $miles * 0.8684;
               } else {
                  $distance = $miles;
               }
            }
            $vendor['distance'] = round($distance);
            if (auth('api')->user() != null) {
               $user = auth('api')->user();
               $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
            } else {
               $vendor['like'] = false;
            }
         }
         return response(['success' => true, 'data' => $vendors]);
      }

      public function apiExploreRest()
      {
         $User = auth()->user();
         $UserAddress = UserAddress::where([['user_id', $User->id], ['selected', 1]])->first();
         $vendors = Vendor::where([['isExplorer', '1'], ['status', 1]])->orderBy('id', 'DESC')->get(['id', 'image', 'name', 'lat', 'lang', 'cuisine_id', 'vendor_type'])->makeHidden(['vendor_logo']);
         foreach ($vendors as $vendor) {
            $lat1 = $vendor->lat;
            $lon1 = $vendor->lang;
            $lat2 = $UserAddress->lat;
            $lon2 = $UserAddress->lang;
            $unit = 'K';
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
               $distance = 0;
            } else {
               $theta = $lon1 - $lon2;
               $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
               $dist = acos($dist);
               $dist = rad2deg($dist);
               $miles = $dist * 60 * 1.1515;
               $unit = strtoupper($unit);
               if ($unit == "K") {
                  $distance = $miles * 1.609344;
               } else if ($unit == "N") {
                  $distance = $miles * 0.8684;
               } else {
                  $distance = $miles;
               }
            }
            $vendor['distance'] = round($distance);
            if (auth('api')->user() != null) {
               $user = auth('api')->user();
               $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
            } else {
               $vendor['like'] = false;
            }
         }
         return response(['success' => true, 'data' => $vendors]);
      }

      public function apiFavorite(Request $request)
      {
         $data = auth()->user();
         if ($data != null) {
            if ($data->faviroute == null) {
               $data->faviroute = $request->id;
               $data->save();
               return response(['success' => true, 'data' => 'Add from faviroute successfully..!!']);
            } else {
               $like = explode(',', $data->faviroute);
               if (($key = array_search($request->id, $like)) !== false) {
                  unset($like[$key]);
                  $data->faviroute = implode(',', $like);
                  $data->save();
                  return response(['success' => true, 'data' => 'Remove from faviroute successfully..!!']);
               } else {
                  $restraunt = array();
                  $restraunt['like'] = $data->faviroute;
                  array_push($restraunt, $request->id);
                  $data->faviroute = implode(",", $restraunt);
                  $data->save();
                  return response(['success' => true, 'data' => 'Add to faviroute Successfully..!!']);
               }
            }
         } else {
            return response(['success' => false, 'data' => 'No Restaurant found..!!']);
         }
      }
   }
