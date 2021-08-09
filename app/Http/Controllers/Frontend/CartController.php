<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
        if ( $input['extra_status'] == 0 ) {
            Cart::add($item->id, $item->name, 1, $item->price);
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

            Cart::add($item->id, $item->name, 1, $price, ['custimization'=>$input['extra_data']]);
        }




        return response()->json(['success'=>'Added to cart.']);
    }

    public function remove(Request $request)
    {
        $input = $request->all();
        $rows  = Cart::content();
        $rowId = $rows->where('id', $input['item_id'])->first()->rowId;
        Cart::remove($rowId);
        return response()->json(['itemID'=>$input['item_id']]);
    }
}