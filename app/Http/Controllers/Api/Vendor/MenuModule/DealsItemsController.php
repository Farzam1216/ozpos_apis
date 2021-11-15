<?php
   
   namespace App\Http\Controllers\Api\Vendor\MenuModule;
   
   use App\Http\Controllers\CustomController;
   use App\Models\DealsMenu;
   use App\Models\ItemCategory;
   use App\Models\DealsItems;
   use App\Models\DealsItemsItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;
   
   class DealsItemsController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @param String $menu_category_id
       * @param String $deals_menu_id
       * @return Response
       * @return View
       */
      public function index(String $menu_category_id, String $deals_menu_id): Response
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
//         $menu_category_id = DealsMenu::find($deals_menu_id)->menu_category_id;
         $DealsItem = DealsItems::with(['ItemCategory', 'ItemSize'])->where([['vendor_id', $Vendor->id], ['deals_menu_id', $deals_menu_id]])->get();
         return response(['success' => true, 'data' => $DealsItem]);
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
       * @param String $menu_category_id
       * @param String $deals_menu_id
       * @return Response
       */
      public function store(Request $request, String $menu_category_id, String $deals_menu_id): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'item_category_id' => 'bail|required',
             'item_size_id' => 'bail|required',
         ]);
   
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
   
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
   
         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);
   
         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         $data['menu_category_id'] = $menu_category_id;
         $data['deals_menu_id'] = $deals_menu_id;
         
         DealsItems::create($data);
         return response(['success' => true, 'msg' => 'Deals Items created.']);
      }
      
      /**
       * Display the specified resource.
       *
       * @param Request $request
       * @return void
       */
      public function show(Request $request): void
      {
      
      }
   
      /**
       * Show the form for editing the specified resource.
       *
       * @param String $menu_category_id
       * @param String $deals_menu_id
       * @param String $deals_items_id
       * @return Response
       */
      public function edit(String $menu_category_id, String $deals_menu_id, String $deals_items_id): Response
      {
         $DealsItem = DealsItems::with(['ItemCategory', 'ItemSize'])->find($deals_items_id);
         return response(['success' => true , 'data' => $DealsItem]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param String $menu_category_id
       * @param String $deals_menu_id
       * @param DealsItems $DealsItem
       * @return Response
       */
      public function update(Request $request, String $menu_category_id, String $deals_menu_id, DealsItems $DealsItem): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'item_category_id' => 'bail|required',
             'item_size_id' => 'bail|required',
         ]);
   
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
   
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
   
         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);
   
         $data = $request->all();
   
         $DealsItem->update($data);
   
         return response(['success' => true, 'msg' => 'Deals Items updated.']);
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param String $menu_category_id
       * @param String $deals_menu_id
       * @param DealsItems $DealsItem
       * @return Response
       */
      public function destroy(String $menu_category_id, String $deals_menu_id, DealsItems $DealsItem): Response
      {
         $DealsItem->delete();
         return response(['success' => true, 'msg' => 'Deals Items deleted.']);
      }
   }
