<?php

declare(strict_types=1);

namespace Huboo\Tests;

use Huboo\Client\Requests\RequestBuilderFactory;
use Huboo\Exceptions\InvalidArgumentException;

test('InvalidArgumentException thrown if invalid type passed', function () {
    $factory = new RequestBuilderFactory('123', 'http://api.huboo.co');
    $factory->make('invalid');
})->expectException(InvalidArgumentException::class);
