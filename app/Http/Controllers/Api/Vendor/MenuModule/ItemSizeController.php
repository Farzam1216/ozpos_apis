<?php
   
   namespace App\Http\Controllers\Vendor\MenuModule;
   
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\ItemSize;
   use App\Models\Vendor;
   
   class ItemSizeController extends Controller
   {
      public function index()
      {
         $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
         $ItemSize = ItemSize::where('vendor_id',$Vendor->id)->get();
         return response(['success' => true, 'data' => $ItemSize]);
      }
      
      public function create(): void
      {
         //
      }
      
      public function store(Request $request): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
         ]);
         
         $data = $request->all();
         ItemSize::create($data);
         return response(['success' => true, 'msg' => 'Item size created.']);
      }
      
      public function show(Request $request): void
      {
      
      }
      
      public function edit(ItemSize $ItemSize): Response
      {
         return response(['success' => true , 'data' => $ItemSize]);
      }
      
      public function update(Request $request, ItemSize $ItemSize): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
         ]);
         
         $data = $request->all();
         $ItemSize->update($data);
         return response(['success' => true, 'msg' => 'Item size created.']);
      }
      
      public function destroy(ItemSize $ItemSize): Response
      {
         $ItemSize->delete();
         return response(['success' => true, 'msg' => 'Item size deleted.']);
      }
   }
