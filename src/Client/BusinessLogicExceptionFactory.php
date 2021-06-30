<?php

declare(strict_types=1);

namespace Huboo\Client;

use Huboo\Errors;
use Huboo\Exceptions\BusinessLogicException;
use Huboo\Exceptions\InsufficientStockException;
use Huboo\Exceptions\MissingSkuException;
use Huboo\Exceptions\NoMatchingOrderException;

class BusinessLogicExceptionFactory
{
    /**
     * @param string $errorCode
     * @param array $context
     * @param string $responseBody
     * @param int $statusCode
     * @return BusinessLogicException
     */
    public function make(string $errorCode, array $context, string $responseBody, int $statusCode): BusinessLogicException
    {
        switch ($errorCode) {
            case Errors::INSUFFICIENT_STOCK:
                return $this->createInsufficientStockException($context, $responseBody);
            case Errors::MISSING_SKU:
                return $this->createMissingSkuException($context, $responseBody);
            case Errors::NO_MATCHING_ORDER:
                return $this->createNoMatchingOrderException($context, $responseBody, $statusCode);
            default:
                return new BusinessLogicException($errorCode, $context, $responseBody, $statusCode);
        }
    }

    /**
     * @param array $context
     * @param string $responseBody
     * @param int $statusCode
     * @return NoMatchingOrderException
     */
    protected function createNoMatchingOrderException(array $context, string $responseBody, int $statusCode): NoMatchingOrderException
    {
        return new NoMatchingOrderException($context, $responseBody, $statusCode);
    }

    /**
     * @param array $context
     * @param string $responseBody
     * @return MissingSkuException
     */
    protected function createMissingSkuException(array $context, string $responseBody): MissingSkuException
    {
        return new MissingSkuException($context['skus'], $responseBody);
    }

    /**
     * @param array $context
     * @param string $responseBody
     * @return InsufficientStockException
     */
    protected function createInsufficientStockException(array $context, string $responseBody): InsufficientStockException
    {
        return new InsufficientStockException($context['sku'], $responseBody);
    }
}
