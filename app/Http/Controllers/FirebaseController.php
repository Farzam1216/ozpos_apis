<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    protected mixed $database;

    public function __construct()
    {
        $this->database = app('firebase.database');
    }

    public function setOrder($orderID)
    {
        $this->database->getReference('orders')
            ->set($orderID);
        $this->database->getReference('orders/111')
            ->set([
                'status' => 'PENDING',
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
