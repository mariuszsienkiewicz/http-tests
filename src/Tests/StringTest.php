<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StringTest implements TestInterface
{
    use LoggerAwareTrait;

    /** @var string */
    private string $url;

    /** @var string */
    private string $string;

    /** @var HttpClientInterface */
    private HttpClientInterface $client;

    /** @var bool */
    private bool $stringHasBeenFound;

    public function __construct(string $url, string $stringToTest)
    {
        $this->url = $url;
        $this->string = $stringToTest;
    }

    /**
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient): void
    {
        $this->client = $httpClient;
    }

    public function runTest(): void
    {
        $searchResult = null;

        try {
            $response = $this->client->request('GET', $this->url);

            $searchResult = null;
            if (200 == $response->getStatusCode()) {
                try {
                    $content = $response->getContent();
                } catch (TransportExceptionInterface $exception) {
                    // log
                }
                $searchResult = stristr($content, $this->string);
            }
        } catch (TransportExceptionInterface $e) {
            // log
        }

        $this->stringHasBeenFound = false !== $searchResult;
        $this->result = false !== $searchResult;
    }

    public function getResult()
    {
        return $this->result;
    }
}