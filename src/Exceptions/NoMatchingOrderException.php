<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

use Huboo\Errors;

class NoMatchingOrderException extends BusinessLogicException
{
    /**
     * @param array $context
     * @param string $responseBody
     */
    public function __construct(array $context, string $responseBody)
    {
        parent::__construct(Errors::NO_MATCHING_ORDER, $context, $responseBody);
    }
}
