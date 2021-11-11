<?php
   
   namespace App\Http\Controllers\Api\Vendor\MenuModule;
   
   use Illuminate\Http\Request;
   use Illuminate\Http\Response;
   use App\Http\Controllers\Controller;
   use App\Models\Addon;
   use App\Models\Vendor;
   use Illuminate\Support\Facades\Route;
   use Illuminate\Support\Facades\Validator;
   
   class AddonController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @param String $addon_category_id
       * @return Response
       */
      public function indexAll(): Response
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $Addon = Addon::where('vendor_id', $Vendor->id)->get()->makeHidden(['created_at', 'updated_at']);
         return response(['success' => true, 'data' => $Addon]);
      }
      
      /**
       * Display a listing of the resource.
       *
       * @param String $addon_category_id
       * @return Response
       */
      public function index(string $addon_category_id): Response
      {
//         $routeParameters = Route::current()->parameters();
//         $addon_category_id = $routeParameters['addon_category_id'];
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $Addon = Addon::where([['vendor_id', $Vendor->id], ['addon_category_id', $addon_category_id]])->get();
         return response(['success' => true, 'data' => $Addon]);
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
       * @param String $addon_category_id
       * @return Response
       */
      public function store(Request $request, string $addon_category_id): Response
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
         $data['addon_category_id'] = $addon_category_id;
         
         Addon::create($data);
         return response(['success' => true, 'msg' => 'Addon created.']);
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
       * @param String $addon_category_id
       * @param String $addon_id
       * @return Response
       */
      public function edit(string $addon_category_id, string $addon_id): Response
      {
         $Addon = Addon::find($addon_id);
         return response(['success' => true, 'data' => $Addon]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param String $addon_category_id
       * @param Addon $Addon
       * @return Response
       */
      public function update(Request $request, string $addon_category_id, Addon $Addon): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
         ]);
         
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
         
         $data = $request->all();
         $Addon->update($data);
         return response(['success' => true, 'msg' => 'Addon updated.']);
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param String $addon_category_id
       * @param Addon $Addon
       * @return Response
       */
      public function destroy(string $addon_category_id, Addon $Addon): Response
      {
         $Addon->delete();
         return response(['success' => true, 'msg' => 'Addon deleted.']);
      }
   }
