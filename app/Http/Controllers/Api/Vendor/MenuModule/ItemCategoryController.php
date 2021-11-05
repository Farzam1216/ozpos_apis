<?php
   
   namespace App\Http\Controllers\Api\Vendor\MenuModule;
   
   use Illuminate\Http\Request;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use App\Http\Controllers\Controller;
   use App\Models\ItemCategory;
   use App\Models\Vendor;
   
   class ItemCategoryController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return Response
       */
      public function index(): Response
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $ItemCategory = ItemCategory::where('vendor_id', $Vendor->id)->get();
         return response(['success' => true, 'data' => $ItemCategory]);
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
         ]);
         
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
         
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         
         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);
         
         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         
         ItemCategory::create($data);
         return response(['success' => true, 'msg' => 'Item category created.']);
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
       * @param ItemCategory $ItemCategory
       * @return Response
       */
      public function edit(ItemCategory $ItemCategory): Response
      {
         return response(['success' => true, 'data' => $ItemCategory]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param ItemCategory $ItemCategory
       * @return Response
       */
      public function update(Request $request, ItemCategory $ItemCategory): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
         ]);
         
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
         
         $data = $request->all();
         $ItemCategory->update($data);
         return response(['success' => true, 'msg' => 'Item category updated.']);
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param ItemCategory $ItemCategory
       * @return Response
       */
      public function destroy(ItemCategory $ItemCategory): Response
      {
         $ItemCategory->delete();
         return response(['success' => true, 'msg' => 'Item category deleted.']);
      }
   }
