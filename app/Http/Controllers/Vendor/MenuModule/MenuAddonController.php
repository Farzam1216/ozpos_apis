<?php

   namespace App\Http\Controllers\Vendor\MenuModule;

   use App\Models\Addon;
   use App\Models\MenuAddon;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Vendor;

   class MenuAddonController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index($menu_id, $menu_size_id = null): View
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $MenuAddon = null;

         if ($menu_size_id === null)
            $MenuAddon = MenuAddon::with('Addon')->where([['vendor_id', $Vendor->id], ['menu_id', $menu_id]])->get();
         else
            $MenuAddon = MenuAddon::with('Addon')->where([['vendor_id', $Vendor->id], ['menu_id', $menu_id], ['menu_size_id', $menu_size_id]])->get();


            // dd($MenuAddon);
         return view('vendor.menu_module.menu_addon', compact('Vendor', 'MenuAddon', 'menu_id', 'menu_size_id'));
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
             'menu_id' => 'required',
             'addon_id' => 'required',
             'price' => 'nullable|numeric|between:0,999999.99',
         ]);

         $data = $request->all();
         $Addon = Addon::find($data['addon_id']);
         $data['addon_category_id'] = $Addon->addon_category_id;

         MenuAddon::create($data);
         return redirect()->back()->with('msg', 'Menu Addon created.');
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
       * @param MenuAddon $MenuAddon
       * @return Response
       */
      public function edit(MenuAddon $MenuAddon): Response
      {
         return response(['success' => true, 'data' => $MenuAddon]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param MenuAddon $MenuAddon
       * @return RedirectResponse
       */
      public function update(Request $request, MenuAddon $MenuAddon): RedirectResponse
      {
         $request->validate([
             'menu_id' => 'required',
             'addon_id' => 'required',
             'price' => 'nullable|numeric|between:0,999999.99',
         ]);

         $data = $request->all();
         $Addon = Addon::find($data['addon_id']);
         $data['addon_category_id'] = $Addon->addon_category_id;

         $MenuAddon->update($data);
         return redirect()->back()->with('msg', 'Menu Addon updated.');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param MenuAddon $MenuAddon
       * @return Response
       */
      public function destroy(MenuAddon $MenuAddon): Response
      {
         $MenuAddon->delete();
         return response(['success' => true]);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param Request $request
       * @return Response
       */
      public function selection_destroy(Request $request): Response
      {
         $data = $request->all();
         $ids = explode(',', $data['ids']);
         MenuAddon::whereIn('id', $ids)->delete();
         return response(['success' => true]);
      }
   }
