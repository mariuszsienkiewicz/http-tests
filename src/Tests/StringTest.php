<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Mariuszsienkiewicz\HttpTests\Exception\NoResponseObjectException;
use Mariuszsienkiewicz\HttpTests\Result\StringTestResult;
use Mariuszsienkiewicz\HttpTests\Tests\TestInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class StringTest implements TestInterface
{
    use LoggerAwareTrait;

    /** @var string */
    private string $url;

    /** @var string */
    private string $string;

    /** @var ResponseInterface $response */
    private $response;

    /** @var bool $stringHasBeenFound */
    private bool $stringHasBeenFound;

    /** @var StringTestResult $result */
    private $result;

    /** @var string $method */
    private string $method = 'GET';

    public function __construct(string $url, string $stringToTest)
    {
        $this->url = $url;
        $this->string = $stringToTest;
    }

    /**
     * @throws NoResponseObjectException
     */
    public function runTest(): void
    {
        if (!$this->response) {
            throw new NoResponseObjectException("Response has not been set.");
        }

        $searchResult = null;

        try {
            $content = $this->response->getContent();
            if ($searchResult) {
                $searchResult = stristr($content, $this->string);
            }
        } catch (TransportExceptionInterface $e) {
            // log
        }

        $this->stringHasBeenFound = false !== $searchResult;
    }

    /**
     * @return bool
     */
    public function isStringHasBeenFound(): bool
    {
        return $this->stringHasBeenFound;
    }

    /**
     * @return StringTestResult
     */
    public function getResult(): StringTestResult
    {
        if (!$this->result) {
            $this->createResult();
        }

        return $this->result;
    }

    public function createResult() {
        $this->result = new StringTestResult($this);
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
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }
}
