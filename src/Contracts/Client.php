<?php

declare(strict_types=1);

namespace Huboo\Contracts;

use Huboo\Exceptions\UnprocessableRequestException;
use Huboo\Order\Contracts\Order;

interface Client
{
    /**
     * @param Order $order
     * @return Order
     * @throws UnprocessableRequestException
     */
    public function createOrder(Order $order): Order;

    /**
     * @param string $id
     * @return Order
     * @throws UnprocessableRequestException
     */
    public function getOrder(string $id): Order;

    /**
     * @param string $id
     * @return mixed
     */
    public function cancelOrder(string $id);
}
