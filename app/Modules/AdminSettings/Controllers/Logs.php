<?php

namespace App\Modules\AdminSettings\Controllers;

use App\Controllers\BaseController;
use App\Modules\AdminSettings\Services\LogService;

class Logs extends BaseController
{
    protected LogService $logService;

    public function __construct()
    {
        $this->logService = new LogService();
    }

    public function index(): string
    {
        $files = $this->logService->getFiles();

        $file = $files[0] ?? null;

        $entries = $file
            ? $this->logService->entries($file)
            : [];

        return $this->viewModule('Logs/index', [
            'files'   => $files,
            'file'    => $file,
            'entries' => $entries,
            'levels'  => $this->logService->getLevels(),
        ]);
    }

    public function read(string $fileName): string
    {
        $file = $this->logService->getFile($fileName);

        if ($file === null) {
            return view('Modules\AdminSettings\Views\Logs\_list', [
                'entries' => [],
            ]);
        }

        $level = $this->request->getGet('level');
        $sort = $this->request->getGet('sort') ?? 'desc';
        $search = $this->request->getGet('search') ?? '';

        $entries = $this->logService->entries(
            $file,
            $level,
            $sort,
            $search
        );

        return view('Modules\AdminSettings\Views\Logs\_list', [
            'entries' => $entries,
        ]);
    }
}