<?php

namespace App\Http\Controllers;
use App\Models\DeliveryZoneNew;
use App\Models\DeliveryZone;
use App\Models\DeliveryZoneArea;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
use Gate;
use Auth;

class DeliveryZoneNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('delivery_zone_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vendor = Vendor::where('user_id',Auth::user()->id)->first();
        $zone=DeliveryZoneNew::selectRaw("*,ST_AsText(ST_Centroid(`coordinates`)) as center")
                                        ->where('vendor_id',$vendor->id)->first();
                                        // dd($zone);
          if(isset($zone))
          {
            return view('admin.delivery zone.delivery_zone_new',compact('zone','vendor'));

          }
          else
          {
            return view('admin.delivery zone.create_delivery_zone_new',compact('vendor'));

          }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('delivery_zone_add'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.delivery zone.create_delivery_zone_new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->all());
      $value = $request->coordinates;
      foreach(explode('),(',trim($value,'()')) as $index=>$single_array){
          if($index == 0)
          {
              $lastcord = explode(',',$single_array);
          }
          $coords = explode(',',$single_array);
          $polygon[] = new Point($coords[0], $coords[1]);
      }
      // $zone_id=Zone::all()->count() + 1;
      $polygon[] = new Point($lastcord[0], $lastcord[1]);
      // $coordintas = new Polygon([new LineString($polygon)]);
      // $data = $request->all();

       $vendor_id =Vendor::where('user_id', Auth::user()->id)->first()->id;
              $zone=new DeliveryZoneNew;
              $zone->vendor_id = $vendor_id;
              $zone->name = $request->name;
              $zone->coordinates = new Polygon([new LineString($polygon)]);
              $zone->save();
      if(Auth::user()->load('roles')->roles->contains('title', 'admin'))
      {
          return redirect('admin/delivery_zone')->with('msg','Delivery Zone created successfully..!!');
      }
      if(Auth::user()->load('roles')->roles->contains('title', 'vendor'))
      {
          return redirect('vendor/deliveryZoneNew')->with('msg','Delivery Zone created successfully..!!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryZoneNew  $deliveryZoneNew
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryZoneNew $deliveryZoneNew)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryZoneNew  $deliveryZoneNew
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryZoneNew $deliveryZoneNew)
    {
      // $zone=DeliveryZoneNew::selectRaw("*,ST_AsText(ST_Centroid(`coordinates`)) as center")->first();
      // return view('admin.delivery zone.edit_delivery_zone_new',compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryZoneNew  $deliveryZoneNew
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
      // dd($request->all());
      $value = $request->coordinates;
      foreach(explode('),(',trim($value,'()')) as $index=>$single_array){
          if($index == 0)
          {
              $lastcord = explode(',',$single_array);
          }
          $coords = explode(',',$single_array);
          $polygon[] = new Point($coords[0], $coords[1]);
      }
      $vendor = Vendor::where('user_id',Auth::user()->id)->first();
      $polygon[] = new Point($lastcord[0], $lastcord[1]);
      $zone=DeliveryZoneNew::where(['id'=>$id,'vendor_id' => $vendor->id])->first();
      $zone->name = $request->name;
      $zone->coordinates = new Polygon([new LineString($polygon)]);

      $zone->save();

      return back()->with('msg','Delivery Zone created successfully..!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryZoneNew  $deliveryZoneNew
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveryZoneNew $deliveryZoneNew)
    {
        //
    }
}
