<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

class ResultManager
{
    /** @var array */
    private array $results = [];

    public function add(Result $result)
    {
        array_push($this->results, $result);
    }

    public function getAll(): array
    {
        return $this->results;
    }

    public function getAllAsArray(): array
    {
        $resultArray = [];

        foreach ($this->results as $result) {
            $resultArray = array_merge($resultArray, $result->asArray());
        }

        return $resultArray;
    }
}
