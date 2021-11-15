<?php

   namespace App\Http\Controllers\Vendor\MenuModule;

   use App\Http\Controllers\CustomController;
   use App\Models\DealsMenu;
   use App\Models\ItemCategory;
   use App\Models\DealsItems;
   use App\Models\DealsItemsItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;

   class DealsItemsController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index($deals_menu_id): View
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $menu_category_id = DealsMenu::find($deals_menu_id)->menu_category_id;
         $DealsItems = DealsItems::with(['ItemCategory', 'ItemSize'])->where([['vendor_id', $Vendor->id], ['deals_menu_id', $deals_menu_id]])->get();
         return view('vendor.menu_module.deals_items', compact('Vendor', 'DealsItems', 'menu_category_id', 'deals_menu_id'));
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
             'menu_category_id' => 'required',
             'deals_menu_id' => 'required',
             'name' => 'required',
             'item_category_id' => 'required',
             'item_size_id' => 'required',
         ]);

         $data = $request->all();

         DealsItems::create($data);
         return redirect()->back()->with('msg', 'Deals Items created.');
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
       * @param DealsItems $DealsItems
       * @return Response
       */
      public function edit(DealsItems $DealsItem): Response
      {
         return response(['success' => true , 'data' => $DealsItem]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param DealsItems $DealsItems
       * @return RedirectResponse
       */
      public function update(Request $request, DealsItems $DealsItem): RedirectResponse
      {
         $request->validate([
             'menu_category_id' => 'required',
             'deals_menu_id' => 'required',
             'name' => 'required',
             'item_category_id' => 'required',
             'item_size_id' => 'required',
         ]);

         $data = $request->all();

         $DealsItem->update($data);
         return redirect()->back()->with('msg','Deals Items updated.');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param DealsItems $DealsItems
       * @return Response
       */
      public function destroy(DealsItems $DealsItem): Response
      {
         $DealsItem->delete();
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
         $DealsItemss = DealsItems::whereIn('id',$ids)->delete();
         return response(['success' => true]);
      }
   }
