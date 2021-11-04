<?php

   namespace App\Http\Controllers\Vendor\MenuModule;

   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\MenuCategory;
   use App\Models\Vendor;

   class MenuCategoryController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index(): View
      {
         $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
         $MenuCategory = MenuCategory::where('vendor_id',$Vendor->id)->get();
         return view('vendor.menu_module.menu_category',compact('Vendor', 'MenuCategory'));
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
             'type' => 'required|string|in:SINGLE,HALF_N_HALF,DEALS',
         ]);

         $data = $request->all();

         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;

         MenuCategory::create($data);
         return redirect()->back()->with('msg','Menu category created.');
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
       * @return RedirectResponse
       */
      public function update(Request $request, MenuCategory $MenuCategory): RedirectResponse
      {
         $request->validate([
             'name' => 'required',
             'type' => 'required|string|in:SINGLE,HALF_N_HALF,DEALS',
         ]);

         $data = $request->all();

         if(isset($data['status']))
            $data['status'] = 1;
         else
            $data['status'] = 0;

         $MenuCategory->update($data);
         return redirect()->back()->with('msg','Menu category updated.');
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
         MenuCategory::whereIn('id',$ids)->delete();
         return response(['success' => true]);
      }
   }
