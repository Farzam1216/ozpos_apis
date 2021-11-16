<?php
   
   namespace App\Http\Controllers\Api\Vendor\MenuModule;
   
   use App\Http\Controllers\CustomController;
   use App\Models\ItemCategory;
   use App\Models\DealsMenu;
   use App\Models\DealsMenuItemCategory;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;
   
   class DealsMenuController extends Controller
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
         $DealsMenu = DealsMenu::where([['vendor_id', $Vendor->id], ['menu_category_id', $menu_category_id]])->get();
         return response(['success' => true, 'data' => $DealsMenu]);
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
      public function store(Request $request, String $menu_category_id): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'description' => 'bail|required',
             'display_price' => 'bail|required|numeric|between:0,999999.99',
             'display_discount_price' => 'bail|nullable|numeric|between:0,999999.99',
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
   
   
         ////////// price \\\\\\\\\\
         if (isset($data['display_discount_price']))
            $data['price'] = $data['display_discount_price'];
         else
            $data['price'] = $data['display_price'];
         
         
         DealsMenu::create($data);
         
         return response(['success' => true, 'msg' => 'Deals Menu created.']);
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
       * @param DealsMenu $DealsMenu
       * @return Response
       */
      public function edit(String $menu_category_id, DealsMenu $DealsMenu): Response
      {
         return response(['success' => true , 'data' => $DealsMenu]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param String $menu_category_id
       * @param DealsMenu $DealsMenu
       * @return Response
       */
      public function update(Request $request, String $menu_category_id, DealsMenu $DealsMenu): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'description' => 'bail|required',
             'display_price' => 'bail|required|numeric|between:0,999999.99',
             'display_discount_price' => 'bail|nullable|numeric|between:0,999999.99',
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
   
   
         ////////// price \\\\\\\\\\
         if (isset($data['display_discount_price']))
            $data['price'] = $data['display_discount_price'];
         else
            $data['price'] = $data['display_price'];
         
         
         $DealsMenu->update($data);
         
         return response(['success' => true, 'msg' => 'Deals Menu updated.']);
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param String $menu_category_id
       * @param DealsMenu $DealsMenu
       * @return Response
       */
      public function destroy(String $menu_category_id, DealsMenu $DealsMenu): Response
      {
         (new CustomController)->deleteImage(DB::table('menu')->where('id', $DealsMenu->id)->value('image'));
         $DealsMenu->delete();
         return response(['success' => true, 'msg' => 'Deals Menu deleted.']);
      }
   }
