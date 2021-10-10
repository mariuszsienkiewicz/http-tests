<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Request\Request;
use Mariuszsienkiewicz\HttpTests\Request\RequestCache;
use Mariuszsienkiewicz\HttpTests\Request\Url;
use Mariuszsienkiewicz\HttpTests\Types\TestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpTests implements HttpTestsInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var HttpClientInterface */
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param HttpClientInterface|null $httpClient
     * @return HttpTests
     */
    public static function create(?HttpClientInterface $httpClient = null): HttpTests
    {
        if (null != $httpClient) {
            return new HttpTests($httpClient);
        }

        return new HttpTests(HttpClient::create());
    }

    public function runTests(string $url, array $tests)
    {
        $requestCache = new RequestCache();

        $results = [];

        /** @var TestInterface $test */
        foreach ($tests as $test) {
            try {
                $response = null;

                if (!$requestCache->isInCache($url)) {
                    $response = $this->httpClient->request($test->getMethod(), $url);

                    $request = new Request($url, $test->getMethod(), $response);
                    $requestCache->add($request);
                } else {
                    $response = $requestCache->get($url);
                }

                $test->setResponse($response);
                $test->runTest();

                $result = $test;
                array_push($results, $result);
            } catch (TransportExceptionInterface $exception) {
                error_log($exception);
            }
        }

        return $results;
    }

    public function runTest(string $url, TestInterface $test): TestInterface
    {
        $response = $this->httpClient->request($test->getMethod(), $url);

        $test->setResponse($response);
        $test->runTest();

        return $test;
    }
}
