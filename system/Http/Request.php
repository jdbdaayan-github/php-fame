<?php
namespace System\Http;

class Request
{
    public array $get;
    public array $post;
    public array $server;
    public array $files;

    public function __construct(
        array $get = [],
        array $post = [],
        array $server = [],
        array $files = []
    ) {
        $this->get    = $get;
        $this->post   = $post;
        $this->server = $server;
        $this->files  = $files;
    }

    public static function capture(): self
    {
        return new static($_GET, $_POST, $_SERVER, $_FILES);
    }

    public function input(string $key, $default = null)
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default;
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }
}
