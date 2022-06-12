<?php
namespace Maree\Oto;

use Illuminate\Support\Facades\Http;

class Oto {
    
    // $itemDetails = ['weight' => 50 ,'totalDue' => 0 ,'originCity' => '','destinationCity' => ''];
    public static function checkOTODeliveryFee($itemDetails = []){
        $data = [
          'weight'            => $itemDetails['weight'],
          'totalDue'          => $itemDetails['totalDue'],
          'originCity'        => $itemDetails['originCity'],
          'destinationCity'   => $itemDetails['destinationCity'],
        ];

        $url = config('oto.mode') == 'live' ? config('fawry.live_urls')['check_delivery_fee'] : config('fawry.test_urls')['check_delivery_fee'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return $responseResult;
    }
    
    // $orderData   = ['orderId' => 1 ,'payment_method' => 'paid', 'amount' => '40','amount_due' => 0,'packageCount' => 10,'packageWeight' => 1 , 'orderDate' => '2022-06-12 22:30'];
    // $customeData = ['name' =>'mohamed maree' ,'email' => 'm7mdmaree26@gmail.com' , 'mobile' => '010027*****'];
    // $addressData = ['address' => '20 ,maree street, almehalla alkubra,Saudi Arabia','district' => 'maree district' ,'city' => 'almehalla' ,'country' => 'SA' ,'lat' => '30.837645','lng' => '30.23456'];
    // $items       = ["productId" => '123', "name"      => 'book', "price"     => '12', "rowTotal"  => '15', "taxAmount" => '3', "quantity"  => '2', "sku"  => 'arabic_book', "image"     => ''];
    public static function createOrder($orderData = [],$customeData = [],$addressData = [],$items = []){


        $data = [
          "orderId"           => $orderData['orderData'],
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
              "address"   => $addressData['addressData'],
              "district"  => $addressData['district'],
              "city"      => $addressData['city'],
              "country"   => $addressData['country'],
              "lat"       => $addressData['lat'],
              "lon"       => $addressData['lng']
          ],
          "items" => $items
        ];

        $url = config('oto.mode') == 'live' ? config('fawry.live_urls')['create_order'] : config('fawry.test_urls')['create_order'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return $responseResult;

    }

    public static function createShipment($orderId, $deliveryOptionId){
        $data = [
          'orderId'            => $orderId,
          'deliveryOptionId'   => $deliveryOptionId,
        ];

        $url = config('oto.mode') == 'live' ? config('fawry.live_urls')['create_shipment'] : config('fawry.test_urls')['create_shipment'];
        $response = Http::withHeaders([
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'Authorization' => 'Bearer ' . config('oto.access_token')
        ])->post($url, $data);

        $responseResult = json_decode($response->getBody()->getContents(), true);
        return $responseResult;

    }


}