<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationTemplate;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Auth;

class NotificationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::where('user_id',Auth::user()->id)->first();
        if (session()->has('locale'))
        {
            $lang = session()->get('locale');
            if ($lang == "spanish")
            {
                $data = NotificationTemplate::where('role','admin')->get();
                foreach ($data as $value)
                {
                    $value->notification_content = $value->spanish_notification_content;
                    $value->mail_content = $value->spanish_mail_content;
                }
            }
            else
            {
                $data =  NotificationTemplate::where('role','admin')->get();
            }
        }
        else
        {
            $data =NotificationTemplate::all();
        }
        $vendor_id =$vendor->id;

        $check =  NotificationTemplate::where('vendor_id',$vendor->id)->where('title','book order')->first();
        if($check){
          $statusCheck = $check->status;
        }
        else{
          $statusCheck = 0;
        }

        return view('admin.notification template.notification_template',compact('data','vendor_id','statusCheck'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification template.create_notification_template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        NotificationTemplate::create($request->all());
        return redirect('admin/notification_template')->with('msg','notification template created successfully..!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationTemplate $notificationTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationTemplate $notificationTemplate)
    {
      $vendor = Vendor::where('user_id',Auth::user()->id)->first();
      $check = NotificationTemplate::where('vendor_id',$vendor->id)->where('title',$notificationTemplate['title'])->where('role',null)->first();
      if($check){
        $status = $check->status;
      }
      else{
        $status = 0;
      }
      return response(['success' => true,'data' => $notificationTemplate,'statusCheck' => $status]);
    }

    public function getStatus(Request $request){

      $notify = NotificationTemplate::where('id',$request->id)->first();
      $vendor = Vendor::where('user_id',Auth::user()->id)->first();
      $check = NotificationTemplate::where('vendor_id',$vendor->id)->where('title',$notify->title)->first();
      if($check){
        $status = $check->status;
      }
      else{
        $status = 0;
      }
      return response(['success' => true,'statusChecks' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationTemplate $notificationTemplate)
    {
        $vendor = Vendor::where('user_id',Auth::user()->id)->first();
        $data = $request->all();
        if (isset($data['status'])) {
          $data['status'] = 1;
        } else {
          $data['status'] = 0;
        }
        $data['vendor_id']  = $vendor->id;
        $check = NotificationTemplate::where('vendor_id',$vendor->id)->where('title',$request->title)->where('role',null)->first();
        if($check)
        {
          $check->update($data);
        }
        else
        {
          NotificationTemplate::create($data);
        }
        return redirect('/notification_template')->with('msg','notification template updated successfully..!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationTemplate  $notificationTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationTemplate $notificationTemplate)
    {
        //
    }
}
