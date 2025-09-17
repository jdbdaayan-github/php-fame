<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class MakeModel extends Command
{
    public $name = 'make:model';
    public $description = 'Create a new model';

    public function handle(array $args)
    {
        if (empty($args[0])) {
            $this->error("Please provide a model name.");
            return;
        }

        $name = $args[0];
        $dir = BASE_PATH . "/app/Models";
        $file = $dir . "/{$name}.php";

        // Create directory if it doesn't exist
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $template = "<?php\n\nnamespace App\Models;\n\nuse System\Model;\n\nclass {$name} extends Model\n{\n    protected \$table = '" . strtolower($name) . "';\n}\n";

        file_put_contents($file, $template);
        $this->info("Model created: {$file}");
    }
}
