<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Exception\NetworkException;
use Mariuszsienkiewicz\HttpTests\Request\Url;
use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class HttpTests implements HttpTestsInterface, LoggerAwareInterface
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
     *
     * @throws NetworkException
     * @return mixed
     */
    public function test(TestInterface $test)
    {
        try {
            $response = $this->httpClient->request($test->getMethod(), $test->getUrl());

            $test->setResponse($response);
            $test->runTest();

            return $test->getResult();
        } catch (NetworkException $e) {
            if ($this->logger) {
                $this->logger->log(LogLevel::ERROR, $e->getMessage());
            }
        }

        return null;
    }
}