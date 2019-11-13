<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Mail\OrderUpdate;
use Illuminate\Support\Facades\Mail;

class ShopifyController extends Controller
{

    public function orderStatus(Request $request, $status)
    {
        $customer = $status == 'shipped' ? $request->destination : $request->customer;

        if($customer) {
          $data =  [
            'customer_name'   => $customer['first_name'].' '. $customer['last_name'],
            'email'           => $status == 'shipped' ? $request['email'] : $customer['email'],
            'order_id'        => $status == 'shipped' ? $request['order_id'] : $request['order_number']
          ];

          if($status == 'shipped') {
              $data['tracking_url']    = $request['tracking_url'];
              $data['tracking_number'] = $request['tracking_number'];
          }

          Mail::to($data['email'])->send($status == 'shipped' ? new OrderShipped($data) : new OrderUpdate($data, $status));
        }
    }
}
