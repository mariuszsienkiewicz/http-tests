<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

use Mariuszsienkiewicz\HttpTests\Tests\HttpStatusTest;
use Mariuszsienkiewicz\HttpTests\Result\TestResultInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpStatusTestResult implements TestResultInterface
{

    /** @var string */
    private string $url;

    /** @var int|null */
    private ?int $statusCode;

    /** @var ResponseInterface */
    private ResponseInterface $response;

    /**
     * @param HttpStatusTest $httpStatusTest
     */
    public function __construct(HttpStatusTest $httpStatusTest) {
        $this->url = $httpStatusTest->getUrl();
        $this->statusCode = $httpStatusTest->getHttpStatusCode();
        $this->response = $httpStatusTest->getResponse();
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
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getAsArray(): array
    {
        return array(
            'url' => $this->getUrl(),
            'statusCode' => $this->getStatusCode(),
            'response' => $this->getResponse()
        );
    }
}