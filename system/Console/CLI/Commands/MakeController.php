<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class MakeController extends Command
{
    public $name = 'make:controller';
    public $description = 'Create a new controller';

    public function handle(array $args)
    {
        if (empty($args[0])) {
            $this->error("Please provide a controller name.");
            return;
        }

        $name = $args[0];
        $file = __DIR__ . "/../../../app/Controllers/{$name}.php";

        $template = "<?php\n\nnamespace App\Controllers;\n\nclass {$name}\n{\n    public function index()\n    {\n        echo 'Hello from {$name}!';\n    }\n}\n";

        file_put_contents($file, $template);
        $this->info("Controller created: {$file}");
    }
}
