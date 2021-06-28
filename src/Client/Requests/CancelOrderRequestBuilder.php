<?php

declare(strict_types=1);

namespace Huboo\Client\Requests;

use GuzzleHttp\Psr7\Request;

class CancelOrderRequestBuilder extends RequestBuilder
{
    /**
     * @param string $id
     * @return Request
     */
    public function build(string $id): Request
    {
        return new Request(
            'delete',
            $this->getUri().'/order/'.$id,
            $this->getCommonHeaders()
        );
    }
}
