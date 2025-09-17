<?php
namespace System\Console\CLI;

class FameCLI
{
    protected $argv;
    protected $commands = [];

    public function __construct(array $argv)
    {
        $this->argv = $argv;
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        $this->commands = [
            'make:controller' => Commands\MakeController::class,
            'make:model' => Commands\MakeModel::class,
            'make:migration' => Commands\MakeMigration::class,
            'make:middleware' => Commands\MakeMiddleware::class,
            'migrate' => Commands\Migrate::class,
            'seed' => Commands\Seed::class,
            'serve' => Commands\Serve::class,
            'cache:clear' => Commands\ClearCache::class,
        ];
    }

    public function handle()
    {
        if (count($this->argv) < 2) {
            $this->help();
            exit;
        }

        $commandName = $this->argv[1];
        $args = array_slice($this->argv, 2);

        if (!isset($this->commands[$commandName])) {
            echo "Command not found: {$commandName}\n";
            $this->help();
            return;
        }

        $commandClass = $this->commands[$commandName];
        $command = new $commandClass();
        $command->handle($args);
    }

    protected function help()
    {
        echo "Fame CLI Commands:\n";
        foreach ($this->commands as $name => $class) {
            $cmd = new $class();
            echo "  $name\t{$cmd->description}\n";
        }
    }
}
