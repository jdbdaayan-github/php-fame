<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class Seed extends Command
{
    public $name = 'seed';
    public $description = 'Run database seeders';

    public function handle(array $args)
    {
        $this->info("Running seeders...");
        // TODO: Implement seeder logic
    }
}
