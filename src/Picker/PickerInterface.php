<?php

namespace Mariuszsienkiewicz\HttpTests\Picker;

use Mariuszsienkiewicz\HttpTests\Types\RunnableInterface;

interface PickerInterface extends RunnableInterface
{
    /**
     * Return the picked value from the response.
     *
     * @returns mixed
     */
    public function getPicked();
}
