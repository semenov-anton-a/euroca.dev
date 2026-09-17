<?php
declare(strict_types=1);

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Config\BaseService;

class ServicesScan extends BaseCommand
{
    protected $group = '_My Commands';
    protected $name = 'my:services:scan';
    protected $description = 'Scan services and generate Config/Services.php';

    public function run(array $params)
    {
        $services = [];

        // Module Services.php
        foreach (glob(APPPATH . 'Modules/*/Config/Services.php') ?: [] as $file) {
            $class = $this->getClassName($file);

            if ($class === null || !class_exists($class) || !is_subclass_of($class, BaseService::class)) {
                continue;
            }

            foreach (get_class_methods($class) as $method) {
                $reflection = new \ReflectionMethod($class, $method);

                if (
                    !$reflection->isPublic()
                    || !$reflection->isStatic()
                    || $reflection->getDeclaringClass()->getName() !== $class
                ) {
                    continue;
                }

                $services[$method] = [
                    'class' => $class,
                    'method' => $method,
                    'type' => 'base',
                ];
            }
        }

        // Global Services/*.php
        foreach (glob(APPPATH . 'Services/*.php') ?: [] as $file) {
            $class = $this->getClassName($file);

            if ($class === null || !class_exists($class)) {
                continue;
            }

            $reflection = new \ReflectionClass($class);

            if (
                $reflection->isAbstract()
                || $reflection->isInterface()
                || $reflection->isTrait()
                || $reflection->isSubclassOf(BaseService::class)
            ) {
                continue;
            }

            $method = lcfirst($reflection->getShortName());

            $services[$method] = [
                'class' => $class,
                'type' => 'class',
            ];
        }

        ksort($services);

        $content = $this->generate($services);
        $file = APPPATH . 'Config/Services.php';

        if (file_put_contents($file, $content) === false) {
            CLI::error('Unable to write ' . $file);
            return EXIT_ERROR;
        }

        CLI::write('Services.php generated successfully.', 'green');
        CLI::write('Services found: ' . count($services));
        CLI::newLine();

        foreach ($services as $method => $service) {
            CLI::write(sprintf('  %-30s %s', $method, $service['class']));
        }

        return EXIT_SUCCESS;
    }

    private function getClassName(string $file): ?string
    {
        $content = file_get_contents($file);

        if ($content === false) {
            return null;
        }

        preg_match('/namespace\s+([^;]+);/', $content, $namespace);
        preg_match('/class\s+([a-zA-Z0-9_]+)/', $content, $class);

        if (!isset($namespace[1], $class[1])) {
            return null;
        }

        return trim($namespace[1]) . '\\' . $class[1];
    }

    private function generate(array $services): string
    {
        $content = <<<'PHP'
<?php
declare(strict_types=1);

namespace Config;

use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
PHP;

        foreach ($services as $method => $service) {
            $class = $service['class'];

            if ($service['type'] === 'base') {
                $reflection = new \ReflectionMethod($class, $service['method']);
                $returnType = $reflection->getReturnType();

                $return = $returnType && !$returnType->isBuiltin()
                    ? '\\' . $returnType->getName()
                    : ($returnType ? $returnType->__toString() : '');

                $content .= "\n    public static function {$method}(bool \$getShared = true)";

                if ($return !== '') {
                    $content .= ": {$return}";
                }

                $content .= "\n    {\n";
                $content .= "        return \\{$class}::{$service['method']}(\$getShared);\n";
                $content .= "    }\n";

                continue;
            }

            $content .= "\n    public static function {$method}(bool \$getShared = true): \\{$class}\n";
            $content .= "    {\n";
            $content .= "        if (\$getShared) {\n";
            $content .= "            return static::getSharedInstance('{$method}');\n";
            $content .= "        }\n";
            $content .= "\n";
            $content .= "        return new \\{$class}();\n";
            $content .= "    }\n";
        }

        return $content . "}\n";
    }
}