<?php
namespace System\Http;

class Response
{
    protected int $statusCode = 200;
    protected array $headers = [];
    protected string $content = '';

    public function __construct(string $content = '', int $status = 200, array $headers = [])
    {
        $this->setContent($content);
        $this->setStatusCode($status);
        $this->headers = $headers;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }

    public function header(string $key, string $value): self
    {
        $this->headers[$key] = $value;
        return $this;
    }

    public function json(array $data, int $status = 200): void
    {
        $this->setStatusCode($status);
        $this->header('Content-Type', 'application/json; charset=utf-8');
        $this->setContent(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->send();
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }

        echo $this->content;
        exit;
    }
}
