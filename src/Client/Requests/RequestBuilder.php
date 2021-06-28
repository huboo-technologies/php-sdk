<?php

declare(strict_types=1);

namespace Huboo\Client\Requests;

abstract class RequestBuilder
{
    /**
     * @var string
     */
    protected string $apiKey;

    /**
     * @var string
     */
    protected string $uri;

    /**
     * @param string $apiKey
     * @param string $uri
     */
    public function __construct(string $apiKey, string $uri)
    {
        $this->apiKey = $apiKey;
        $this->uri = rtrim($uri, '/');
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string[]
     */
    protected function getCommonHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$this->apiKey,
        ];
    }
}
