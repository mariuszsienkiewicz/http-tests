<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use Mariuszsienkiewicz\HttpTests\Exception\NoResponseObjectException;
use Mariuszsienkiewicz\HttpTests\Result\StringTestResult;
use Psr\Log\LoggerAwareTrait;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class StringTest implements TestInterface
{
    use LoggerAwareTrait;

    private string $url;

    private string $string;

    /** @var ResponseInterface */
    private $response;

    private bool $stringHasBeenFound;

    /** @var StringTestResult */
    private $result;

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
            throw new NoResponseObjectException('Response has not been set.');
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

    public function isStringHasBeenFound(): bool
    {
        return $this->stringHasBeenFound;
    }

    public function getResult(): StringTestResult
    {
        if (!$this->result) {
            $this->createResult();
        }

        return $this->result;
    }

    public function createResult()
    {
        $this->result = new StringTestResult($this);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }
}
