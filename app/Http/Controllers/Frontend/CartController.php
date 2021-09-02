<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Vendor;
use App\Models\Submenu;
use App\Models\GeneralSetting;
use Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $input = $request->all();
        $tax = GeneralSetting::first()->isItemTax;
        $item = Submenu::where('id', $input['item_id'])->select('id', 'qty_reset', 'item_reset_value','type', 'name', 'image', 'price')->first();

        if ($item == NULL)
            return response()->json(['error'=>'not found.']);

        if ($tax == 0) {
            $price_tax = GeneralSetting::first()->item_tax;
            $disc = $item->price * $price_tax;
            $discount = $disc / 100;
            $item->price = strval($item->price);
            $item->price = strval($item->price + $discount);
        } else {
            $item->price = strval($item->price);
        }

        if ( Session::get('cart_vendor_id') != $input['vendor_id'] )
            Cart::destroy();


        session(['cart_vendor_id' => $input['vendor_id']]);

        $vendorTax = Vendor::find(Session::get('cart_vendor_id'))->tax;


        if ( $input['extra_status'] == 0 ) {
            Cart::add($item->id, $item->name, 1, $item->price, [], $vendorTax);
        }
        else {
            $extra = json_decode($input['extra_data']);
            $rows = Cart::content()->where('id', $input['item_id']);

            if ($rows) {
                foreach($rows as $row) {
                    // return response()->json(['success'=>$row->option]);
                    if ( $row->options['custimization'] != $input['extra_data'] )
                        Cart::remove($row->rowId);
                }
            }

            $price = $item->price;

            foreach($extra as $extraItem) {
                $price += $extraItem->data->price;
            }

            Cart::add($item->id, $item->name, 1, $price, ['custimization'=>$input['extra_data']], $vendorTax);
        }


        $this->sessionCartDeliverCharges();


        return response()->json(['success'=>'Added to cart.']);
    }

    public function inc(Request $request)
    {
        $input = $request->all();
        $rows  = Cart::content();
        $row = $rows->where('id', $input['item_id'])->first();
        $qty = $row->rowId;

        Cart::update($row->rowId, $row->qty+1);

        $this->sessionCartDeliverCharges();

        return response()->json(['itemID'=>$input['item_id']]);
    }

    public function dec(Request $request)
    {
        $input = $request->all();
        $rows  = Cart::content();
        $row = $rows->where('id', $input['item_id'])->first();
        $qty = $row->rowId;

        if($row->qty == 1)
            Cart::remove($row->rowId);
        else
            Cart::update($row->rowId, $row->qty-1);

        $this->sessionCartDeliverCharges();

        return response()->json(['itemID'=>$input['item_id']]);
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        $rows  = Cart::content();
        $rowId = $rows->where('id', $input['item_id'])->first()->rowId;
        Cart::remove($rowId);

        $this->sessionCartDeliverCharges();

        return response()->json(['itemID'=>$input['item_id']]);
    }

    protected function sessionCartDeliverCharges()
    {
        session(['cart_delivery_charges' => 0]);
        $deliveryChargeType = OrderSetting::first()->delivery_charge_type;
        $deliveryCharges = json_decode(OrderSetting::first()->charges);

        if($deliveryChargeType == 'order_amount') {
            foreach($deliveryCharges as $val) {
                if(Cart::count() >= $val->min_value && Cart::count() <= $val->max_value) {
                    session(['cart_delivery_charges' => $val->charges]);
                    break;
                }
            }
        }
        else if ($deliveryChargeType == 'delivery_distance' && session()->has('delivery_location')) {
            $vendor = Vendor::find(Session::get('cart_vendor_id'));

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

            $distance = round($distance);


            foreach($deliveryCharges as $val) {
                if($distance >= $val->min_value && $distance <= $val->max_value) {
                    session(['cart_delivery_charges' => $val->charges]);
                    break;
                }
            }
        }
    }
}
