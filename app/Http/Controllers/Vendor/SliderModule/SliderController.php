<?php
   
   namespace App\Http\Controllers\Vendor\SliderModule;
   
   use App\Http\Controllers\CustomController;
   use DB;
   use Illuminate\Http\Request;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Response;
   use Illuminate\View\View;
   use App\Http\Controllers\Controller;
   use App\Models\Slider;
   use App\Models\Vendor;
   
   class SliderController extends Controller
   {
      /**
       * Display a listing of the resource.
       *
       * @return View
       */
      public function index(): View
      {
         $Vendor = Vendor::where('user_id',auth()->user()->id)->first();
         $Slider = Slider::where('vendor_id',$Vendor->id)->get();
         return view('vendor.slider_module.slider',compact('Vendor', 'Slider'));
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
             'image' => 'required',
             'description' => 'required',
         ]);
         
         $data = $request->all();
         
         
         ////////// image \\\\\\\\\\
         if ($file = $request->hasfile('image'))
         {
            $request->validate(
                ['image' => 'max:5000'],
                [
                    'image.max' => 'The Image May Not Be Greater Than 5 MegaBytes.',
                ]);
            $data['image'] = (new CustomController)->uploadImage($request->image);
         }
         else
         {
            $data['image'] = 'product_default.jpg';
         }
         
         
         Slider::create($data);
         return redirect()->back()->with('msg','Slider created.');
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
       * @param Slider $Slider
       * @return Response
       */
      public function edit(Slider $Slider): Response
      {
         return response(['success' => true , 'data' => $Slider]);
      }
      
      /**
       * Update the specified resource in storage.
       *
       * @param  Request  $request
       * @param  Slider  $Slider
       * @return RedirectResponse
       */
      public function update(Request $request, Slider $Slider): RedirectResponse
      {
         $request->validate([
             'description' => 'required',
         ]);
         
         $data = $request->all();
         
         
         ////////// image \\\\\\\\\\
         if ($request->hasfile('image'))
         {
            $request->validate(
                ['image' => 'max:5000'],
                [
                    'image.max' => 'The Image May Not Be Greater Than 5 MegaBytes.',
                ]);
            (new CustomController)->deleteImage(DB::table('slider')->where('id', $Slider->id)->value('image'));
            $data['image'] = (new CustomController)->uploadImage($data['image']);
         }
         
         
         $Slider->update($data);
         return redirect()->back()->with('msg','Slider updated.');
      }
      
      /**
       * Remove the specified resource from storage.
       *
       * @param  Slider  $Slider
       * @return Response
       */
      public function destroy(Slider $Slider): Response
      {
         (new CustomController)->deleteImage(DB::table('slider')->where('id', $Slider->id)->value('image'));
         $Slider->delete();
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
         $Sliders = Slider::whereIn('id',$ids)->get();
         foreach ($Sliders as $Slider)
         {
            (new CustomController)->deleteImage(DB::table('slider')->where('id', $Slider->id)->value('image'));
            $Slider->delete();
         }
         
         return response(['success' => true]);
      }
   }
