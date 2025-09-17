<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class MakeMiddleware extends Command
{
    public $name = 'make:middleware';
    public $description = 'Create a new middleware class';

    public function handle(array $args)
    {
        if (empty($args[0])) {
            $this->error("Please provide a middleware name.");
            return;
        }

        $name = $args[0];
        $file = __DIR__ . "/../../../app/Middleware/{$name}.php";

        $template = "<?php\n\nnamespace App\Middleware;\n\nclass {$name}\n{\n    public function handle(\$request, \$next)\n    {\n        return \$next(\$request);\n    }\n}\n";

        file_put_contents($file, $template);
        $this->info("Middleware created: {$file}");
    }
}
