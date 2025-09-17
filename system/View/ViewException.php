<?php

namespace System\View;

class ViewException extends \Exception
{
    public function __construct(string $message, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct("[View Error] " . $message, $code, $previous);
    }
}
