<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;

class HomeController extends Controller
{
	public function index()
    {
        $topRest = $this->topRest();
    	return view('frontend/home',compact('topRest'));
    }

    public function topRest(/* Request $request */)
    {
        $vendors = Vendor::where([['isTop', '1'], ['status', 1]])->orderBy('id', 'DESC')->get()->makeHidden(['vendor_logo']);
        foreach ($vendors as $vendor) {
            if(session()->has('delivery_location')) {
                $lat1 = $vendor->lat;
                $lon1 = $vendor->lang;
                $lat2 = session()->get('delivery_location')['lat'];
                $lon2 = session()->get('delivery_location')['lang'];
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
            }
            else {
                $vendor['distance'] = '?';
            }

            if (auth('api')->user() != null) {
                $user = auth('api')->user();
                $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
            } else {
                $vendor['like'] = false;
            }
        }
        return $vendors;
    }
}