<?php

declare(strict_types=1);

namespace Huboo\Contracts;

use GuzzleHttp\Psr7\Request;

interface RequestSender
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function send(Request $request);
}
