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
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index(): View
      {
         $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
         $ItemSize = ItemSize::where('vendor_id',$Vendor->id)->get();
         return view('vendor.menu_module.item_size',compact('Vendor', 'ItemSize'));
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
         ]);
         
         $data = $request->all();
         ItemSize::create($data);
         return redirect()->back()->with('msg','Item size created.');
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
       * @param ItemSize $ItemSize
       * @return Response
       */
      public function edit(ItemSize $ItemSize): Response
      {
         return response(['success' => true , 'data' => $ItemSize]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param  Request  $request
       * @param  ItemSize  $ItemSize
       * @return RedirectResponse
       */
      public function update(Request $request, ItemSize $ItemSize): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
         ]);
         
         $data = $request->all();
         $ItemSize->update($data);
         return redirect()->back()->with('msg','Item size updated.');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param  ItemSize  $ItemSize
       * @return Response
       */
      public function destroy(ItemSize $ItemSize): Response
      {
         $ItemSize->delete();
         return response(['success' => true]);
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param  Request  $request
       * @return Response
       */
      public function selection_destroy(Request $request): Response
      {
         $data = $request->all();
         $ids = explode(',',$data['ids']);
         ItemSize::whereIn('id',$ids)->delete();
         return response(['success' => true]);
      }
   }
