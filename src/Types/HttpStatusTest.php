<?php

namespace Mariuszsienkiewicz\HttpTests\Types;

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

    private string $method = 'GET';

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

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }
}
