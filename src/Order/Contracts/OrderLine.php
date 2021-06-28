<?php

declare(strict_types=1);

namespace Huboo\Order\Contracts;

use Huboo\Contracts\Sendable;

interface OrderLine extends Sendable
{
    /**
     * Retrieve the SKU of the product the line relates to.
     * @note This is the Huboo SKU and not the SKU in your marketplace or internal systems.
     * @return int
     */
    public function getSku(): int;

    /**
     * Get the quantity of items on the orderline.
     * @return int
     */
    public function getQuantity(): int;

    /**
     * Get the value of the sale.
     * @return SalesValue
     */
    public function getSalesValue(): SalesValue;

    /**
     * ID of the orderline. This will only be populated for entries coming back from the Huboo API.
     * @return int|null
     */
    public function getId(): ?int;
}
