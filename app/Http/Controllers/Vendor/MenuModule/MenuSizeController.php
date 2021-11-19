<?php

   namespace App\Http\Controllers\Vendor\MenuModule;

   use App\Http\Controllers\CustomController;
   use App\Models\MenuSize;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;

   class MenuSizeController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index($menu_id): View
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $MenuSize = MenuSize::with('ItemSize')->where([['vendor_id', $Vendor->id], ['menu_id', $menu_id]])->get();
         return view('vendor.menu_module.menu_size', compact('Vendor', 'MenuSize', 'menu_id'));
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
             'item_size_id' => 'required',
             'display_price' => 'required|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99|lte:display_price',

         ]);

         $data = $request->all();


         ////////// price \\\\\\\\\\
         if (isset($data['display_price'])) {
            if (isset($data['display_discount_price']))
               $data['price'] = $data['display_discount_price'];
            else
               $data['price'] = $data['display_price'];
         } else {
            $data['price'] = null;
         }


         MenuSize::create($data);
         return redirect()->back()->with('msg', 'Menu Size created.');
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
       * @param MenuSize $MenuSize
       * @return Response
       */
      public function edit(MenuSize $MenuSize): Response
      {
         return response(['success' => true, 'data' => $MenuSize]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param MenuSize $MenuSize
       * @return RedirectResponse
       */
      public function update(Request $request, MenuSize $MenuSize): RedirectResponse
      {
         $request->validate([
             'item_size_id' => 'required',
             'display_price' => 'required|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99|lte:display_price',
         ]);

         $data = $request->all();


         ////////// price \\\\\\\\\\
         if (isset($data['display_price'])) {
            if (isset($data['display_discount_price']))
               $data['price'] = $data['display_discount_price'];
            else
               $data['price'] = $data['display_price'];
         } else {
            $data['price'] = null;
         }


         $MenuSize->update($data);
         return redirect()->back()->with('msg', 'Menu Size updated.');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param MenuSize $MenuSize
       * @return Response
       */
      public function destroy(MenuSize $MenuSize): Response
      {
         $MenuSize->delete();
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
         $MenuSizes = MenuSize::whereIn('id', $ids)->delete();
         return response(['success' => true]);
      }
   }
