<?php

   namespace App\Http\Controllers\Api\Vendor\MenuModule;

   use App\Http\Controllers\CustomController;
   use App\Models\ItemCategory;
   use App\Models\HalfNHalfMenu;

//   use App\Models\HalfNHalfMenuItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;

   class HalfNHalfMenuController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @param String $menu_category_id
       * @return Response
       */
      public function index(string $menu_category_id): Response
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $HalfNHalfMenu = HalfNHalfMenu::with('ItemCategory')->where([['vendor_id', $Vendor->id], ['menu_category_id', $menu_category_id]])->get();
         return response(['success' => true, 'data' => $HalfNHalfMenu]);
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
       * @param String $menu_category_id
       * @return Response
       */
      public function store(Request $request, string $menu_category_id): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'description' => 'bail|required',
             'item_category_id' => 'bail|required',
             'status' => 'bail|required|integer|in:0,1',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         $data['menu_category_id'] = $menu_category_id;

         ////////// image \\\\\\\\\\
         if(isset($request->image))
         {
            $img = $request->image;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data1 = base64_decode($img);
            $Iname = uniqid();
            $file = public_path('/images/upload/') . $Iname . ".png";
            $success = file_put_contents($file, $data1);
            $data['image'] = $Iname . ".png";
         }
         else
         {
            $data['image'] = 'product_default.jpg';
         }


         HalfNHalfMenu::create($data);

         return response(['success' => true, 'msg' => 'Half n half Menu created.']);
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
       * @param String $menu_category_id
       * @param String $half_n_half_menu_id
       * @return Response
       */
      public function edit(String $menu_category_id, String $half_n_half_menu_id): Response
      {
         $HalfNHalfMenu = HalfNHalfMenu::with('ItemCategory')->find($half_n_half_menu_id);
         return response(['success' => true, 'data' => $HalfNHalfMenu]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param String $menu_category_id
       * @param HalfNHalfMenu $HalfNHalfMenu
       * @return Response
       */
      public function update(Request $request, String $menu_category_id, HalfNHalfMenu $HalfNHalfMenu): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'description' => 'bail|required',
             'item_category_id' => 'bail|required',
             'status' => 'bail|required|integer|in:0,1',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;
         $data['menu_category_id'] = $menu_category_id;

         ////////// image \\\\\\\\\\
         if(isset($request->image))
         {
            $img = $request->image;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data1 = base64_decode($img);
            $Iname = uniqid();
            $file = public_path('/images/upload/') . $Iname . ".png";
            $success = file_put_contents($file, $data1);
            $data['image'] = $Iname . ".png";
         }


         $HalfNHalfMenu->update($data);
         return response(['success' => true, 'msg' => 'Half n half Menu updated.']);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param String $menu_category_id
       * @param HalfNHalfMenu $HalfNHalfMenu
       * @return Response
       */
      public function destroy(String $menu_category_id, HalfNHalfMenu $HalfNHalfMenu): Response
      {
         (new CustomController)->deleteImage(DB::table('half_n_half_menu')->where('id', $HalfNHalfMenu->id)->value('image'));
         $HalfNHalfMenu->delete();
         return response(['success' => true, 'msg' => 'Half n half Menu deleted.']);
      }
   }
