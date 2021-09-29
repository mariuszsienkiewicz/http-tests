<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

use Mariuszsienkiewicz\HttpTests\Tests\StringTest;

class StringTestResult
{
    private string $url;

    private bool $stringHasBeenFound;

    public function __construct(StringTest $stringTest)
    {
        $this->url = $stringTest->getUrl();
        $this->stringHasBeenFound = $stringTest->isStringHasBeenFound();
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isStringHasBeenFound(): bool
    {
        return $this->stringHasBeenFound;
    }

    public function getAsArray(): array
    {
        return [
            'url' => $this->getUrl(),
            'stringHasBeenFound' => $this->isStringHasBeenFound(),
        ];
    }
}
