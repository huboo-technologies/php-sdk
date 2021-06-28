<?php

declare(strict_types=1);

namespace Huboo\Contracts;

use GuzzleHttp\Psr7\Request;

interface RequestSender
{
    public function send(Request $request);
}
