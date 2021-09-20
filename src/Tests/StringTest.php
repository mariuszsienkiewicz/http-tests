<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

use App\Util\WebsiteTest\TestInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StringTest implements TestInterface
{
    /** @var string */
    private $url;

    /** @var string */
    private $string;

    /** @var Symfony\Contracts\HttpClient\HttpClientInterface */
    private $client;

    /** @var int|null */
    private $result;

    public function __construct(string $url, string $stringToTest, HttpClientInterface $client)
    {
        $this->url = $url;
        $this->string = $stringToTest;
        $this->client = $client;
    }

    /**
     * Search a string inside the website content.
     */
    public function runTest(): ?int
    {
        $searchResult = null;

        try {
            $response = $this->client->request('GET', $this->url);

            $searchResult = null;
            if (200 == $response->getStatusCode()) {
                try {
                    $content = $response->getContent();
                } catch (TransportExceptionInterface $exception) {
                    return false;
                }
                $searchResult = stristr($content, $this->string);
            }
        } catch (TransportExceptionInterface $e) {
            error_log($e);
        }

        $this->result = false !== $searchResult;

        return $this->result;
    }

    public function getResult()
    {
        return $this->result;
    }
}