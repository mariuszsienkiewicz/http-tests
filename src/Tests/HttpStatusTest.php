<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Mariuszsienkiewicz\HttpTests\Exception\NetworkException;
use Mariuszsienkiewicz\HttpTests\Exception\NoResponseObjectException;
use Mariuszsienkiewicz\HttpTests\Result\HttpStatusTestResult;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpStatusTest implements TestInterface
{
    private string $url;

    private ?int $httpStatusCode;

    /** @var ResponseInterface */
    private $response;

    /** @var HttpStatusTestResult */
    private $result;

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
            throw new NoResponseObjectException('Response has not been set.');
        }

        try {
            $responseCode = $this->response->getStatusCode();
        } catch (TransportExceptionInterface $exception) {
            throw new NetworkException();
        }

        $this->httpStatusCode = $responseCode;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getResult(): HttpStatusTestResult
    {
        if (!$this->result) {
            $this->createResult();
        }

        return $this->result;
    }

    public function createResult()
    {
        $this->result = new HttpStatusTestResult($this);
    }

    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }
}
