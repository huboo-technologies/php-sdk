<?php

declare(strict_types=1);

namespace Huboo\Order\Contracts;

use Huboo\Contracts\Sendable;

interface Order extends Sendable
{
    /**
     * Get the orderlines associated with the order.
     * @return OrderLine[]
     */
    public function getLines(): array;

    /**
     * @return Address
     */
    public function getAddress(): Address;

    /**
     * @return string
     */
    public function getShippingService(): string;

    /**
     * @return string|null
     */
    public function getStatus(): ?string;

    /**
     * Get the ID of the order in the Huboo API. It should be noted, that this field will only be populated on
     * orders retrieved from the Huboo API or orders that have just been created.
     * @return string|null
     */
    public function getId(): ?string;
}
