<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

use Symfony\Contracts\HttpClient\ResponseInterface;

class Request
{
    /** @var Url */
    private $url;

    private string $method;

    /** @var ResponseInterface */
    private $response;

    public function __construct(Url $url, string $method, ResponseInterface $response)
    {
        $this->url = $url;
        $this->method = $method;
        $this->response = $response;
    }

    public function getUrl(): Url
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
