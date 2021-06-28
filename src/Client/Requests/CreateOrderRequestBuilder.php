<?php

declare(strict_types=1);

namespace Huboo\Client\Requests;

use GuzzleHttp\Psr7\Request;
use Huboo\Order\Contracts\Order;

class CreateOrderRequestBuilder extends RequestBuilder
{
    /**
     * @param Order $order
     * @return Request
     */
    public function build(Order $order): Request
    {
        return new Request(
            'post',
            $this->uri.'/order',
            $this->getCommonHeaders(),
            json_encode($order->toSendableArray())
        );
    }
}
