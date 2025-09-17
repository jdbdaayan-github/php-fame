<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class Migrate extends Command
{
    public $name = 'migrate';
    public $description = 'Run database migrations';

    public function handle(array $args)
    {
        $this->info("Running migrations...");
        // TODO: Implement migration logic
    }
}
