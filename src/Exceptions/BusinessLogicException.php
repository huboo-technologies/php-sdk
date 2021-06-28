<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

class BusinessLogicException extends UnprocessableRequestException
{
    protected string $errorCode;

    protected array $context;

    public function __construct(string $errorCode, array $context, string $responseBody)
    {
        parent::__construct('A business logic exception occurred', 400, $responseBody);
        $this->errorCode = $errorCode;
        $this->context = $context;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}
