<?php
namespace System\Console\CLI;

abstract class Command
{
    public $name = '';
    public $description = '';

    abstract public function handle(array $args);

    public function info($message)
    {
        echo "[INFO] $message\n";
    }

    public function error($message)
    {
        echo "[ERROR] $message\n";
    }
}
