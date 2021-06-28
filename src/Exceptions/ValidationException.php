<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

class ValidationException extends UnprocessableRequestException
{
    /**
     * @var array
     */
    protected array $errors;

    /**
     * @param array $errors
     * @param string $responseBody
     */
    public function __construct(array $errors, string $responseBody)
    {
        parent::__construct('A validation error occurred', 422, $responseBody);
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
