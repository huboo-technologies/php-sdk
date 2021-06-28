<?php

declare(strict_types=1);

namespace Huboo;

use GuzzleHttp\Client as GuzzleClient;
use Huboo\Client\Parsers\OrderParser;
use Huboo\Client\Requests\RequestBuilderFactory;
use Huboo\Client\RequestSender;

class ClientFactory
{
    /**
     * @param string $apiKey
     * @param string $apiUrl
     * @return Client
     */
    public function create(string $apiKey, string $apiUrl = 'https://api.huboo.uk/v2/')
    {
        $guzzleClient = $this->createGuzzleClient();
        $requestSender = new RequestSender($guzzleClient);
        $orderParser = new OrderParser();

        $requestBuilderFactory = new RequestBuilderFactory($apiKey, $apiUrl);

        return new Client($requestSender, $orderParser, $requestBuilderFactory);
    }

    /**
     * @return GuzzleClient
     */
    protected function createGuzzleClient(): GuzzleClient
    {
        return new GuzzleClient([
            'http_errors' => false,
        ]);
    }
}
