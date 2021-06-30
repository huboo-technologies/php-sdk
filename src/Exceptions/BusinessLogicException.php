<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

class BusinessLogicException extends UnprocessableRequestException
{
    /**
     * @var string
     */
    protected string $errorCode;

    /**
     * @var array
     */
    protected array $context;

    /**
     * BusinessLogicException constructor.
     * @param string $errorCode
     * @param array $context
     * @param string $responseBody
     * @param int $statusCode
     */
    public function __construct(string $errorCode, array $context, string $responseBody, int $statusCode)
    {
        parent::__construct('A business logic exception occurred', $statusCode, $responseBody);
        $this->errorCode = $errorCode;
        $this->context = $context;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}
