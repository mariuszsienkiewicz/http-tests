<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

use Mariuszsienkiewicz\HttpTests\Tests\HttpStatusTest;

class HttpStatusTestResult implements TestResultInterface
{
    private string $url;

    private ?int $statusCode;

    public function __construct(HttpStatusTest $httpStatusTest)
    {
        $this->url = $httpStatusTest->getUrl();
        $this->statusCode = $httpStatusTest->getHttpStatusCode();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    public function getAsArray(): array
    {
        return [
            'url' => $this->getUrl(),
            'statusCode' => $this->getStatusCode(),
        ];
    }
}
