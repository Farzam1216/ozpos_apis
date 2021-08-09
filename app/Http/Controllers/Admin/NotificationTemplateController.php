<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationTemplate;
use Illuminate\Http\Request;
use App;

class NotificationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session()->has('locale'))
        {
            $lang = session()->get('locale');
            if ($lang == "spanish") 
            {
                $data = NotificationTemplate::all();
                foreach ($data as $value) 
                {
                    $value->notification_content = $value->spanish_notification_content;
                    $value->mail_content = $value->spanish_mail_content;
                }
            }
            else
            {
                $data = NotificationTemplate::all();
            }
        }
        else
        {
            $data = NotificationTemplate::all();
        }
        return view('admin.notification template.notification_template',compact('data'));
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
        if (session()->has('locale')) 
        {
            $lang = session()->get('locale');
            if ($lang == "spanish") 
            {
                $notificationTemplate->notification_content = $notificationTemplate->spanish_notification_content;
                $notificationTemplate->mail_content = $notificationTemplate->spanish_mail_content;
            }
        }
        return response(['success' => true,'data' => $notificationTemplate]);
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
        $data = $request->all();
        if (session()->has('locale')) 
        {
            $lang = session()->get('locale');
            if ($lang == "spanish") 
            {
                $notificationTemplate->spanish_notification_content = $data['notification_content'];
                $notificationTemplate->spanish_mail_content = $data['mail_content'];
                $notificationTemplate->save();
            }
            else
            {
                $notificationTemplate->update($data);
            }
        }
        else
        {
            $notificationTemplate->update($data);
        }
        return redirect('admin/notification_template')->with('msg','notification template updated successfully..!!');
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
