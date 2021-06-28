<?php

declare(strict_types=1);

namespace Huboo\Order;

use Huboo\Order\Contracts\Address as AddressContract;

class Address implements AddressContract
{
    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $lineOne;

    /**
     * @var string
     */
    protected string $lineTwo;

    /**
     * @var string|null
     */
    protected ?string $lineThree;

    /**
     * @var string|null
     */
    protected ?string $lineFour;

    /**
     * @var string
     */
    protected string $countryCode;

    /**
     * @var string
     */
    protected string $postcode;

    /**
     * @param string $name
     * @param string $lineOne
     * @param string $lineTwo
     * @param string $countryCode
     * @param string $postcode
     * @param string|null $lineThree
     * @param string|null $lineFour
     */
    public function __construct(
        string $name,
        string $lineOne,
        string $lineTwo,
        string $countryCode,
        string $postcode,
        ?string $lineThree = null,
        ?string $lineFour = null
    ) {
        $this->name = $name;
        $this->lineOne = $lineOne;
        $this->lineTwo = $lineTwo;
        $this->lineThree = $lineThree;
        $this->lineFour = $lineFour;
        $this->postcode = $postcode;
        $this->countryCode = $countryCode;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getLineOne(): string
    {
        return $this->lineOne;
    }

    /**
     * @inheritDoc
     */
    public function getLineTwo(): string
    {
        return $this->lineTwo;
    }

    /**
     * @return string|null
     */
    public function getLineThree(): ?string
    {
        return $this->lineThree;
    }

    /**
     * @inheritDoc
     */
    public function getLineFour(): ?string
    {
        return $this->lineFour;
    }

    /**
     * @inheritDoc
     */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @inheritDoc
     */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @inheritDoc
     */
    public function toSendableArray(): array
    {
        $array = [
            'name' => $this->name,
            'lineOne' => $this->lineOne,
            'lineTwo' => $this->lineTwo,
            'countryCode' => $this->countryCode,
            'postcode' => $this->postcode,
        ];

        if ($this->lineThree) {
            $array['lineThree'] = $this->lineThree;
        }

        if ($this->lineFour) {
            $array['lineFour'] = $this->lineFour;
        }

        return $array;
    }
}
