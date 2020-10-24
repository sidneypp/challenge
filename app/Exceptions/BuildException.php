<?php

namespace App\Exceptions;

use Exception;

abstract class BuildException extends Exception
{
    protected $message = '';

    protected $httpCode = 422;

    public function render()
    {
        return response($this->getError(), $this->httpCode);
    }

    public function setMessage(string $message): BuildException
    {
        $this->message = $message;
        return $this;
    }

    public function setHttpCode(int $code): BuildException
    {
        $this->httpCode = $code;
        return $this;
    }

    private function getError()
    {
        return array_filter([
            'message' => $this->message,
        ]);
    }

    protected static function new()
    {
        return new static();
    }
}
