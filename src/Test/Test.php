<?php

namespace Mariuszsienkiewicz\HttpTests\Test;

abstract class Test
{
    public function asArray(): array
    {
        return array(
            "result" => $this->getResult()
        );
    }

    public function getResult()
    {
        return $this->getResult();
    }
}
