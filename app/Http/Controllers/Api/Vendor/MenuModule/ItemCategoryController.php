<?php
   
   namespace App\Http\Controllers\Vendor\MenuModule;

   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\ItemCategory;
   use App\Models\Vendor;

   class ItemCategoryController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index(): View
      {
         $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
         $ItemCategory = ItemCategory::where('vendor_id',$Vendor->id)->get();
         return view('vendor.menu_module.item_category',compact('Vendor', 'ItemCategory'));
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
         ItemCategory::create($data);
         return redirect()->back()->with('msg','Item category created.');
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
       * @param ItemCategory $ItemCategory
       * @return Response
       */
      public function edit(ItemCategory $ItemCategory): Response
      {
         return response(['success' => true , 'data' => $ItemCategory]);
      }
   
      /**
       * Update the specified resource in storage.
       *
       * @param  Request  $request
       * @param  ItemCategory  $ItemCategory
       * @return RedirectResponse
       */
      public function update(Request $request, ItemCategory $ItemCategory): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
         ]);
      
         $data = $request->all();
         $ItemCategory->update($data);
         return redirect()->back()->with('msg','Item category updated.');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param  ItemCategory  $ItemCategory
       * @return Response
       */
      public function destroy(ItemCategory $ItemCategory): Response
      {
         $ItemCategory->delete();
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
         ItemCategory::whereIn('id',$ids)->delete();
         return response(['success' => true]);
      }
   }
