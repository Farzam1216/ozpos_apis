<?php
   
   namespace App\Http\Controllers\Api\Vendor\MenuModule;
   
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\ItemSize;
   use App\Models\Vendor;
   
   class ItemSizeController extends Controller
   {
      public function index()
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $ItemSize = ItemSize::where('vendor_id', $Vendor->id)->get();
         return response(['success' => true, 'data' => $ItemSize]);
      }
      
      public function create(): void
      {
         //
      }
      
      public function store(Request $request)
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
         
         ItemSize::create($data);
         return response(['success' => true, 'msg' => 'Item size created.']);
      }
      
      public function show(Request $request): void
      {
      
      }
      
      public function edit(ItemSize $ItemSize): Response
      {
         return response(['success' => true, 'data' => $ItemSize]);
      }
      
      public function update(Request $request, ItemSize $ItemSize)
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
         ]);
         
         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);
         
         $data = $request->all();
         $ItemSize->update($data);
         return response(['success' => true, 'msg' => 'Item size updated.']);
      }
      
      public function destroy(ItemSize $ItemSize)
      {
         $ItemSize->delete();
         return response(['success' => true, 'msg' => 'Item size deleted.']);
      }
   }
