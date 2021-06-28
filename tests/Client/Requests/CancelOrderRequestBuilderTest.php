<?php

declare(strict_types=1);

namespace Huboo\Tests;

use Huboo\Client\Requests\CancelOrderRequestBuilder;

test('Order ID is appended to URI', function () {
    $fixture = 'abc-123-345';
    $builder = new CancelOrderRequestBuilder('123', 'http://api.huboo.co/');
    $request = $builder->build($fixture);
    expect((string) $request->getUri())->toContain($fixture);
});

test('URI does not apply double trailing slash if trailing slash is passed as apiUrl', function () {
    $builder = new CancelOrderRequestBuilder('123', 'http://api.huboo.co/');
    $request = $builder->build('abc-123');
    expect((string) $request->getUri())->not()->toContain('//order');
});
