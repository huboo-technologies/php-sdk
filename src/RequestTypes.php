<?php

declare(strict_types=1);

namespace Huboo;

abstract class RequestTypes
{
    public const CREATE_ORDER = 'CREATE_ORDER';
    public const CANCEL_ORDER = 'CANCEL_ORDER';
    public const GET_ORDER = 'GET_ORDER';
}
