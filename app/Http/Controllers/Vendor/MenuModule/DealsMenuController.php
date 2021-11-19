<?php

   namespace App\Http\Controllers\Vendor\MenuModule;

   use App\Http\Controllers\CustomController;
   use App\Models\ItemCategory;
   use App\Models\DealsMenu;
   use App\Models\DealsMenuItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;

   class DealsMenuController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index($menu_category_id): View
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $DealsMenu = DealsMenu::where([['vendor_id', $Vendor->id], ['menu_category_id', $menu_category_id]])->get();
         return view('vendor.menu_module.deals_menu', compact('Vendor', 'DealsMenu', 'menu_category_id'));
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
             'display_price' => 'required|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99|lte:display_price',
         ]);

         $data = $request->all();


         ////////// price \\\\\\\\\\
         if (isset($data['display_discount_price']))
            $data['price'] = $data['display_discount_price'];
         else
            $data['price'] = $data['display_price'];


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


         DealsMenu::create($data);
         return redirect()->back()->with('msg', 'Deals Menu created.');
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
       * @param DealsMenu $DealsMenu
       * @return Response
       */
      public function edit(DealsMenu $DealsMenu): Response
      {
         return response(['success' => true , 'data' => $DealsMenu]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param DealsMenu $DealsMenu
       * @return RedirectResponse
       */
      public function update(Request $request, DealsMenu $DealsMenu): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
             'description' => 'required',
             'display_price' => 'required|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99|lte:display_price',
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
            (new CustomController)->deleteImage(DB::table('menu')->where('id', $DealsMenu->id)->value('image'));
            $data['image'] = (new CustomController)->uploadImage($data['image']);
         }


         ////////// status \\\\\\\\\\
         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;


         $DealsMenu->update($data);
         return redirect()->back()->with('msg','Deals Menu updated.');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param DealsMenu $DealsMenu
       * @return Response
       */
      public function destroy(DealsMenu $DealsMenu): Response
      {
         (new CustomController)->deleteImage(DB::table('menu')->where('id', $DealsMenu->id)->value('image'));
         $DealsMenu->delete();
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
         $DealsMenus = DealsMenu::whereIn('id',$ids)->get();
         foreach ($DealsMenus as $DealsMenu)
         {
            (new CustomController)->deleteImage(DB::table('menu')->where('id', $DealsMenu->id)->value('image'));
            $DealsMenu->delete();
         }
         return response(['success' => true]);
      }
   }
