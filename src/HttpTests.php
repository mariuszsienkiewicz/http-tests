<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Request\Request;
use Mariuszsienkiewicz\HttpTests\Request\RequestCache;
use Mariuszsienkiewicz\HttpTests\Request\Url;
use Mariuszsienkiewicz\HttpTests\Picker\PickerInterface;
use Mariuszsienkiewicz\HttpTests\Types\RunnableInterface;
use Mariuszsienkiewicz\HttpTests\Test\TestInterface;
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
    public static function create(?HttpClientInterface $httpClient = null): HttpTests
    {
        if (null != $httpClient) {
            return new HttpTests($httpClient);
        }

        return new HttpTests(HttpClient::create());
    }

    /**
     * @param string $url
     * @param array $tests
     * @return array
     */
    public function runMultiple(string $url, array $tests): array
    {
        $requestCache = new RequestCache();

        $results = [];

        /** @var TestInterface|RunnableInterface|PickerInterface $test */
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
                $test->run();

                $result = $test;
                array_push($results, $result);
            } catch (TransportExceptionInterface $exception) {
                error_log($exception);
            }
        }

        return $results;
    }

    /**
     * @param string $url
     * @param TestInterface $test
     * @return TestInterface
     * @throws TransportExceptionInterface
     */
    public function run(string $url, RunnableInterface $test): RunnableInterface
    {
        $response = $this->httpClient->request($test->getMethod(), $url);

        $test->setResponse($response);
        $test->run();

        return $test;
    }
}
