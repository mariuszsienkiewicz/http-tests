<?php

namespace Mariuszsienkiewicz\HttpTests;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

interface HttpTestsInterface
{
    public function test();
}