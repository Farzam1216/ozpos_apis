<?php

namespace App\Http\Controllers;

use App\Mail\StatusChange;
use App\Mail\VendorOrder;
use App\Models\GeneralSetting;
use App\Models\Notification;
use App\Models\NotificationTemplate;
use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use Config;
use Mail;
use OneSignal;
use Log;

class NotificationController extends Controller
{
    protected string $to = 'customer';
    protected string $type = '';
    protected string $title = '';
    protected array $template = array(
        'vendor' => array(
            'order' => "Dear %s new order arrived. OrderID: %s, By User: %s, On: %s",
        ),
        'driver' => array(
        ),
        'customer' => array(
            'change_status' => "Dear %s your order %s created on %s is %s",
        ),
    );

    protected function configOnesignal()
    {
        switch($this->to)
        {
            case 'vendor':
                Config::set('onesignal.app_id', env('vendor_app_id'));
                Config::set('onesignal.rest_api_key', env('vendor_auth_key'));
                Config::set('onesignal.user_auth_key', env('vendor_api_key'));
                break;
            case 'driver':
                Config::set('onesignal.app_id', env('driver_app_id'));
                Config::set('onesignal.rest_api_key', env('driver_auth_key'));
                Config::set('onesignal.user_auth_key', env('driver_api_key'));
                break;
            case 'customer':
                Config::set('onesignal.app_id', env('customer_app_id'));
                Config::set('onesignal.rest_api_key', env('customer_auth_key'));
                Config::set('onesignal.user_auth_key', env('customer_api_key'));
                break;
        }
    }

    /* ================================================================================= */
    /* ================================================================================= */
    /* ================================================================================= */
    protected function notify($message, $userID)
    {
        $notifyArr = array();
        $notifyArr['title'] = $this->title;
        $notifyArr['user_type'] = $this->to;
        $notifyArr['user_id'] = $userID;
        $notifyArr['message'] = $message;

        Notification::create($notifyArr);
    }
    protected function push($message, $token)
    {
        try {
            OneSignal::sendNotificationToUser(
                $message,
                $token,
                $url = null,
                $data = null,
                $buttons = null,
                $schedule = null,
                $this->title
            );
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    protected function mail($message, $email)
    {
        try {
            Mail::to($email)->send(new VendorOrder($message));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    /* ================================================================================= */
    /* ================================================================================= */
    /* ================================================================================= */

    public function process($to, $type, $title, $user, $arg1 = NULL, $arg2 = NULL, $arg3 = NULL, $arg4 = NULL, $arg5 = NULL, $arg6 = NULL)
    {
        if ($user[1] == null)
            return false;

        $this->to = $to;
        $this->type = $type;
        $this->title = $title;
        $this->notify(sprintf($this->template[$this->to][$this->type], $arg1, $arg2, $arg3, $arg4, $arg5, $arg6), $user[0]);

        if (GeneralSetting::find(1)->customer_notification == 1)
        {
            $this->configOnesignal();
            $this->push(sprintf($this->template[$this->to][$this->type], $arg1, $arg2, $arg3, $arg4, $arg5, $arg6), $user[1]);
        }

        if (GeneralSetting::first()->customer_mail == 1)
        {
            $this->mail(sprintf($this->template[$this->to][$this->type], $arg1, $arg2, $arg3, $arg4, $arg5, $arg6), $user[2]);
        }
        return true;
    }

    public function toCustomer($title, $user_id, $order_id)
    {
        $user = User::find($user_id);
        $order = Order::find($order_id);

        if ($user->device_token == null)
            return false;

        $this->type = 'customer';
        $this->notify($title, sprintf($this->template[$this->type]['change_status'], $user->name, $order->order_id, $order->time, $order->order_status), $user->id);

        if (GeneralSetting::find(1)->customer_notification == 1)
        {
            $this->configOnesignal();
            $this->push($title, sprintf($this->template[$this->type]['change_status'], $user->name, $order->order_id, $order->time, $order->order_status), $user->device_token);
        }

        if (GeneralSetting::first()->customer_mail == 1)
        {
            $this->mail($title, sprintf($this->template[$this->type]['change_status'], $user->name, $order->order_id, $order->time, $order->order_status), $user->email_id);
        }
        return true;
    }

    public function toVendor($title, $vendor_id, $order_id)
    {
        $vendor = Vendor::find($vendor_id);
        $user = User::find($vendor->user_id);
        $order = Order::find($order_id);
        $customer = auth()->user();

        if ($user->device_token == null)
            return;

        $this->type = 'vendor';
        $this->notify($title, sprintf($this->template[$this->type]['order'], $vendor->name, $order->order_id, $customer->name, $order->time), $vendor->id);

        if (GeneralSetting::find(1)->vendor_notification == 1)
        {
            $this->configOnesignal();
            $this->push($title, sprintf($this->template[$this->type]['order'], $vendor->name, $order->order_id, $customer->name, $order->time), $user->device_token);
        }

        if (GeneralSetting::first()->vendor_mail == 1)
        {
            $this->mail($title, sprintf($this->template[$this->type]['order'], $vendor->name, $order->order_id, $customer->name, $order->time), $vendor->email_id);
        }
    }

}
