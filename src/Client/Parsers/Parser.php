<?php

declare(strict_types=1);

namespace Huboo\Client\Parsers;

use Huboo\Exceptions\UnprocessableRequestException;
use Psr\Http\Message\ResponseInterface;

abstract class Parser
{
    /**
     * @param ResponseInterface $response
     * @return mixed
     * @throws UnprocessableRequestException
     */
    public function convertToArray(ResponseInterface $response)
    {
        try {
            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $error) {
            throw new UnprocessableRequestException(
                'Unable to parse response from API',
                $response->getStatusCode(),
                $response->getBody()->getContents(),
                $error
            );
        }
    }
}
