<?php

namespace Mariuszsienkiewicz\HttpTests\Test;

abstract class Test
{
    public function toArray(): array
    {
        return array(
            $this->getResult()
        );
    }
}
