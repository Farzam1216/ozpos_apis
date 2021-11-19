<?php

namespace App\Http\Controllers\Vendor\MenuModule;

use App\Http\Controllers\CustomController;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Vendor;

class MenuController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index(): View
  {
    $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
    $Menu = Menu::where('vendor_id',$Vendor->id)->get();
    return view('vendor.menu_module.menu',compact('Vendor', 'Menu'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return void
   */
  public function create(): void
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => 'required',
      'image' => 'required',
      'description' => 'required',
      'display_price' => 'nullable|numeric|between:0,999999.99',
      'display_discount_price' => 'nullable|numeric|between:0,999999.99|lte:display_price',
    ]);

    $data = $request->all();


    ////////// price \\\\\\\\\\
    if (isset($data['display_price']))
    {
      if (isset($data['display_discount_price']))
        $data['price'] = $data['display_discount_price'];
      else
        $data['price'] = $data['display_price'];
    }
    else
    {
      $data['price'] = null;
    }


    ////////// image \\\\\\\\\\
    if ($file = $request->hasfile('image'))
    {
      $request->validate(
        ['image' => 'max:5000'],
        [
          'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
        ]);
      $data['image'] = (new CustomController)->uploadImage($request->image);
    }
    else
    {
      $data['image'] = 'product_default.jpg';
    }


    Menu::create($data);
    return redirect()->back()->with('msg','Menu created.');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return void
   */
  public function show(Request $request): void
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Menu $Menu
   * @return Response
   */
  public function edit(Menu $Menu): Response
  {
    return response(['success' => true , 'data' => $Menu]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  Menu  $Menu
   * @return RedirectResponse
   */
  public function update(Request $request, Menu $Menu): RedirectResponse
  {
    $request->validate([
      'name' => 'required',
      'description' => 'required',
      'display_price' => 'nullable|numeric|between:0,999999.99',
      'display_discount_price' => 'nullable|numeric|between:0,999999.99|lte:display_price',
    ]);

    $data = $request->all();


    ////////// price \\\\\\\\\\
    if (isset($data['display_price']))
    {
      if (isset($data['display_discount_price']))
        $data['price'] = $data['display_discount_price'];
      else
        $data['price'] = $data['display_price'];
    }
    else
    {
      $data['price'] = null;
    }


    ////////// image \\\\\\\\\\
    if ($request->hasfile('image'))
    {
      $request->validate(
        ['image' => 'max:5000'],
        [
          'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
        ]);
      (new CustomController)->deleteImage(DB::table('menu')->where('id', $Menu->id)->value('image'));
      $data['image'] = (new CustomController)->uploadImage($data['image']);
    }


    $Menu->update($data);
    return redirect()->back()->with('msg','Menu updated.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Menu  $Menu
   * @return Response
   */
  public function destroy(Menu $Menu): Response
  {
    (new CustomController)->deleteImage(DB::table('menu')->where('id', $Menu->id)->value('image'));
    $Menu->delete();
    return response(['success' => true]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Request  $request
   * @return Response
   */
  public function selection_destroy(Request $request): Response
  {
    $data = $request->all();
    $ids = explode(',',$data['ids']);
    $Menus = Menu::whereIn('id',$ids)->get();
    foreach ($Menus as $Menu)
    {
      (new CustomController)->deleteImage(DB::table('menu')->where('id', $Menu->id)->value('image'));
      $Menu->delete();
    }

    return response(['success' => true]);
  }
}
