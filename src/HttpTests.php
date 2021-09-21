<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpTests implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var HttpClientInterface */
    private $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param HttpClientInterface|null $httpClient
     * @return HttpTests
     */
    public static function create(?HttpClientInterface $httpClient = null)
    {
        if ($httpClient != null) {
            return new HttpTests($httpClient);
        }

        return new HttpTests(HttpClient::create());
    }

    /**
     * @param TestInterface $test
     * @return mixed
     */
    public function test(TestInterface $test)
    {
        $this->logger->info('test');
        $test->setHttpClient($this->httpClient);
        $test->runTest();

        return $test->getResult();
    }
}