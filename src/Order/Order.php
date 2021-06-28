<?php

declare(strict_types=1);

namespace Huboo\Order;

use Huboo\Order\Contracts\Address;
use Huboo\Order\Contracts\Order as OrderContract;
use Huboo\Order\Contracts\OrderLine;

class Order implements OrderContract
{
    /**
     * @var array
     */
    protected array $lines;

    /**
     * @var Address
     */
    protected Address $address;

    /**
     * @var string
     */
    protected string $shippingService;

    /**
     * @var string|null
     */
    protected ?string $status;

    /**
     * @var string|null
     */
    protected ?string $id;

    /**
     * @param array $lines
     * @param Address $address
     * @param string $shippingService
     * @param string|null $id
     * @param string|null $status
     */
    public function __construct(
        array $lines,
        Address $address,
        string $shippingService,
        ?string $id = null,
        ?string $status = ''
    ) {
        $this->lines = $lines;
        $this->address = $address;
        $this->shippingService = $shippingService;
        $this->id = $id;
        $this->status = $status;
    }

    /**
     * @inheritDoc
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @inheritDoc
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @inheritDoc
     */
    public function getShippingService(): string
    {
        return $this->shippingService;
    }

    /**
     * @inheritDoc
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function toSendableArray(): array
    {
        $array = [
            'lines' => array_map(function (OrderLine $line) {
                return $line->toSendableArray();
            }, $this->lines),
            'address' => $this->address->toSendableArray(),
            'shippingService' => $this->shippingService,
        ];

        if ($this->id) {
            $array['id'] = $this->id;
        }

        if ($this->status) {
            $array['status'] = $this->status;
        }

        return $array;
    }
}
