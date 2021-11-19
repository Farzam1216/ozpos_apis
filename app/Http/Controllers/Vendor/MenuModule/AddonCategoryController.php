<?php

namespace App\Http\Controllers\Vendor\MenuModule;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\AddonCategory;
use App\Models\Vendor;

class AddonCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index(): View
  {
    $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
    $AddonCategory = AddonCategory::where('vendor_id',$Vendor->id)->get();
    return view('vendor.menu_module.addon_category',compact('Vendor', 'AddonCategory'));
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
      'min' => 'required',
      'max' => 'required|gt:min',
    ]);
    // dd('asdsa');
    $data = $request->all();
    AddonCategory::create($data);
    return redirect()->back()->with('msg','Addon category created.');
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
   * @param AddonCategory $AddonCategory
   * @return Response
   */
  public function edit(AddonCategory $AddonCategory): Response
  {
    return response(['success' => true , 'data' => $AddonCategory]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  AddonCategory  $AddonCategory
   * @return RedirectResponse
   */
  public function update(Request $request, AddonCategory $AddonCategory): RedirectResponse
  {

    $request->validate([
      'name' => 'required',
      'min' => 'required',
      'max' => 'required|gt:min',
    ]);
    $data = $request->all();
    $AddonCategory->update($data);
    return redirect()->back()->with('msg','Addon category updated.');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  AddonCategory  $AddonCategory
   * @return Response
   */
  public function destroy(AddonCategory $AddonCategory): Response
  {
    $AddonCategory->delete();
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
    AddonCategory::whereIn('id',$ids)->delete();
    return response(['success' => true]);
  }
}
