<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface TestResultInterface
{
    public function getResponse(): ResponseInterface;
    public function getAsArray(): array;
}