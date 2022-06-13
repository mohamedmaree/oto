<?php
namespace Maree\Oto;

use Illuminate\Support\Facades\Http;

class Oto {

    public static function refreshToken(){
        $data = [ "refresh_token"  => config('oto.refresh_token') ];
        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['refresh_token'] : config('oto.test_urls')['refresh_token'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ])->post($url, $data);
        config(['oto.access_token' => json_decode($response)->access_token]);
        
        return json_decode($response)->access_token;
    }


    public static function availableCities($limit = 10,$page = 1){
        Oto::refreshToken();
        $data = ["limit" => $limit , 'page' => $page];

        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['available_cities'] : config('oto.test_urls')['available_cities'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return json_encode($responseResult);
    }

    // $itemDetails = ['weight' => 50 ,'totalDue' => 0 ,'originCity' => '','destinationCity' => ''];
    public static function checkDeliveryFee($itemDetails = []){
        Oto::refreshToken();
        $data = [
          'weight'            => $itemDetails['weight'],
          'totalDue'          => $itemDetails['totalDue'],
          'originCity'        => $itemDetails['originCity'],
          'destinationCity'   => $itemDetails['destinationCity'],
        ];

        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['check_delivery_fee'] : config('oto.test_urls')['check_delivery_fee'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return json_encode($responseResult);
    }
    
    // $orderData   = ['orderId' => 1 ,'payment_method' => 'paid', 'amount' => '40','amount_due' => 0,'packageCount' => 10,'packageWeight' => 1 , 'orderDate' => '2022-06-12 22:30'];
    // $customeData = ['name' =>'mohamed maree' ,'email' => 'm7mdmaree26@gmail.com' , 'mobile' => '010027*****'];
    // $addressData = ['address' => '20 ,maree street, almehalla alkubra,Saudi Arabia','district' => 'maree district' ,'city' => 'almehalla' ,'country' => 'SA' ,'lat' => '30.837645','lng' => '30.23456'];
    // $items       = ["productId" => '123', "name"      => 'book', "price"     => '12', "rowTotal"  => '15', "taxAmount" => '3', "quantity"  => '2', "sku"  => 'arabic_book', "image"     => ''];
    public static function createOrder($orderData = [],$customeData = [],$addressData = [],$items = []){
        Oto::refreshToken();

        $data = [
          "orderId"           => $orderData['orderId'],
          "payment_method"    => $orderData['payment_method'],
          "amount"            => $orderData['amount'],
          "amount_due"        => $orderData['amount_due'],
          "currency"          => config('oto.currency'),
          "packageCount"      => $orderData['packageCount'],
          "packageWeight"     => $orderData['packageWeight'],
          "orderDate"         => $orderData['orderDate'],
          "customer" => [
              "name"      => $customeData['name'],
              "email"     => $customeData['email'],
              "mobile"    => $customeData['mobile'],
              "address"   => $addressData['address'],
              "district"  => $addressData['district'],
              "city"      => $addressData['city'],
              "country"   => $addressData['country'],
              "lat"       => $addressData['lat'],
              "lon"       => $addressData['lng']
          ],
          "items" => $items
        ];

        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['create_order'] : config('oto.test_urls')['create_order'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return json_encode($responseResult);

    }

    public static function cancelOrder($orderId){
        Oto::refreshToken();
        $data = [
          'orderId'      => $orderId
        ];
        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['cancel_order'] : config('oto.test_urls')['cancel_order'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return json_encode($responseResult);
    }

    public static function orderStatus($orderId){
        Oto::refreshToken();
        $data = [
          'orderId'      => $orderId
        ];
        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['order_status'] : config('oto.test_urls')['order_status'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return json_encode($responseResult);
    }


    public static function createShipment($orderId, $deliveryOptionId=''){
        Oto::refreshToken();
        $data = [
          'orderId'            => $orderId,
          'deliveryOptionId'   => $deliveryOptionId,
        ];

        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['create_shipment'] : config('oto.test_urls')['create_shipment'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return json_encode($responseResult);

    }

    public static function createReturnShipment($orderId){
        Oto::refreshToken();
        $data = [
          'orderId'            => $orderId,
        ];

        $url = config('oto.mode') == 'live' ? config('oto.live_urls')['create_return_shipment'] : config('oto.test_urls')['create_return_shipment'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return json_encode($responseResult);

    }


}