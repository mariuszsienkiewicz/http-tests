<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

interface HttpTestsInterface
{
    public static function create(HttpClientInterface $httpClient = null);

    public function test(TestInterface $test);
}
