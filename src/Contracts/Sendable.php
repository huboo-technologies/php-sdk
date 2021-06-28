<?php

declare(strict_types=1);

namespace Huboo\Contracts;

interface Sendable
{
    /**
     * @return array
     */
    public function toSendableArray(): array;
}
