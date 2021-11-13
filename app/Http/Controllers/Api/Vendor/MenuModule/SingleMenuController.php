<?php

   namespace App\Http\Controllers\Api\Vendor\MenuModule;

   use App\Http\Controllers\CustomController;
   use App\Models\ItemCategory;
   use App\Models\SingleMenu;
   use App\Models\SingleMenuItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;
   use PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow\Single;

   class SingleMenuController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @param String $menu_category_id
       * @return Response
       */
      public function index(String $menu_category_id): Response
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $SingleMenu = SingleMenu::with(['Menu', 'SingleMenuItemCategory.ItemCategory'])->where([['vendor_id', $Vendor->id], ['menu_category_id', $menu_category_id]])->get();
         return response(['success' => true, 'data' => $SingleMenu]);
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
       * @return Response
       */
      public function store(Request $request, String $menu_category_id): Response
      {
         $validator = Validator::make($request->all(), [
             'menu_id' => 'bail|required',
             'item_categories' => 'bail|required',
             'status' => 'bail|required|integer|in:0,1',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         $data['menu_category_id'] = $menu_category_id;
         $data['item_categories'] = json_decode($request->item_categories);

         $validator = Validator::make($data, [
             'item_categories' => 'array',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $SingleMenu = SingleMenu::create($data);

         foreach ($data['item_categories'] as $ItemCategory)
         {
            SingleMenuItemCategory::create(['vendor_id' => $data['vendor_id'], 'single_menu_id' => $SingleMenu->id, 'item_category_id' => $ItemCategory]);
         }

         return response(['success' => true, 'msg' => 'Single Menu created.']);
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
       * @param String $single_menu_id
       * @return Response
       */
      public function edit(String $menu_category_id, String $single_menu_id): Response
      {
         $SingleMenu = SingleMenu::with(['Menu', 'SingleMenuItemCategory.ItemCategory'])->find($single_menu_id);

         return response(['success' => true, 'data' => $SingleMenu]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param String $menu_category_id
       * @param SingleMenu $SingleMenu
       * @return Response
       */
      public function update(Request $request, String $menu_category_id, SingleMenu $SingleMenu): Response
      {
         $validator = Validator::make($request->all(), [
             'menu_id' => 'bail|required',
             'item_categories' => 'bail|required',
             'status' => 'bail|required|integer|in:0,1',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         $data['menu_category_id'] = $menu_category_id;
         $data['item_categories'] = json_decode($request->item_categories);

         $validator = Validator::make($data, [
             'item_categories' => 'array',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $SingleMenu->update($data);
         SingleMenuItemCategory::where('single_menu_id', $SingleMenu->id)->delete();

         foreach ($data['item_categories'] as $ItemCategory)
         {
            SingleMenuItemCategory::create(['vendor_id' => $SingleMenu->vendor_id, 'single_menu_id' => $SingleMenu->id, 'item_category_id' => $ItemCategory]);
         }

         return response(['success' => true, 'msg' => 'Single Menu updated.']);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param String $menu_category_id
       * @param SingleMenu $SingleMenu
       * @return Response
       */
      public function destroy(String $menu_category_id, SingleMenu $SingleMenu): Response
      {
         $SingleMenu->delete();
         return response(['success' => true, 'msg' => 'Single Menu deleted.']);
      }
   }
