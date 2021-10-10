<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Types\TestInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

interface HttpTestsInterface
{
    public static function create(HttpClientInterface $httpClient = null);

    public function runTest(string $url, TestInterface $test);

    public function runTests(string $url, array $tests);
}
