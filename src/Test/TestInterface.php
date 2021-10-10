<?php

namespace Mariuszsienkiewicz\HttpTests\Types;

interface TestInterface extends RunnableInterface
{
    /**
     * Return the result of the test.
     *
     * @return mixed
     */
    public function getResult();
}
