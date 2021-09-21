<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Mariuszsienkiewicz\HttpTests\Result\HttpStatusTestResult;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpStatusTest implements TestInterface
{

    /** @var string */
    private string $url;

    /** @var int|null */
    private ?int $httpStatusCode;

    /** @var HttpClientInterface */
    private HttpClientInterface $client;

    /** @var ResponseInterface */
    private ResponseInterface $response;

    /**
     * WebsiteStatusTest constructor.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient): void
    {
        $this->client = $httpClient;
    }

    /**
     * Get status code.
     *
     * @throws TransportExceptionInterface
     */
    public function runTest()
    {
        $response = $this->client->request('GET', $this->url);

        try {
            $responseCode = $response->getStatusCode();
        } catch (TransportExceptionInterface $exception) {
            return null;
        }

        $this->httpStatusCode = $responseCode;
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return int|null
     */
    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getResult(): HttpStatusTestResult
    {
        return new HttpStatusTestResult($this);
    }
}