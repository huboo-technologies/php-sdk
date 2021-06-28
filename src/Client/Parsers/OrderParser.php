<?php

declare(strict_types=1);

namespace Huboo\Client\Parsers;

use Huboo\Exceptions\UnprocessableRequestException;
use Huboo\Order\Address;
use Huboo\Order\Contracts\Address as AddressContract;
use Huboo\Order\Contracts\Order as OrderContract;
use Huboo\Order\Contracts\OrderLine as OrderLineContract;
use Huboo\Order\Contracts\SalesValue as SalesValueContract;
use Huboo\Order\Order;
use Huboo\Order\OrderLine;
use Huboo\Order\SalesValue;
use Psr\Http\Message\ResponseInterface;

class OrderParser extends Parser
{
    /**
     * @param ResponseInterface $response
     * @return OrderContract
     * @throws UnprocessableRequestException
     */
    public function parse(ResponseInterface $response): OrderContract
    {
        $data = $this->convertToArray($response);

        $lines = $this->createOrderLines($data['data']['lines']);
        $address = $this->createAddress($data['data']['address']);

        return new Order(
            $lines,
            $address,
            $data['data']['shippingService'],
            $data['data']['id'],
            $data['data']['status']
        );
    }

    /**
     * @param array $definition
     * @return AddressContract
     */
    protected function createAddress(array $definition): AddressContract
    {
        return new Address(
            $definition['name'],
            $definition['lineOne'],
            $definition['lineTwo'],
            $definition['countryCode'],
            $definition['postcode'],
            $definition['lineThree'],
            $definition['lineFour']
        );
    }

    /**
     * @param array $lineArray
     * @return OrderLineContract[]
     */
    protected function createOrderLines(array $lineArray): array
    {
        $lines = [];
        foreach ($lineArray as $lineDefinition) {
            $lines[] = new OrderLine(
                (int) $lineDefinition['sku'],
                (int) $lineDefinition['quantity'],
                $this->createSalesValue($lineDefinition['salesValue']),
                (int) $lineDefinition['id']
            );
        }

        return $lines;
    }

    /**
     * @param array $definition
     * @return SalesValueContract
     */
    protected function createSalesValue(array $definition): SalesValueContract
    {
        return new SalesValue($definition['amount'], $definition['currency']);
    }
}
