<?php

namespace App\Helpers;

class ClassHelper
{
 
    public static function _getControllerMethods(string $class): array
    {
        $reflection = new \ReflectionClass($class);

        $publicMethods = array_filter(
            $reflection->getMethods(\ReflectionMethod::IS_PUBLIC),
            fn($method) => $method->getDeclaringClass()->getName() === $class
        );

        // return array_map(
        //     fn($method) => $method->name,
        //     $publicMethods
        // );
        return array_values(
            array_filter(
                array_map( fn($method) => $method->name, $publicMethods ),
                    fn($name) => 
                        !str_starts_with($name, '_')
                            && $name !== 'index'
                )
            );
    }
}