<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

use Symfony\Contracts\HttpClient\ResponseInterface;

class Request
{
    /** @var string */
    private string $url;

    private string $method;

    /** @var ResponseInterface */
    private ResponseInterface $response;

    public function __construct($url, string $method, ResponseInterface $response)
    {
        $this->url = $url;
        $this->method = $method;
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

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
