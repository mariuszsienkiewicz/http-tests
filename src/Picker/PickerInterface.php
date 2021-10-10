<?php

namespace Mariuszsienkiewicz\HttpTests\Types;

interface PickerInterface extends RunnableInterface
{
    /**
     * Return the picked value from the response.
     *
     * @returns mixed
     */
    public function getPicked();
}
