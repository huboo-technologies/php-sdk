<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

use Huboo\Errors;

class InsufficientStockException extends BusinessLogicException
{
    /**
     * @param int $sku
     * @param string $responseBody
     */
    public function __construct(int $sku, string $responseBody)
    {
        parent::__construct(Errors::INSUFFICIENT_STOCK, ['sku' => $sku], $responseBody);
    }

    /**
     * @return int
     */
    public function getSku(): int
    {
        return (int) $this->context['sku'];
    }
}
