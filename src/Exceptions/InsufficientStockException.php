<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

use Huboo\Errors;

class InsufficientStockException extends BusinessLogicException
{
    /**
     * @param int $sku
     * @param string $responseBody
     * @param int $statusCode
     */
    public function __construct(int $sku, string $responseBody, int $statusCode = 400)
    {
        parent::__construct(Errors::INSUFFICIENT_STOCK, ['sku' => $sku], $responseBody, $statusCode);
    }

    /**
     * @return int
     */
    public function getSku(): int
    {
        return (int) $this->context['sku'];
    }
}
