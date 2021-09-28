<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface TestInterface
{
    public function runTest();
    public function setResponse(ResponseInterface $response): void;
    public function getMethod(): string;
    public function getUrl(): string;
}