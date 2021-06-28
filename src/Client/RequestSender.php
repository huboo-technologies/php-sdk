<?php

declare(strict_types=1);

namespace Huboo\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use Huboo\Exceptions\UnauthorizedException;
use Huboo\Exceptions\UnprocessableRequestException;
use Huboo\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

class RequestSender
{
    /**
     * @var GuzzleClient
     */
    protected GuzzleClient $httpClient;

    /**
     * @param GuzzleClient $httpClient
     */
    public function __construct(GuzzleClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param Request $request
     * @return ResponseInterface
     * @throws UnprocessableRequestException
     * @throws ValidationException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws UnauthorizedException
     */
    public function send(Request $request): ResponseInterface
    {
        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() >= 400) {
            $handler = new ErrorHandler();
            $handler->handle($response);
        }

        return $response;
    }
}
