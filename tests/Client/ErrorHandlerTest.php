<?php

declare(strict_types=1);

namespace Huboo\Tests;

use GuzzleHttp\Psr7\Response;
use Huboo\Client\ErrorHandler;
use Huboo\Errors;
use Huboo\Exceptions\InsufficientStockException;
use Huboo\Exceptions\MissingSkuException;
use Huboo\Exceptions\UnauthorizedException;
use Huboo\Exceptions\UnprocessableRequestException;

test('Insufficient stock exception thrown for 400 responses with '.Errors::INSUFFICIENT_STOCK.'code', function () {
    $handler = new ErrorHandler();
    $response = new Response(400, [], json_encode(['code' => Errors::INSUFFICIENT_STOCK, 'context' => ['sku' => 123]]));
    $handler->handle($response);
})->throws(InsufficientStockException::class);

test('Missing SKU exception thrown for 400 responses with '.Errors::MISSING_SKU.' code', function () {
    $handler = new ErrorHandler();
    $response = new Response(400, [], json_encode(['code' => Errors::MISSING_SKU, 'context' => ['skus' => [123]]]));
    $handler->handle($response);
})->throws(MissingSkuException::class);

test('Unauthorized exception thrown for 401 responses', function () {
    $handler = new ErrorHandler();
    $response = new Response(401);
    $handler->handle($response);
})->throws(UnauthorizedException::class);

test('Unprocessable request exception thrown for errors >= 500', function () {
    $handler = new ErrorHandler();
    $response = new Response(500);
    $handler->handle($response);
})->throws(UnprocessableRequestException::class);
