<?php
   
   namespace App\Http\Controllers\Vendor\MenuModule;
   
   use App\Http\Controllers\CustomController;
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
         $DealsItems = DealsItems::where([['vendor_id', $Vendor->id], ['deals_menu_id', $deals_menu_id]])->get();
         return view('vendor.menu_module.deals_items', compact('Vendor', 'DealsItems', 'deals_menu_id'));
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
             'item_category_id' => 'required',
             'item_size_id' => 'required',
             'menu_category_id' => 'required',
             'deals_menu_id' => 'required',
             'name' => 'required',
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
      public function edit(DealsItems $DealsItems): Response
      {
         return response(['success' => true , 'data' => $DealsItems]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param DealsItems $DealsItems
       * @return RedirectResponse
       */
      public function update(Request $request, DealsItems $DealsItems): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
             'description' => 'required',
             'display_price' => 'required|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99',
         ]);
         
         $data = $request->all();
         
         
         ////////// price \\\\\\\\\\
         if (isset($data['display_discount_price']))
            $data['price'] = $data['display_discount_price'];
         else
            $data['price'] = $data['display_price'];
         
         
         ////////// image \\\\\\\\\\
         if ($request->hasfile('image'))
         {
            $request->validate(
                ['image' => 'max:1000'],
                [
                    'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
                ]);
            (new CustomController)->deleteImage(DB::table('menu')->where('id', $DealsItems->id)->value('image'));
            $data['image'] = (new CustomController)->uploadImage($data['image']);
         }
         
         
         ////////// status \\\\\\\\\\
         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;
         
         
         $DealsItems->update($data);
         return redirect()->back()->with('msg','Deals Items updated.');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param DealsItems $DealsItems
       * @return Response
       */
      public function destroy(DealsItems $DealsItems): Response
      {
         (new CustomController)->deleteImage(DB::table('menu')->where('id', $DealsItems->id)->value('image'));
         $DealsItems->delete();
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
         $DealsItemss = DealsItems::whereIn('id',$ids)->get();
         foreach ($DealsItemss as $DealsItems)
         {
            (new CustomController)->deleteImage(DB::table('menu')->where('id', $DealsItems->id)->value('image'));
            $DealsItems->delete();
         }
         return response(['success' => true]);
      }
   }
