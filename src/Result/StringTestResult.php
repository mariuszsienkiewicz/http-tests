<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

use Mariuszsienkiewicz\HttpTests\Tests\StringTest;

class StringTestResult
{
    /** @var string */
    private string $url;

    /** @var bool $stringHasBeenFound */
    private bool $stringHasBeenFound;

    /**
     * @param StringTest $stringTest
     */
    public function __construct(StringTest $stringTest) {
        $this->url = $stringTest->getUrl();
        $this->stringHasBeenFound = $stringTest->isStringHasBeenFound();
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function isStringHasBeenFound(): bool
    {
        return $this->stringHasBeenFound;
    }

    /**
     * @return array
     */
    public function getAsArray(): array
    {
        return array(
            'url' => $this->getUrl(),
            'stringHasBeenFound' => $this->isStringHasBeenFound()
        );
    }
}