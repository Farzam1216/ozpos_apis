<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\Menu;
use App\Models\Submenu;
use App\Models\SubmenuCusomizationType;
use App\Models\GeneralSetting;
use App\Models\VendorDiscount;
use App\Models\WorkingHours;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    /*
        Restaurants Index
    */
	public function index()
    {
        $enabledRest = $this->enabledRest();
    	return view('frontend/restaurants',compact('enabledRest'));
    }

    /*
        Single Restaurant Index
    */
    public function get($id)
    {
        $rest = $this->getRest($id);
        $singleVendor = $this->singleVendor($id);
        $page = 1;
        return view('frontend/restaurant',compact('rest', 'singleVendor', 'page'));
    }


    /* -------------------------------------------------------------------------------------------------------- */

    public function enabledRest(/* Request $request */)
    {
        $vendors = Vendor::where([['status', 1]])->orderBy('id', 'DESC')->get()->makeHidden(['vendor_logo']);
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

    public function getRest($id)
    {
        $vendor = Vendor::where('id', $id)->first();
        // foreach ($vendors as $vendor) {
        //     $lat1 = $vendor->lat;
        //     $lon1 = $vendor->lang;
        //     $lat2 = $request->lat;
        //     $lon2 = $request->lang;
        //     $unit = 'K';
        //     if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        //         $distance = 0;
        //     } else {
        //         $theta = $lon1 - $lon2;
        //         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        //         $dist = acos($dist);
        //         $dist = rad2deg($dist);
        //         $miles = $dist * 60 * 1.1515;
        //         $unit = strtoupper($unit);
        //         if ($unit == "K") {
        //             $distance = $miles * 1.609344;
        //         } else if ($unit == "N") {
        //             $distance = $miles * 0.8684;
        //         } else {
        //             $distance = $miles;
        //         }
        //     }
        //     $vendor['distance'] = round($distance);
        //     if (auth('api')->user() != null) {
        //         $user = auth('api')->user();
        //         $vendor['like'] = in_array($vendor->id, explode(',', $user->faviroute));
        //     } else {
        //         $vendor['like'] = false;
        //     }
        // }
        return $vendor;
    }


    public function singleVendor($vendor_id)
    {
        $master = array();
        $master['vendor'] = Vendor::where([['id', $vendor_id], ['status', 1]])->first(['id', 'image', 'tax', 'name', 'map_address', 'for_two_person', 'vendor_type', 'cuisine_id'])->makeHidden(['vendor_logo']);
        if ($master['vendor']->tax == null) {
            $master['vendor']->tax = strval(5);
        }
        $menus = Menu::where([['vendor_id', $vendor_id], ['status', 1]])->orderBy('id', 'DESC')->get(['id', 'name', 'image']);
        $tax = GeneralSetting::first()->isItemTax;
        foreach ($menus as $menu) {
            $menu['submenu'] = Submenu::where([['menu_id', $menu->id], ['status', 1]])->get(['id', 'qty_reset', 'item_reset_value','type', 'name', 'image', 'price']);
            foreach ($menu['submenu'] as $value) {
                $value['custimization'] = SubmenuCusomizationType::where('submenu_id', $value->id)->get(['id', 'name', 'custimazation_item', 'type']);
                if ($tax == 0) {
                    $price_tax = GeneralSetting::first()->item_tax;
                    $disc = $value->price * $price_tax;
                    $discount = $disc / 100;
                    $value->price = strval($value->price + $discount);
                } else {
                    $value->price = strval($value->price);
                }
            }
        }
        $master['menu'] = $menus;
        $master['vendor_discount'] = VendorDiscount::where('vendor_id', $vendor_id)->orderBy('id', 'desc')->first(['id', 'type', 'discount', 'min_item_amount', 'max_discount_amount', 'start_end_date']);
        $master['delivery_timeslot'] = WorkingHours::where([['type', 'delivery_time'], ['vendor_id', $vendor_id]])->get(['id', 'day_index', 'period_list', 'status']);
        $master['pick_up_timeslot'] = WorkingHours::where([['type', 'pick_up_time'], ['vendor_id', $vendor_id]])->get(['id', 'day_index', 'period_list', 'status']);
        $master['selling_timeslot'] = WorkingHours::where([['type', 'selling_timeslot'], ['vendor_id', $vendor_id]])->get(['id', 'day_index', 'period_list', 'status']);

        $now = Carbon::now();
        $today = Carbon::createFromFormat('H:i', '21:00');
        $dayname = $now->format('l');

        foreach ($master['delivery_timeslot'] as $value) {
            $arr = json_decode($value['period_list'], true);
            if ($dayname == $value['day_index']) {
                foreach ($arr as $key => $a) {
                    $Hour1 = strtotime($a['start_time']);
                    $Hour2 = strtotime($a['end_time']);
                    $startofday = strtotime("01:00 am");

                    $seconds = $Hour2 - $Hour1;
                    $hours = $seconds / 60 / 60;
                    $hours = abs($hours);
                    $tts = date("H", $Hour1);
                    $seconds = $Hour2 - $Hour1;
                    $hours = $seconds / 60 / 60;
                    $beadded = 0;
                    if ($hours < 0) {
                        $remainDay = 24 - $tts;
                        $nextday = $Hour2 - $startofday;
                        $d = $nextday / 60 / 60;
                        // $d + 1;
                        $beadded = $remainDay + $d + 1;
                    } else {
                        $beadded = $hours;
                    }
                    $today = Carbon::createFromFormat('H:i', date("H:i", $Hour1));
                    $arr[$key]['new_start_time'] = $today->copy()->toDateTimeString();
                    $arr[$key]['new_end_time'] = $today->addHours($beadded)->toDateTimeString();
                }
            }
            $value['period_list'] = $arr;
        }
        foreach ($master['pick_up_timeslot'] as $pvalue) {
            $parr = json_decode($pvalue['period_list'], true);
            if ($dayname == $pvalue['day_index']) {
                foreach ($parr as $pkey => $pa) {
                    $pHour1 = strtotime($pa['start_time']);
                    $pHour2 = strtotime($pa['end_time']);
                    $pstartofday = strtotime("01:00 am");
                    $pseconds = $pHour2 - $pHour1;
                    $phours = $pseconds / 60 / 60;
                    $phours = abs($phours);
                    $ptts = date("H", $pHour1);
                    $pseconds = $pHour2 - $pHour1;
                    $phours = $pseconds / 60 / 60;
                    $pbeadded = 0;
                    if ($phours < 0) {
                        $premainDay = 24 - $ptts;

                        $pnextday = $pHour2 - $pstartofday;
                        $pd = $pnextday / 60 / 60;
                        $pbeadded = $premainDay + $pd + 1;
                    } else {
                        $pbeadded = $phours;
                    }
                    $ptoday = Carbon::createFromFormat('H:i', date("H:i", $pHour1));
                    $parr[$pkey]['new_start_time'] = $ptoday->copy()->toDateTimeString();
                    $parr[$pkey]['new_end_time'] = $ptoday->addHours($pbeadded)->toDateTimeString();
                }
            }
            $pvalue['period_list'] = $parr;
        }

        return $master;
    }
}
