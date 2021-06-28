<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

use Exception;
use Throwable;

class UnprocessableRequestException extends Exception
{
    /**
     * @var int
     */
    protected int $statusCode;

    /**
     * @var string
     */
    protected string $responseBody;

    /**
     * @param string $message
     * @param int $statusCode
     * @param string $responseBody
     * @param Throwable|null $previous
     */
    public function __construct($message, int $statusCode, string $responseBody, ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->statusCode = $statusCode;
        $this->responseBody = $responseBody;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->responseBody;
    }
}
