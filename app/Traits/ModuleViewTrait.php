<?php

declare(strict_types=1);

namespace App\Traits;

trait ModuleViewTrait
{
    protected function viewModule(string $viewFileName, array $data = []): string
    {
        $moduleName = $this->moduleName();
        $path = "\\Modules\\{$moduleName}\\Views\\{$viewFileName}";       
        return view($path, $data);
    }

    protected function moduleName(): string
    {
        $className = static::class;
        
        $parts = explode('\\', $className );

        $modulesIndex = array_search('Modules', $parts, true);

        if ($modulesIndex === false) {
            throw new \RuntimeException(
                "Module not found for class {$className}"
            );
        }

        return $parts[$modulesIndex + 1];
    }
}