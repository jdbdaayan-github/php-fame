<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class ClearCache extends Command
{
    public $name = 'cache:clear';
    public $description = 'Clear framework cache';

    public function handle(array $args)
    {
        $cacheDir = __DIR__ . "/../../../storage/cache";
        array_map('unlink', glob("$cacheDir/*"));
        $this->info("Cache cleared successfully.");
    }
}
