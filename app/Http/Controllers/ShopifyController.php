<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\Mail\OrderUpdate;
use Illuminate\Support\Facades\Mail;

use Socialite;
use GuzzleHttp\Client;


class ShopifyController extends Controller
{
    public $scopes;
    public $shop;

    public function __construct()
    {
        $this->scopes = ['read_products', 'read_orders', 'write_products', 'read_customers', 'write_customers'];
        $this->shop = env('SHOPIFY_SHOP');
        $this->client = new Client();
    }

    public function connect(Request $request)
    {
        $token = $this->getAccessToken();
        if ($token) {
            return redirect('/')->with('success', 'Successfully Connected!');
        }
        $request->offsetSet('shop', $this->shop);
        $shopifyApp = Socialite::with('shopify')->setScopes($this->scopes);
        return $shopifyApp->redirect();
    }

    public function getResponse(Request $request)
    {
        if ($request->state) {
            session()->put('response', $request->all());
        }
        $shopifyUser = session('shopifyUser');

        if (!$shopifyUser) {
            $shopifyUser = Socialite::driver('shopify')->user();
        }

        if ($shopifyUser) {
            session()->put('shopifyUser', $shopifyUser);
        }
        return redirect('/')->with('success', 'Successfully Connected!');
    }

    public function getAccessToken()
    {
        $shopifyUser = session('shopifyUser');
        if ($shopifyUser) {
            return $shopifyUser->accessTokenResponseBody ? $shopifyUser->accessTokenResponseBody['access_token'] : null;
        }
        return null;
    }

    public function getProduct(Request $request, $id = null)
    {
        $accessToken =  $this->getAccessToken();
        if ($accessToken) {
            $path = $id ? "products/$id" : "products";
            try {
                $request = $this->client->get("https://$this->shop/admin/$path.json", [
                    'headers' => [
                        'Accept'                 => 'application/json',
                        'X-Shopify-Access-Token' => $accessToken,
                    ],
                ]);
                $response = $request->getBody();
            } catch(\Exception $e){
                $errorShop = $e->getMessage();
                return view('result', ['message' => ['type' => 'danger', 'text' => $errorShop]]);
            }

            $products = $response->getContents();
            $products = json_decode($products, true);

            return view('result', ['data' => $products]);
        }
        return view('result', ['message' => ['type' => 'warning', 'text' => 'Your store not connected please <a href="/connect">connect</a> and try again.']]);
    }

    public function getOrders(Request $request, $id = null)
    {
        $accessToken =  $this->getAccessToken();
        if ($accessToken) {
            $path = $id ? "orders/$id" : "orders";
            try {
                $request = $this->client->get("https://$this->shop/admin/$path.json", [
                    'headers' => [
                        'Accept'                 => 'application/json',
                        'X-Shopify-Access-Token' => $accessToken,
                    ],
                ]);
                $response = $request->getBody();
            } catch(\Exception $e){
                $errorShop = $e->getMessage();
                return view('result', ['message' => ['type' => 'danger', 'text' => $errorShop]]);
            }

            $orders = $response->getContents();
            $orders = json_decode($orders, true);

            return view('result', ['data' => $orders]);
        }
        return view('result', ['message' => ['type' => 'warning', 'text' => 'Your store not connected please <a href="/connect">connect</a> and try again.']]);
    }

    public function orderWebhook(Request $request, $status = null)
    {
        $customer = $status == 'shipped' ? $request->destination : $request->customer;
        $data = [];
        if ($customer) {
            $data =  [
                'customer_name'   => $customer['first_name'].' '. $customer['last_name'],
                'email'           => $status == 'shipped' ? $request['email'] : $customer['email'],
                'order_id'        => $status == 'shipped' ? $request['order_id'] : $request['order_number']
            ];

            if ($status == 'shipped') {
                $data['tracking_url']    = $request['tracking_url'];
                $data['tracking_number'] = $request['tracking_number'];
            }

            Mail::to($data['email'])->send($status == 'shipped' ? new OrderShipped($data) : new OrderUpdate($data, $status));

            \Log::info("Order successfully $status!");
        }
    }
}
