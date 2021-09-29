<?php

namespace Mariuszsienkiewicz\HttpTests;

use Mariuszsienkiewicz\HttpTests\Exception\NetworkException;
use Mariuszsienkiewicz\HttpTests\Request\Request;
use Mariuszsienkiewicz\HttpTests\Request\RequestCache;
use Mariuszsienkiewicz\HttpTests\Request\Url;
use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpTests implements HttpTestsInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var HttpClientInterface */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return HttpTests
     */
    public static function create(?HttpClientInterface $httpClient = null)
    {
        if (null != $httpClient) {
            return new HttpTests($httpClient);
        }

        return new HttpTests(HttpClient::create());
    }

    public function testMultiple(array $tests)
    {
        $requestCache = new RequestCache();

        $httpTests = [];

        /** @var TestInterface $test */
        foreach ($tests as $test) {
            $url = new Url($test->getUrl());
            $response = null;

            if (!$requestCache->isInCache($url)) {
                $response = $this->httpClient->request($test->getMethod(), $test->getUrl());

                $request = new Request($url, $test->getMethod(), $response);
                $requestCache->add($request);
            } else {
                $response = $requestCache->get($url);
            }

            $test->setResponse($response);
            $test->runTest();

            $result = $test->getResult()->getAsArray();
            array_push($httpTests, $result);
        }

        return $httpTests;
    }

    /**
     * @throws NetworkException
     *
     * @return mixed
     */
    public function test(TestInterface $test)
    {
        $response = $this->httpClient->request($test->getMethod(), $test->getUrl());

        $test->setResponse($response);
        $test->runTest();

        return $test->getResult();
    }
}
