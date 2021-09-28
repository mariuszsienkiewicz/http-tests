<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface TestResultInterface
{
    public function getAsArray(): array;
}