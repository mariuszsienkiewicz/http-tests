<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use App\Util\WebsiteTest\TestInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpStatusTest implements TestInterface
{
    /** @var Site */
    private $site;

    /** @var string */
    private $url;

    /** @var int|null */
    private $result;

    /** @var Symfony\Contracts\HttpClient\HttpClientInterface */
    private $client;

    /**
     * WebsiteStatusTest constructor.
     */
    public function __construct(string $url, HttpClientInterface $client)
    {
        $this->url = $url;
        $this->client = $client;
    }

    /**
     * Get status code.
     *
     * @throws TransportExceptionInterface
     */
    public function runTest(): ?int
    {
        $response = $this->client->request('GET', $this->url);

        try {
            $responseCode = $response->getStatusCode();
        } catch (TransportExceptionInterface $exception) {
            return null;
        }

        $this->result = $responseCode;

        return $this->result;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }
}