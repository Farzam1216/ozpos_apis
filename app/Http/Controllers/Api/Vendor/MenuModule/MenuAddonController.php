<?php
   
   namespace App\Http\Controllers\Api\Vendor\MenuModule;
   
   use App\Models\Addon;
   use App\Models\MenuAddon;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Vendor;
   
   class MenuAddonController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @param String $menu_id
       * @return Response
       */
      public function index(string $menu_id): Response
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $MenuAddon = MenuAddon::with('Addon')->where([['vendor_id', $Vendor->id], ['menu_id', $menu_id]])->get();
         return response(['success' => true, 'data' => $MenuAddon]);
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
       * @param String $menu_id
       * @return Response
       */
      public function store(Request $request, string $menu_id): Response
      {
         $validator = Validator::make($request->all(), [
             'addon_id' => 'bail|required',
             'price' => 'bail|required|numeric|between:0,999999.99',
         ]);
         
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
         
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         
         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);
         
         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         $data['menu_id'] = $menu_id;
         
         $Addon = Addon::find($data['addon_id']);
         $data['addon_category_id'] = $Addon->addon_category_id;
         
         MenuAddon::create($data);
         return response(['success' => true, 'msg' => 'Menu Addon created.']);
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
       * @param String $menu_id
       * @param String $menu_addon_id
       * @return Response
       */
      public function edit(string $menu_id, String $menu_addon_id): Response
      {
         $MenuAddon = MenuAddon::with('Addon')->find($menu_addon_id);
         return response(['success' => true, 'data' => $MenuAddon]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param String $menu_id
       * @param MenuAddon $MenuAddon
       * @return Response
       */
      public function update(Request $request, string $menu_id, MenuAddon $MenuAddon): Response
      {
         $validator = Validator::make($request->all(), [
             'addon_id' => 'bail|required',
             'price' => 'bail|required|numeric|between:0,999999.99',
         ]);
         
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
         
         $data = $request->all();
         
         $Addon = Addon::find($data['addon_id']);
         $data['addon_category_id'] = $Addon->addon_category_id;
         
         $MenuAddon->update($data);
         return response(['success' => true, 'msg' => 'Menu Addon updated.']);
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param String $menu_id
       * @param MenuAddon $MenuAddon
       * @return Response
       */
      public function destroy(string $menu_id, MenuAddon $MenuAddon): Response
      {
         $MenuAddon->delete();
         return response(['success' => true, 'msg' => 'Menu Addon deleted.']);
      }
   }
