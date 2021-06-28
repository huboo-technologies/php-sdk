<?php

declare(strict_types=1);

namespace Huboo\Tests;

use GuzzleHttp\Psr7\Response;
use Huboo\Client\Parsers\OrderParser;
use Huboo\Exceptions\UnprocessableRequestException;

$sampleOrder = [
    'data' => [
        'id' => '1001-1618395894-6076c2f608953',
        'lines' => [
            [
                'id' => 321,
                'sku' => 123,
                'quantity' => 3,
                'salesValue' => [
                    'amount' => 22.99,
                    'currency' => 'GBP',
                ],
            ],
        ],
        'address' => [
            'name' => 'George Smith',
            'lineOne' => '1 Mushroom Lane',
            'lineTwo' => 'Middletown',
            'lineThree' => 'Uppercounty',
            'lineFour' => 'Lowerregion',
            'countryCode' => 'GB',
            'postcode' => 'AB1 2CD',
        ],
        'status' => 'In Progress',
        'shippingService' => 'test',
    ],
];

test('Parser throws if json is not readable', function () {
    $parser = new OrderParser();
    $response = new Response(503, [], '503 Bad Gateway');
    $parser->parse($response);
})->expectException(UnprocessableRequestException::class);

test('Parser creates order with sales values fields using sample order', function ($fieldName, $expectedValue) use ($sampleOrder) {
    $parser = new OrderParser();
    $response = new Response(201, [], json_encode($sampleOrder));
    $order = $parser->parse($response);
    expect($order->getLines()[0]->getSalesValue()->toSendableArray()[$fieldName])->toEqual($expectedValue);
})->with([
    ['amount', $sampleOrder['data']['lines'][0]['salesValue']['amount']],
    ['currency', $sampleOrder['data']['lines'][0]['salesValue']['currency']],
]);

test('Parser creates order with line fields using sample order', function ($fieldName, $expectedValue) use ($sampleOrder) {
    $parser = new OrderParser();
    $response = new Response(201, [], json_encode($sampleOrder));
    $order = $parser->parse($response);
    expect($order->getLines()[0]->toSendableArray()[$fieldName])->toEqual($expectedValue);
})->with([
    ['id', $sampleOrder['data']['lines'][0]['id']],
    ['sku', $sampleOrder['data']['lines'][0]['sku']],
    ['quantity', $sampleOrder['data']['lines'][0]['quantity']],
]);

test('Parser creates order with address fields using sample order', function ($fieldName, $expectedValue) use ($sampleOrder) {
    $parser = new OrderParser();
    $response = new Response(201, [], json_encode($sampleOrder));
    $order = $parser->parse($response);
    expect($order->getAddress()->toSendableArray()[$fieldName])->toEqual($expectedValue);
})->with([
    ['name', $sampleOrder['data']['address']['name']],
    ['lineOne', $sampleOrder['data']['address']['lineOne']],
    ['lineTwo', $sampleOrder['data']['address']['lineTwo']],
    ['lineThree', $sampleOrder['data']['address']['lineThree']],
    ['lineFour', $sampleOrder['data']['address']['lineFour']],
    ['countryCode', $sampleOrder['data']['address']['countryCode']],
    ['postcode', $sampleOrder['data']['address']['postcode']],
]);

test('Parser creates order with fields using sample order', function ($fieldName, $expectedValue) use ($sampleOrder) {
    $parser = new OrderParser();
    $response = new Response(201, [], json_encode($sampleOrder));
    $order = $parser->parse($response);
    expect($order->toSendableArray()[$fieldName])->toEqual($expectedValue);
})->with([
    ['id', $sampleOrder['data']['id']],
    ['status', $sampleOrder['data']['status']],
    ['shippingService', $sampleOrder['data']['shippingService']],
]);
