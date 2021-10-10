<?php

use Mariuszsienkiewicz\HttpTests\HttpTests;
use PHPUnit\Framework\TestCase;

class HttpTestsTest extends TestCase
{

    public function testCreate()
    {
        $this->assertInstanceOf(
            HttpTests::class,
            HttpTests::create(),
        );
    }

}