<?php

declare(strict_types=1);

namespace Huboo\Tests;

use Huboo\Client\Requests\CreateOrderRequestBuilder;
use Huboo\Order\Address;
use Huboo\Order\Order;

test('URI does not apply double trailing slash if trailing slash is passed as apiUrl', function () {
    $builder = new CreateOrderRequestBuilder('123', 'http://api.huboo.co/');
    $order = new Order([], new Address('', '', '', '', ''), 'test');
    $request = $builder->build($order);
    expect((string) $request->getUri())->not()->toContain('//order');
});
