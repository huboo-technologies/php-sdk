<?php

declare(strict_types=1);

namespace Huboo\Order;

use Huboo\Order\Contracts\OrderLine as OrderLineContract;
use Huboo\Order\Contracts\SalesValue;

class OrderLine implements OrderLineContract
{
    /**
     * @var int
     */
    protected int $sku;

    /**
     * @var int
     */
    protected int $quantity;

    /**
     * @var SalesValue
     */
    protected SalesValue $salesValue;

    /**
     * @var int|null
     */
    protected ?int $id;

    /**
     * @param int $sku
     * @param int $quantity
     * @param SalesValue $salesValue
     * @param int|null $id
     */
    public function __construct(int $sku, int $quantity, SalesValue $salesValue, ?int $id = null)
    {
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->salesValue = $salesValue;
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */
    public function getSku(): int
    {
        return $this->sku;
    }

    /**
     * @inheritDoc
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @inheritDoc
     */
    public function getSalesValue(): SalesValue
    {
        return $this->salesValue;
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function toSendableArray(): array
    {
        $array = [
            'sku' => $this->sku,
            'quantity' => $this->quantity,
            'salesValue' => $this->salesValue->toSendableArray(),
        ];

        if ($this->id) {
            $array['id'] = $this->id;
        }

        return $array;
    }
}
