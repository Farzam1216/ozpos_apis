<?php
   
   namespace App\Http\Controllers\Vendor\MenuModule;
   
   use App\Http\Controllers\CustomController;
   use App\Models\ItemCategory;
   use App\Models\HalfNHalfMenu;
//   use App\Models\HalfNHalfMenuItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;
   
   class HalfNHalfMenuController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index($menu_category_id): View
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $HalfNHalfMenu = HalfNHalfMenu::with('ItemCategory')->where([['vendor_id', $Vendor->id], ['menu_category_id', $menu_category_id]])->get();
         return view('vendor.menu_module.half_n_half_menu', compact('Vendor', 'HalfNHalfMenu', 'menu_category_id'));
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
             'item_category_id' => 'required',
         ]);
         
         $data = $request->all();
   
   
         ////////// image \\\\\\\\\\
         if ($file = $request->hasfile('image'))
         {
            $request->validate(
                ['image' => 'max:1000'],
                [
                    'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
                ]);
            $data['image'] = (new CustomController)->uploadImage($request->image);
         }
         else
         {
            $data['image'] = 'product_default.jpg';
         }
   
   
         ////////// status \\\\\\\\\\
         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;
         
         
         HalfNHalfMenu::create($data);
         
//         foreach ($data['item_categories'] as $ItemCategory)
//         {
//            HalfNHalfMenuItemCategory::create(['vendor_id' => $data['vendor_id'], 'half_n_half_menu_id' => $HalfNHalfMenu->id, 'item_category_id' => $ItemCategory]);
//         }
         
         return redirect()->back()->with('msg', 'Half n half Menu created.');
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
       * @param HalfNHalfMenu $HalfNHalfMenu
       * @return Response
       */
      public function edit(HalfNHalfMenu $HalfNHalfMenu): Response
      {
         return response(['success' => true , 'data' => $HalfNHalfMenu]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param HalfNHalfMenu $HalfNHalfMenu
       * @return RedirectResponse
       */
      public function update(Request $request, HalfNHalfMenu $HalfNHalfMenu): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
             'description' => 'required',
             'item_category_id' => 'required',
         ]);
   
         $data = $request->all();
   
   
         ////////// image \\\\\\\\\\
         if ($request->hasfile('image'))
         {
            $request->validate(
                ['image' => 'max:1000'],
                [
                    'image.max' => 'The Image May Not Be Greater Than 1 MegaBytes.',
                ]);
            (new CustomController)->deleteImage(DB::table('menu')->where('id', $HalfNHalfMenu->id)->value('image'));
            $data['image'] = (new CustomController)->uploadImage($data['image']);
         }
   
   
         ////////// status \\\\\\\\\\
         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;
   
   
         $HalfNHalfMenu->update($data);
         return redirect()->back()->with('msg','Half n half Menu updated.');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param HalfNHalfMenu $HalfNHalfMenu
       * @return Response
       */
      public function destroy(HalfNHalfMenu $HalfNHalfMenu): Response
      {
         (new CustomController)->deleteImage(DB::table('menu')->where('id', $HalfNHalfMenu->id)->value('image'));
         $HalfNHalfMenu->delete();
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
         $HalfNHalfMenus = HalfNHalfMenu::whereIn('id',$ids)->get();
         foreach ($HalfNHalfMenus as $HalfNHalfMenu)
         {
            (new CustomController)->deleteImage(DB::table('menu')->where('id', $HalfNHalfMenu->id)->value('image'));
            $HalfNHalfMenu->delete();
         }
         return response(['success' => true]);
      }
   }
