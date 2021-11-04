<?php
   
   namespace App\Http\Controllers\Vendor\MenuModule;
   
   use App\Http\Controllers\CustomController;
   use App\Models\ItemCategory;
   use App\Models\SingleMenu;
   use App\Models\SingleMenuItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;
   
   class SingleMenuController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index($menu_category_id): View
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $SingleMenu = SingleMenu::with('Menu')->where([['vendor_id', $Vendor->id], ['menu_category_id', $menu_category_id]])->get();
         return view('vendor.menu_module.single_menu', compact('Vendor', 'SingleMenu', 'menu_category_id'));
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
             'item_categories' => 'required|array',
         ]);
         
         $data = $request->all();
         
         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;
         
         $SingleMenu = SingleMenu::create($data);
         
         foreach ($data['item_categories'] as $ItemCategory)
         {
            SingleMenuItemCategory::create(['vendor_id' => $data['vendor_id'], 'single_menu_id' => $SingleMenu->id, 'item_category_id' => $ItemCategory]);
         }
         
         return redirect()->back()->with('msg', 'Single Menu created.');
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
       * @param SingleMenu $SingleMenu
       * @return Response
       */
      public function edit(SingleMenu $SingleMenu): Response
      {
         $ItemCategories = [];
         $SingleMenuItemCategory = SingleMenuItemCategory::where('single_menu_id', $SingleMenu->id)->get(['id', 'item_category_id']);
         
         foreach ($SingleMenuItemCategory as $ItemCategory)
            array_push($ItemCategories, $ItemCategory->item_category_id);
         
         $SingleMenu['item_categories[]'] = $ItemCategories;
         
         return response(['success' => true, 'data' => $SingleMenu]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param SingleMenu $SingleMenu
       * @return RedirectResponse
       */
      public function update(Request $request, SingleMenu $SingleMenu): RedirectResponse
      {
         $request->validate([
             'menu_id' => 'required',
             'item_categories' => 'required|array',
         ]);
   
         $data = $request->all();
   
         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;
   
         $SingleMenu->update($data);
         SingleMenuItemCategory::where('single_menu_id', $SingleMenu->id)->delete();
   
         foreach ($data['item_categories'] as $ItemCategory)
         {
            SingleMenuItemCategory::create(['vendor_id' => $SingleMenu->vendor_id, 'single_menu_id' => $SingleMenu->id, 'item_category_id' => $ItemCategory]);
         }
         
         return redirect()->back()->with('msg', 'Single Menu updated.');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param SingleMenu $SingleMenu
       * @return Response
       */
      public function destroy(SingleMenu $SingleMenu): Response
      {
         $SingleMenu->delete();
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
         $SingleMenus = SingleMenu::whereIn('id', $ids)->delete();
         return response(['success' => true]);
      }
   }
