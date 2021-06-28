<?php

declare(strict_types=1);

namespace Huboo\Order;

use Huboo\Order\Contracts\Address;
use Huboo\Order\Contracts\Order;
use Huboo\Order\Contracts\OrderBuilder as OrderBuilderContract;
use Huboo\Order\Contracts\OrderLine;
use Huboo\Order\Order as OrderImplementation;

class OrderBuilder implements OrderBuilderContract
{
    /**
     * @var array
     */
    protected array $lines;

    /**
     * @var Address|null
     */
    protected ?Address $address;

    /**
     * @var string|null
     */
    protected ?string $shippingService;

    /**
     * @param array $lines
     * @param Address|null $address
     * @param string|null $shippingService
     */
    public function __construct(array $lines = [], ?Address $address = null, ?string $shippingService = null)
    {
        $this->lines = $lines;
        $this->address = $address;
        $this->shippingService = $shippingService;
    }

    /**
     * @inheritDoc
     */
    public function addLine(OrderLine $line)
    {
        $lines = $this->lines;
        array_push($lines, $line);

        return new self($lines, $this->address, $this->shippingService);
    }

    /**
     * @inheritDoc
     */
    public function setAddress(Address $address)
    {
        return new self($this->lines, $address, $this->shippingService);
    }

    /**
     * @inheritDoc
     */
    public function setShippingService(string $shippingService)
    {
        return new self($this->lines, $this->address, $shippingService);
    }

    /**
     * @inheritDoc
     */
    public function build(): Order
    {
        return new OrderImplementation($this->lines, $this->address, $this->shippingService);
    }
}
