<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class Serve extends Command
{
    public $name = 'serve';
    public $description = 'Start PHP built-in server';

    public function handle(array $args)
    {
        // Set default port to 8080
        $port = $args[0] ?? '8080';
        $this->info("Starting server on http://localhost:{$port}");
        system("php -S localhost:{$port} -t public");
    }
}
