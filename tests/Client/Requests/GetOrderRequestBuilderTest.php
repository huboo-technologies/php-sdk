<?php

declare(strict_types=1);

namespace Huboo\Tests;

use Huboo\Client\Requests\GetOrderRequestBuilder;

test('Uri is formatted correctly with order id', function () {
    $fixture = 'abc-123-456-abc';
    $uri = 'http://api.huboo.co/';
    $builder = new GetOrderRequestBuilder('123', $uri);
    $request = $builder->build($fixture);
    expect((string) $request->getUri())
        ->toMatch('/^'.preg_quote($uri, '/').'order\/'.preg_quote($fixture, '/').'$/');
});

test('Order ID is inserted into the URI', function () {
    $fixture = 'abc-123-456-abc';
    $builder = new GetOrderRequestBuilder('123', 'http://api.huboo.co/');
    $request = $builder->build($fixture);
    expect((string) $request->getUri())->toContain('/'.$fixture);
});

test('URI does not apply double trailing slash if trailing slash is passed as apiUrl', function () {
    $builder = new GetOrderRequestBuilder('123', 'http://api.huboo.co/');
    $request = $builder->build('123');
    expect((string) $request->getUri())->not()->toContain('//order');
});
