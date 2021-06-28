<?php

declare(strict_types=1);

namespace Huboo;

use Huboo\Client\Parsers\OrderParser;
use Huboo\Client\Requests\Contracts\RequestBuilderFactory;
use Huboo\Client\RequestSender;
use Huboo\Contracts\Client as ClientContract;
use Huboo\Order\Contracts\Order;

class Client implements ClientContract
{
    /**
     * @var RequestSender
     */
    protected RequestSender $requestSender;

    /**
     * @var OrderParser
     */
    protected OrderParser $orderParser;

    /**
     * @var RequestBuilderFactory
     */
    protected RequestBuilderFactory $requestBuilderFactory;

    /**
     * @param RequestSender $requestSender
     * @param OrderParser $orderParser
     * @param RequestBuilderFactory $requestBuilderFactory
     */
    public function __construct(
        RequestSender $requestSender,
        OrderParser $orderParser,
        RequestBuilderFactory $requestBuilderFactory
    ) {
        $this->requestSender = $requestSender;
        $this->orderParser = $orderParser;
        $this->requestBuilderFactory = $requestBuilderFactory;
    }

    /**
     * @param Order $order
     * @return Order
     * @throws Exceptions\UnprocessableRequestException|\Psr\Http\Client\ClientExceptionInterface
     */
    public function createOrder(Order $order): Order
    {
        $builder = $this->requestBuilderFactory->make(RequestTypes::CREATE_ORDER);
        $request = $builder->build($order);
        $response = $this->requestSender->send($request);

        return $this->orderParser->parse($response);
    }

    /**
     * @param string $id
     * @return Order
     * @throws Exceptions\UnprocessableRequestException|\Psr\Http\Client\ClientExceptionInterface
     */
    public function getOrder(string $id): Order
    {
        $builder = $this->requestBuilderFactory->make(RequestTypes::GET_ORDER);
        $request = $builder->build($id);
        $response = $this->requestSender->send($request);

        return $this->orderParser->parse($response);
    }

    /**
     * @param string $id
     * @throws Exceptions\UnauthorizedException
     * @throws Exceptions\UnprocessableRequestException
     * @throws Exceptions\ValidationException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function cancelOrder(string $id)
    {
        $builder = $this->requestBuilderFactory->make(RequestTypes::CANCEL_ORDER);
        $request = $builder->build($id);
        $this->requestSender->send($request);
    }
}
