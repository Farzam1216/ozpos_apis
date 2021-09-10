<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected $database;

    public function __construct()
    {
        $this->database = app('firebase.database');
    }

    public function setOrder($userID, $orderID, $orderStatus)
    {
        $this->database->getReference('orders/'.$userID.'/'.$orderID)
            ->set([
                'status' => $orderStatus,
            ]);
    }

    public function setOrderStatus($orderID, $orderStatus)
    {
        $this->database->getReference('orders/'.$orderID)
            ->set([
                'status' => $orderStatus,
            ]);
    }
}
