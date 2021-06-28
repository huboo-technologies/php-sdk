<?php

declare(strict_types=1);

namespace Huboo\Order\Contracts;

use Huboo\Contracts\Sendable;

interface Address extends Sendable
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getLineOne(): string;

    /**
     * @return string
     */
    public function getLineTwo(): string;

    /**
     * @return string|null
     */
    public function getLineThree(): ?string;

    /**
     * @return string|null
     */
    public function getLineFour(): ?string;

    /**
     * @return string
     */
    public function getCountryCode(): string;

    /**
     * @return string
     */
    public function getPostcode(): string;
}
