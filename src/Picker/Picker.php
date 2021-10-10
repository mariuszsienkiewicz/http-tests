<?php

namespace Mariuszsienkiewicz\HttpTests\Picker;

abstract class Picker
{
    public function toArray(): array
    {
        return array(
            $this->getPicked()
        );
    }
}
