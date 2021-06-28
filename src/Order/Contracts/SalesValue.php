<?php

declare(strict_types=1);

namespace Huboo\Order\Contracts;

use Huboo\Contracts\Sendable;

interface SalesValue extends Sendable
{
    /**
     * Get the amount of the currency.
     * @return float
     */
    public function getAmount(): float;

    /**
     * Get the currency of the amount.
     * @return string
     */
    public function getCurrency(): string;
}
