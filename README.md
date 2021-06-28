# Huboo Public API - PHP SDK

[![Test and Inspect](https://github.com/huboo-technologies/php-sdk/actions/workflows/php.yml/badge.svg)](https://github.com/huboo-technologies/php-sdk/actions/workflows/php.yml)

## Documentation

You can find documentation on the public api https://api-docs.huboo.uk

## Supported Versions

Currently, this SDK only supports PHP version `7.4+`

## Installation

You can install the Huboo PHP SDK using the following command:

`composer require huboo/php-sdk`

### Getting Started


```php
require __DIR__ . '/vendor/autoload.php';

$factory = new ClientFactory();
$client = $factory->create('[API Key]');

$orderBuilder = new OrderBuilder();
$order = $orderBuilder
    ->addLine(new OrderLine(1, 1, new SalesValue(123.45, 'GBP')))
    ->setAddress(new Address('Test', 'Mushroom Lane', 'Big Street', 'GB', 'BS1 1AB'))
    ->setShippingService('test')
    ->build();

try {
    $createdOrder = $client->createOrder($order);
} catch (UnprocessableRequestException $error) {
    echo $error->getResponse();
}
```