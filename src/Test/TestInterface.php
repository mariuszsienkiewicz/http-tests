<?php

namespace Mariuszsienkiewicz\HttpTests\Test;

use Mariuszsienkiewicz\HttpTests\Types\RunnableInterface;

interface TestInterface extends RunnableInterface
{
    /**
     * Return the result of the test.
     *
     * @return mixed
     */
    public function getResult();
}
