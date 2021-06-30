<?php

declare(strict_types=1);

namespace Huboo\Client;

use Huboo\Exceptions\UnauthorizedException;
use Huboo\Exceptions\UnprocessableRequestException;
use Huboo\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

class ErrorHandler
{
    /**
     * @var BusinessLogicExceptionFactory
     */
    private BusinessLogicExceptionFactory $exceptionFactory;

    /**
     * ErrorHandler constructor.
     */
    public function __construct()
    {
        $this->exceptionFactory = new BusinessLogicExceptionFactory();
    }

    /**
     * @param ResponseInterface $response
     * @throws UnprocessableRequestException
     */
    public function handle(ResponseInterface $response)
    {
        $responseBody = $response->getBody()->getContents();
        if ($response->getStatusCode() === 400 || $response->getStatusCode() === 404) {
            $responseData = $this->parseResponseBody($responseBody);
            throw $this->exceptionFactory->make($responseData['code'], $responseData['context'], $responseBody, $response->getStatusCode());
        } elseif ($response->getStatusCode() === 422) {
            $responseData = $this->parseResponseBody($responseBody);
            throw new ValidationException($responseData['errors'], $responseBody);
        } elseif ($response->getStatusCode() === 401) {
            throw new UnauthorizedException($responseBody);
        } else {
            $this->handleUnknownError($response->getStatusCode(), $responseBody);
        }
    }

    /**
     * @param int $statusCode
     * @param string $responseBody
     * @throws UnprocessableRequestException
     */
    protected function handleUnknownError(int $statusCode, string $responseBody)
    {
        throw new UnprocessableRequestException(
            'Unable to process request',
            $statusCode,
            $responseBody
        );
    }

    /**
     * @param string $responseBody
     * @return array
     */
    protected function parseResponseBody(string $responseBody): array
    {
        return json_decode($responseBody, true);
    }
}
