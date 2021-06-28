<?php

declare(strict_types=1);

namespace Huboo\Client\Requests;

use GuzzleHttp\Psr7\Request;

class GetOrderRequestBuilder extends RequestBuilder
{
    /**
     * @param string $id
     * @return Request
     */
    public function build(string $id): Request
    {
        return new Request(
            'get',
            $this->uri.'/order/'.$id,
            $this->getCommonHeaders()
        );
    }
}
