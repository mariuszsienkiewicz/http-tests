<?php

namespace Mariuszsienkiewicz\HttpTests\Result;

use Mariuszsienkiewicz\HttpTests\Types\RunnableInterface;

class Result
{
    private string $url;

    private RunnableInterface $result;

    public function __construct($url, RunnableInterface $result)
    {
        $this->url = $url;
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result->getResult();
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return array(
            get_class($this->result) => array_merge(array("url" => $this->url), $this->result->asArray())
        );
    }
}
