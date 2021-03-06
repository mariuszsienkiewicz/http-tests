<?php

namespace Mariuszsienkiewicz\HttpTests\Types;

use Mariuszsienkiewicz\HttpTests\Exception\NoResponseObjectException;
use Mariuszsienkiewicz\HttpTests\Test\Test;
use Mariuszsienkiewicz\HttpTests\Test\TestInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class StringTest extends Test implements TestInterface
{
    use LoggerAwareTrait;

    /** @var string */
    private string $string;

    /** @var ResponseInterface */
    private ResponseInterface $response;

    /** @var bool */
    private bool $stringHasBeenFound;

    /** @var string $method */
    private string $method = 'GET';

    /**
     * @param string $stringToFind
     */
    public function __construct(string $stringToFind)
    {
        $this->string = $stringToFind;
    }

    /**
     * @throws NoResponseObjectException
     */
    public function run(): void
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
        } catch (ClientExceptionInterface | ServerExceptionInterface | RedirectionExceptionInterface $e) {
        }

        $this->stringHasBeenFound = false !== $searchResult;
    }

    /**
     * @return bool
     */
    public function getResult(): bool
    {
        return $this->stringHasBeenFound;
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
