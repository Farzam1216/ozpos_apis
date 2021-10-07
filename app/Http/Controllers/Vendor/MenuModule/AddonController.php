<?php

namespace App\Http\Controllers\Vendor\MenuModule;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Vendor;

class AddonController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index($addon_category_id): View
  {
    $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
    $Addon = Addon::where([['vendor_id',$Vendor->id], ['addon_category_id',$addon_category_id]])->get();
//    dd($Addon);
    return view('vendor.menu_module.addon',compact('Vendor', 'Addon', 'addon_category_id'));
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
    ]);

    $data = $request->all();
    Addon::create($data);
    return redirect()->back()->with('msg','Addon created.');
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
   * @param Addon $Addon
   * @return Response
   */
  public function edit(Addon $Addon): Response
  {
    return response(['success' => true , 'data' => $Addon]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  Addon  $Addon
   * @return RedirectResponse
   */
  public function update(Request $request, Addon $Addon): RedirectResponse
  {
    $request->validate([
      'name' => 'required',
    ]);

    $data = $request->all();
    $Addon->update($data);
    return redirect()->back()->with('msg','Addon updated.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Addon  $Addon
   * @return Response
   */
  public function destroy(Addon $Addon): Response
  {
    $Addon->delete();
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
    Addon::whereIn('id',$ids)->delete();
    return response(['success' => true]);
  }
}
