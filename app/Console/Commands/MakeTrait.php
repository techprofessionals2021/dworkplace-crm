<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeTrait extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:relationship {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait';
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->getPath($name);

        if ($this->files->exists($path)) {
            $this->error("relationship {$name} already exists!");
            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->buildTrait($name));

        $this->info("relationship {$name} created successfully.");
    }

    protected function getPath($name)
    {
        $name = str_replace('\\', '/', $name);
        return app_path("Models/{$name}.php");
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    protected function buildTrait($name)
    {
        $namespace = $this->getNamespace($name);
        $traitName = class_basename($name);

        return <<<EOT
<?php

namespace {$namespace};

trait {$traitName}
{
    // Define your relationships here
}

EOT;
    }

    protected function getNamespace($name)
    {
        // Remove the base directory "app/"
        $namespace = str_replace('/', '\\', $name);

        // Remove the actual trait name from the end of the namespace
        $namespaceParts = explode('\\', $namespace);
        array_pop($namespaceParts); // Remove the trait name

        // Return the full namespace with "App\" as the root namespace
        return 'App\\Models\\' . implode('\\', $namespaceParts);
    }
}
