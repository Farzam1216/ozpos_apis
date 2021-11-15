<?php

   namespace App\Http\Controllers\Api\Vendor\MenuModule;

   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\MenuCategory;
   use App\Models\Vendor;

   class MenuCategoryController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return Response
       */
      public function index(): Response
      {
         $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
         $MenuCategory = MenuCategory::where('vendor_id',$Vendor->id)->get();
         return response(['success' => true, 'data' => $MenuCategory]);
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
       * @return Response
       */
      public function store(Request $request): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'status' => 'bail|required|integer|in:0,1',
             'type' => 'bail|required|string|in:SINGLE,HALF_N_HALF,DEALS',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;

         MenuCategory::create($data);
         return response(['success' => true, 'msg' => 'Menu category created.']);
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
       * @param MenuCategory $MenuCategory
       * @return Response
       */
      public function edit(MenuCategory $MenuCategory): Response
      {
         return response(['success' => true , 'data' => $MenuCategory]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  Request  $request
       * @param  MenuCategory  $MenuCategory
       * @return Response
       */
      public function update(Request $request, MenuCategory $MenuCategory): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'status' => 'bail|required|integer|in:0,1',
             'type' => 'bail|required|string|in:SINGLE,HALF_N_HALF,DEALS',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;

         $MenuCategory->update($data);
         return response(['success' => true, 'msg' => 'Menu category updated.']);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  MenuCategory  $MenuCategory
       * @return Response
       */
      public function destroy(MenuCategory $MenuCategory): Response
      {
         $MenuCategory->delete();
         return response(['success' => true, 'msg' => 'Menu category deleted.']);
      }

      // Test api
      // public function menuCategory()
      // {

      //   $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
      //   $MenuCategory = MenuCategory::where('vendor_id',$Vendor->id)->get();
      //   return response(['success' => true, 'data' => $MenuCategory]);
      // }
   }
