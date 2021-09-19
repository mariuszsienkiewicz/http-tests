<?php

namespace mariuszsienkiewicz\HttpTests;

use Symfony\Component\HttpClient\HttpClient;

class HttpTests
{
    public function __construct()
    {
        $this->client = HttpClient::create();
    }
}