<?php

declare(strict_types=1);

use Huboo\Client\BusinessLogicExceptionFactory;
use Huboo\Errors;
use Huboo\Exceptions\InsufficientStockException;
use Huboo\Exceptions\MissingSkuException;
use Huboo\Exceptions\NoMatchingOrderException;

test('Error code matches exception type', function ($errorCode, $exceptionType, $context = []) {
    $factory = new BusinessLogicExceptionFactory();
    $exception = $factory->make($errorCode, $context, '');
    expect($exception)->toBeInstanceOf($exceptionType);
})->with([
    [Errors::NO_MATCHING_ORDER, NoMatchingOrderException::class],
    [Errors::MISSING_SKU, MissingSkuException::class, ['skus' => [123]]],
    [Errors::INSUFFICIENT_STOCK, InsufficientStockException::class, ['sku' => 123]],
]);
