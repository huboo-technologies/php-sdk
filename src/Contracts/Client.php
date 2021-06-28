<?php

declare(strict_types=1);

namespace Huboo\Contracts;

use Huboo\Order\Contracts\Order;

interface Client
{
    public function createOrder(Order $order): Order;
}
