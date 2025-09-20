# Oto PHP Package 🚀

A PHP package to integrate with [Oto](https://www.tryoto.com) API for shipments, deliveries, and order management in Saudi Arabia.

---

## 📦 Installation

Install via [Composer](https://getcomposer.org):

```bash
composer require maree/oto
```

Publish the configuration file:

```bash
php artisan vendor:publish --provider="Maree\Oto\OtoServiceProvider" --tag="oto"
```

Then configure your settings in `config/oto.php`:

```php
return [
    "refresh_token" => "", // Take it from Oto company
    "mode"          => "test", // Use "live" in production
    "currency"      => "SAR",
];
```

---

## ⚡ Usage

### 1️⃣ Get Available Cities

```php
use Maree\Oto\Oto;

$response = Oto::availableCities($limit, $page);
```

### 2️⃣ Get Cities (New)

```php
use Maree\Oto\Oto;

$response = Oto::getCities();
```

### 3️⃣ Check Delivery Fee

```php
use Maree\Oto\Oto;

$itemDetails = [
    'weight' => 50,
    'totalDue' => 0,
    'originCity' => 'Riyadh',
    'destinationCity' => 'Jeddah'
];

$response = Oto::checkDeliveryFee($itemDetails);
```

### 4️⃣ Create Order

```php
use Maree\Oto\Oto;

$orderData = [
    'orderId' => 1,
    'payment_method' => 'paid',
    'amount' => '40',
    'amount_due' => 0,
    'packageCount' => 10,
    'packageWeight' => 1,
    'orderDate' => '2022-06-12 22:30',
];

$customerData = [
    'name' => 'Mohamed Maree',
    'email' => 'm7mdmaree26@gmail.com',
    'mobile' => '010027*****',
];

$addressData = [
    'address' => '20, Maree Street, Almehalla Alkubra, Saudi Arabia',
    'district' => 'Maree District',
    'city' => 'Almehalla',
    'country' => 'SA',
    'lat' => '30.837645',
    'lng' => '30.23456',
];

$items = [
    [
        "productId" => '123',
        "name" => 'Book',
        "price" => '12',
        "rowTotal" => '15',
        "taxAmount" => '3',
        "quantity" => '2',
        "sku" => 'arabic_book',
        "image" => ''
    ],
    [
        "productId" => '145',
        "name" => 'Math Book',
        "price" => '18',
        "rowTotal" => '20',
        "taxAmount" => '1',
        "quantity" => '3',
        "sku" => 'math_book',
        "image" => ''
    ]
];

$response = Oto::createOrder($orderData, $customerData, $addressData, $items);
```

### 5️⃣ Cancel Order

```php
use Maree\Oto\Oto;

$response = Oto::cancelOrder($orderId);
```

### 6️⃣ Get Order Status

```php
use Maree\Oto\Oto;

$response = Oto::orderStatus($orderId);
```

### 7️⃣ Create Shipment

```php
use Maree\Oto\Oto;

$response = Oto::createShipment($orderId, $deliveryOptionId);
```

### 8️⃣ Create Return Shipment

```php
use Maree\Oto\Oto;

$response = Oto::createReturnShipment($orderId);
```

### 9️⃣ Create Pickup Location (New)

```php
use Maree\Oto\Oto;

$pickupData = [
    'name' => 'Main Branch',
    'address' => '123 King Street, Riyadh',
    'city' => 'Riyadh',
    'district' => 'Central',
    'phone' => '0501234567'
];

$response = Oto::createPickupLocation($pickupData);
```

### 🔟 Print AWB (New)

```php
use Maree\Oto\Oto;

$response = Oto::printAWB($shipmentId);
```

---

## 📚 Documentation

- [Oto Official Documentation](https://www.tryoto.com)

---
