<?php

declare(strict_types=1);

namespace Huboo\Order;

use Huboo\Order\Contracts\SalesValue as SalesValueContract;

class SalesValue implements SalesValueContract
{
    /**
     * @var float
     */
    protected float $amount;

    /**
     * @var string
     */
    protected string $currency;

    /**
     * @param float $amount
     * @param string $currency
     */
    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @inheritDoc
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @inheritDoc
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @inheritDoc
     */
    public function toSendableArray(): array
    {
        return [
            'amount' => $this->amount,
            'currency' => $this->currency,
        ];
    }
}
