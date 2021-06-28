<?php

declare(strict_types=1);

namespace Huboo\Client\Requests\Contracts;

interface RequestBuilderFactory
{
    /**
     * Will return the appropriate RequestBuilder type for the request being made.
     * @return mixed
     */
    public function make(string $type);
}
