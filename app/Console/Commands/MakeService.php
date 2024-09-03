<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';
    protected $files;

    /**
     * Execute the console command.
     */

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }
    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->getPath($name);

        if ($this->files->exists($path)) {
            $this->error("Service {$name} already exists!");
            return;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->buildService($name));

        $this->info("Service {$name} created successfully.");
    }

    protected function getPath($name)
    {
        $name = str_replace('\\', '/', $name);
        return app_path("Services/{$name}.php");
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    protected function buildService($name)
    {
        $namespace = $this->getNamespace($name);
        $className = class_basename($name);

        return <<<EOT
<?php

namespace {$namespace};

class {$className}
{
    // Define your service methods here
}

EOT;
    }

    protected function getNamespace($name)
    {
        // Remove the base directory "app/Services/"
        $namespace = str_replace('/', '\\', $name);

        // Remove the actual class name from the end of the namespace
        $namespaceParts = explode('\\', $namespace);
        array_pop($namespaceParts); // Remove the service class name

        // Return the full namespace with "App\Services\" as the root namespace
        return 'App\\Services\\' . implode('\\', $namespaceParts);
    }
}
