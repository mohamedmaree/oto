<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Merchant account authorization info
    |--------------------------------------------------------------------------
    |
    |
    */

    "refresh_token"  => "",
    "access_token"   => "" ,

    /*
    |--------------------------------------------------------------------------
    | Oto Mode
    |--------------------------------------------------------------------------
    |
    | Mode only values: "test" or "live"
    |
    */

    "mode"     => "test",

    /*
    |--------------------------------------------------------------------------
    | Oto currency
    |--------------------------------------------------------------------------
    | EGP , SAR , USD, .. etc
    */

    "currency" => "SAR" ,

    /*
    |--------------------------------------------------------------------------
    | TEST Payment Request url
    |--------------------------------------------------------------------------
    */

    "test_urls" => [
            "refresh_token"         => "https://api.tryoto.com/rest/v2/refreshToken",
            "available_cities"      => "https://api.tryoto.com/rest/v2/availableCities",
            "check_delivery_fee"    => "https://api.tryoto.com/rest/v2/checkOTODeliveryFee",
            "create_order"          => "https://api.tryoto.com/rest/v2/createOrder",
            "cancel_order"          => "https://api.tryoto.com/rest/v2/cancelOrder",
            "order_status"          => "https://api.tryoto.com/rest/v2/orderStatus",
            "create_shipment"       => "https://api.tryoto.com/rest/v2/createShipment",
            "create_return_shipment"=> "https://api.tryoto.com/rest/v2/createReturnShipment",
            
            ],
    /*
    |--------------------------------------------------------------------------
    | LIVE Payment Request url
    |--------------------------------------------------------------------------
    */

    "live_urls" => [ 
            "refresh_token"         => "",
            "available_cities"      => "",
            "check_delivery_fee"    => "",
            "create_order"          => "",
            "cancel_order"          => "",
            "order_status"          => "",
            "create_shipment"       => "",
            "create_return_shipment"=> "",
    ],



];