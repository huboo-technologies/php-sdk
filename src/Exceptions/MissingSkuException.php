<?php

declare(strict_types=1);

namespace Huboo\Exceptions;

use Huboo\Errors;

class MissingSkuException extends BusinessLogicException
{
    /**
     * @param int[] $skus
     * @param string $responseBody
     * @param int $statusCode
     */
    public function __construct(array $skus, string $responseBody, int $statusCode = 400)
    {
        parent::__construct(Errors::MISSING_SKU, ['skus' => $skus], $responseBody, $statusCode);
    }

    /**
     * Get the SKUs that could not be found in the request.
     * @return int[]
     */
    public function getSkus(): array
    {
        return $this->context['skus'];
    }
}
