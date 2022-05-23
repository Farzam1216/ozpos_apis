<?php

   namespace App\Http\Controllers\Api\Vendor\MenuModule;

   use App\Http\Controllers\CustomController;
   use App\Models\MenuSize;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;

   class MenuSizeController extends Controller
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
         $MenuSize = MenuSize::with('ItemSize')->where([['vendor_id', $Vendor->id], ['menu_id', $menu_id]])->get();
         return response(['success' => true, 'data' => $MenuSize]);
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
             'item_size_id' => 'bail|required',
             'display_price' => 'bail|required|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         $data['menu_id'] = $menu_id;

         ////////// price \\\\\\\\\\
         if (isset($data['display_price'])) {
            if (isset($data['display_discount_price']))
               $data['price'] = $data['display_discount_price'];
            else
               $data['price'] = $data['display_price'];
         } else {
            $data['price'] = null;
         }

         if(isset($data['size_dining_price'])){
          $data['size_dining_price'] = $data['size_dining_price'];
          }
          else{
            $data['size_dining_price'] = null;
          }

         MenuSize::create($data);
         return response(['success' => true, 'msg' => 'Menu Size created.']);
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
       * @param String $menu_size_id
       * @return Response
       */
      public function edit(string $menu_id, String $menu_size_id): Response
      {
         $MenuSize = MenuSize::with('ItemSize')->find($menu_size_id);
         return response(['success' => true, 'data' => $MenuSize]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param String $menu_id
       * @param MenuSize $MenuSize
       * @return Response
       */
      public function update(Request $request, string $menu_id, MenuSize $MenuSize): Response
      {
         $validator = Validator::make($request->all(), [
             'item_size_id' => 'bail|required',
             'display_price' => 'bail|required|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

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

         if(isset($data['size_dining_price'])){
          $data['size_dining_price'] = $data['size_dining_price'];
          }
          else{
            $data['size_dining_price'] = null;
          }

         $MenuSize->update($data);
         return response(['success' => true, 'msg' => 'Menu Size updated.']);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param String $menu_id
       * @param MenuSize $MenuSize
       * @return Response
       */
      public function destroy(string $menu_id, MenuSize $MenuSize): Response
      {
         $MenuSize->delete();
         return response(['success' => true, 'msg' => 'Menu Size deleted.']);
      }
   }
