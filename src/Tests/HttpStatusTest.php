<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Mariuszsienkiewicz\HttpTests\Exception\NoResponseObjectException;
use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Mariuszsienkiewicz\HttpTests\Result\HttpStatusTestResult;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\Asset\Package;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Mariuszsienkiewicz\HttpTests\Exception\NetworkException;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpStatusTest implements TestInterface
{

    /** @var string */
    private string $url;

    /** @var int|null */
    private ?int $httpStatusCode;

    /** @var ResponseInterface $response */
    private $response;

    /** @var HttpStatusTestResult $result */
    private $result;

    /** @var string $method */
    private string $method = 'GET';

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get status code.
     *
     * @throws TransportExceptionInterface
     */
    public function runTest(): void
    {
        if (!$this->response) {
            throw new NoResponseObjectException("Response has not been set.");
        }

        try {
            $responseCode = $this->response->getStatusCode();
        } catch (TransportExceptionInterface $exception) {
            throw new NetworkException();
        }
        
        $this->httpStatusCode = $responseCode;
    }

    /**
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void
    {
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
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return HttpStatusTestResult
     */
    public function getResult(): HttpStatusTestResult
    {
        if (!$this->result) {
            $this->createResult();
        }

        return $this->result;
    }

    public function createResult() {
        $this->result = new HttpStatusTestResult($this);
    }

    /**
     * @return int|null
     */
    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }
}