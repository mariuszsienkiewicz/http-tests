<?php

namespace Mariuszsienkiewicz\HttpTests\Types;

use Mariuszsienkiewicz\HttpTests\Exception\NetworkException;
use Mariuszsienkiewicz\HttpTests\Exception\NoResponseObjectException;
use Mariuszsienkiewicz\HttpTests\Picker\PickerInterface;
use Mariuszsienkiewicz\HttpTests\Result\HttpStatusTestResult;
use Mariuszsienkiewicz\HttpTests\Picker\Picker;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpStatusPicker extends Picker implements PickerInterface
{
    /** @var int|null */
    private ?int $httpStatusCode;

    /** @var ResponseInterface */
    private ResponseInterface $response;

    /** @var string */
    private string $method = 'GET';

    /**
     * @throws NetworkException
     * @throws NoResponseObjectException
     */
    public function run(): void
    {
        if (!$this->response) {
            throw new NoResponseObjectException('Response has not been set.');
        }

        try {
            $responseCode = $this->response->getStatusCode();
        } catch (TransportExceptionInterface $exception) {
            throw new NetworkException($exception->getMessage());
        }

        $this->httpStatusCode = $responseCode;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPicked(): ?int
    {
        return $this->httpStatusCode;
    }
}
