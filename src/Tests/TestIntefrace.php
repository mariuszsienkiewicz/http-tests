<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Symfony\Contracts\HttpClient\HttpClientInterface;

interface TestInterface
{
    public function runTest();
    public function setHttpClient(HttpClientInterface $httpClient);
    public function getResult();
}