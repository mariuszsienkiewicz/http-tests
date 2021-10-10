<?php

namespace Mariuszsienkiewicz\HttpTests\Types;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface RunnableInterface
{
    public function run();

    /**
     * This setter should be set before the run method.
     *
     * @param ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void;

    /**
     * Returns HTTP request method.
     *
     * @return string
     */
    public function getMethod(): string;
}
