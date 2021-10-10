<?php

namespace Mariuszsienkiewicz\HttpTests\Picker;

abstract class Picker
{
    public function asArray(): array
    {
        return array(
            "value" => $this->getPicked()
        );
    }

    public function getResult()
    {
        return $this->getPicked();
    }
}
