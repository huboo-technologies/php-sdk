<?php

declare(strict_types=1);

namespace Huboo\Client\Requests;

use Huboo\Client\Requests\Contracts\RequestBuilderFactory as RequestBuilderFactoryContract;
use Huboo\Exceptions\InvalidArgumentException;
use Huboo\RequestTypes;

class RequestBuilderFactory implements RequestBuilderFactoryContract
{
    /**
     * @var string
     */
    protected string $apiKey;

    /**
     * @var string
     */
    protected string $apiUrl;

    /**
     * @var array|string[]
     */
    protected array $map = [
        RequestTypes::CREATE_ORDER => CreateOrderRequestBuilder::class,
        RequestTypes::GET_ORDER => GetOrderRequestBuilder::class,
        RequestTypes::CANCEL_ORDER => CancelOrderRequestBuilder::class,
    ];

    /**
     * @param string $apiKey
     * @param string $apiUrl
     */
    public function __construct(string $apiKey, string $apiUrl)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param string $type
     * @return CreateOrderRequestBuilder
     * @throws InvalidArgumentException
     */
    public function make(string $type)
    {
        if (! isset($this->map[$type])) {
            throw new InvalidArgumentException('Unrecognized request type');
        }

        return new $this->map[$type]($this->apiKey, $this->apiUrl);
    }
}
