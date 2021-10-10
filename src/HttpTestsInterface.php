<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Types\RunnableInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

interface HttpTestsInterface
{
    public static function create(HttpClientInterface $httpClient = null);

    public function run(string $url, RunnableInterface $test);

    public function runMultiple(string $url, array $tests);
}
