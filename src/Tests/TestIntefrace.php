<?php

namespace Mariuszsienkiewicz\HttpTests\Tests;

interface TestInterface
{
    public function runTest();

    public function getResult();

    public function getChangedSite();
}