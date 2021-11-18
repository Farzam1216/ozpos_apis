<?php

   namespace App\Http\Controllers\Api\Vendor\MenuModule;

   use App\Http\Controllers\CustomController;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\Support\Facades\Validator;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Menu;
   use App\Models\Vendor;

   class MenuController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return Response
       */
      public function index(): Response
      {
         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();
         $Menu = Menu::where('vendor_id', $Vendor->id)->get();
         return response(['success' => true, 'data' => $Menu]);
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
             'description' => 'bail|required',
             'display_price' => 'nullable|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;


         ////////// price \\\\\\\\\\
         if (isset($data['display_price'])) {
            if (isset($data['display_discount_price']))
               $data['price'] = $data['display_discount_price'];
            else
               $data['price'] = $data['display_price'];
         } else {
            $data['price'] = null;
         }


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


         Menu::create($data);
         return response(['success' => true, 'msg' => 'Menu created.']);
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
       * @param Menu $Menu
       * @return Response
       */
      public function edit(Menu $Menu): Response
      {
         return response(['success' => true, 'data' => $Menu]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param Request $request
       * @param Menu $Menu
       * @return Response
       */
      public function update(Request $request, Menu $Menu): Response
      {
         $validator = Validator::make($request->all(), [
             'name' => 'bail|required',
             'description' => 'bail|required',
             'display_price' => 'nullable|numeric|between:0,999999.99',
             'display_discount_price' => 'nullable|numeric|between:0,999999.99',
         ]);

         if ($validator->fails())
            return response(['success' => false, 'msg' => $validator->messages()->first()]);

         $Vendor = Vendor::where('user_id', auth()->user()->id)->first();

         if (!$Vendor)
            return response(['success' => false, 'msg' => 'Vendor not found.']);

         $data = $request->all();
         $data['vendor_id'] = $Vendor->id;


         ////////// price \\\\\\\\\\
         if (isset($data['display_price'])) {
            if (isset($data['display_discount_price']))
               $data['price'] = $data['display_discount_price'];
            else
               $data['price'] = $data['display_price'];
         } else {
            $data['price'] = null;
         }


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


         $Menu->update($data);
         return response(['success' => true, 'msg' => 'Menu updated.']);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param Menu $Menu
       * @return Response
       */
      public function destroy(Menu $Menu): Response
      {
         (new CustomController)->deleteImage(DB::table('menu')->where('id', $Menu->id)->value('image'));
         $Menu->delete();
         return response(['success' => true, 'msg' => 'Menu deleted.']);
      }
   }
