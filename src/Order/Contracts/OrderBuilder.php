<?php

declare(strict_types=1);

namespace Huboo\Order\Contracts;

interface OrderBuilder
{
    /**
     * @param string $shippingService
     * @return self
     */
    public function setShippingService(string $shippingService);

    /**
     * @param Address $address
     * @return self
     */
    public function setAddress(Address $address);

    /**
     * @param OrderLine $line
     * @return self
     */
    public function addLine(OrderLine $line);

    /**
     * @return Order
     */
    public function build(): Order;
}
