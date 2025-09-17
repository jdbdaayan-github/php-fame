<?php
namespace System\Console\CLI\Commands;

use System\Console\CLI\Command;

class MakeMigration extends Command
{
    public $name = 'make:migration';
    public $description = 'Create a new migration file';

    public function handle(array $args)
    {
        if (empty($args[0])) {
            $this->error("Please provide a migration name.");
            return;
        }

        $name = date('Y_m_d_His') . '_' . $args[0];
        $file = __DIR__ . "/../../../database/migrations/{$name}.php";

        $template = "<?php\n\nuse System\Migration;\n\nreturn new class extends Migration {\n    public function up()\n    {\n        // TODO: migration up\n    }\n\n    public function down()\n    {\n        // TODO: migration down\n    }\n};\n";

        file_put_contents($file, $template);
        $this->info("Migration created: {$file}");
    }
}
