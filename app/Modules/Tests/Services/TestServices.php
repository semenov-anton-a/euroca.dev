<?php

declare(strict_types=1);

namespace App\Modules\Tests\Services;

class TestServices
{
    public function hello(): string
    {
        return 'Hello from TestServices';
    }

    public function test(int $id): string
    {
        return "Test ID: {$id}";
    }
}