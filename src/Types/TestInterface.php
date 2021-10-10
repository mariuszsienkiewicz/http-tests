<?php

namespace Mariuszsienkiewicz\HttpTests\Types;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface TestInterface
{
    public function runTest();

    public function setResponse(ResponseInterface $response): void;

    public function getMethod(): string;
}
