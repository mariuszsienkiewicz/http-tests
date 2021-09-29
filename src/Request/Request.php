<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

use Symfony\Contracts\HttpClient\ResponseInterface;

class Request
{

    /** @var Url $url */
    private $url;

    /** @var string $method */
    private string $method;

    /** @var ResponseInterface $response */
    private $response;

    /**
     * @param Url $url
     * @param string $method
     * @param ResponseInterface $response
     */
    public function __construct(Url $url, string $method, ResponseInterface $response)
    {
        $this->url = $url;
        $this->method = $method;
        $this->response = $response;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
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
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}