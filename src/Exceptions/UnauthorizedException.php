<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

class UnauthorizedException extends UnprocessableRequestException
{
    /**
     * @param string $responseBody
     */
    public function __construct(string $responseBody)
    {
        parent::__construct('Unauthorized, please check your API key', 401, $responseBody);
    }
}
