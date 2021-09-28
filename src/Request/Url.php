<?php

namespace Mariuszsienkiewicz\HttpTests\Request;

class Url
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}